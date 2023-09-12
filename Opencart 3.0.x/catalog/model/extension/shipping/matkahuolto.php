<?php
class ModelExtensionShippingMatkahuolto extends Model {
	function getQuote($address) {
		$this->load->language('extension/shipping/matkahuolto');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('shipping_matkahuolto_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('shipping_matkahuolto_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$quote_data = array();

		$products = $this->cart->getProducts();
  
         $error = '';
         $error2 = '';
         $error3 = '';
         $total = 0;
         $add = 0;
         $list = '';
		foreach($products as $product){
            $total += $product['total'];
			$volume = $this->length_convertion($product['length'], $product['length_class_id']) * $this->length_convertion($product['width'], $product['length_class_id']) * $this->length_convertion($product['height'], $product['length_class_id']);
            $longest = $this->get_longest($product['length'], $product['width'], $product['height'], $product['length_class_id']);
		        if($volume > '0.5'){
		      		  // Liian suuri tilavuus
                   if(!$this->config->get('shipping_matkahuolto_iso_palvelu')){
			      	          $status = false;
                        $error = $this->language->get('error_volume');
                   }
                   if($this->config->get('shipping_matkahuolto_iso_palvelu') && $volume >= '0.83'){
                        $status = false;
                        $error = $this->language->get('error_volume');
                   }
		    	}
		      if($longest >= 3){
				     // Liian pitkä kuljetus
		        		$status = false;
                        $error = $this->language->get('error_length');
			    }
            if($longest >= '1.2' && $longest < 3){
                   // Liian pitkä kuljetus
                  if($longest >= '1.5'){
                    $error2 = $this->language->get('error_home');
                  }
                  if(!$this->config->get('shipping_matkahuolto_iso_palvelu') && !$error){ 
                        $status = false;
                        $error3 = $this->language->get('error_iso');
                  }
                  if($this->config->get('shipping_matkahuolto_iso_palvelu') && $this->config->get('shipping_matkahuolto_iso_price')){
               	      $add = $this->config->get('shipping_matkahuolto_iso_price');
               	      $list = 'M';
                  }
           }
           if($this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id')) > 54.99){
           	 $status = false;
           }
      
		}

		$weight = $this->cart->getWeight();

        $iso_codes = array('FI', 'BE', 'DK', 'EE', 'DE', 'AT', 'NL', 'LT', 'LV', 'LU', 'SE');

          $cost = 0;
          $kotijakelu = false;
         
         if($address['iso_code_2'] == 'FI'){
            $cost = $this->cost($weight);
            if($this->config->get('shipping_matkahuolto_kotijakelu') && !$error2){ 
               $kotijakelu = true;
            }
            
         }
         if($address['iso_code_2'] == 'SE' || $address['iso_code_2'] == 'DK'){
             if($this->config->get('shipping_matkahuolto_hinnasto_2_status')){
             // Ruotsi, Tanska ja Baltian maat
             $cost = $this->cost2($weight);
            } else {
            	$status = false;
            }
         }
         if($address['iso_code_2'] == 'EE' || $address['iso_code_2'] == 'LT' || $address['iso_code_2'] == 'LV'){
            if($this->config->get('shipping_matkahuolto_hinnasto_3_status')){
               // Ruotsi, Tanska ja Baltian maat
                $cost = $this->cost3($weight);
            } else {
            	$status = false;
            }
         }
         if($address['iso_code_2'] == 'DE' || $address['iso_code_2'] == 'AT' || $address['iso_code_2'] == 'BE' || $address['iso_code_2'] == 'LU' || $address['iso_code_2'] == 'NL'){
            if($this->config->get('shipping_matkahuolto_hinnasto_4_status')){
               // Saksa, Itävalta ja Benelux maat
               $cost = $this->cost4($weight);
            } else {
            	$status = false;
            }
         }
         if($error){
         	  echo $error;
         }
         if($error3){
            echo $error3;
         }

   if ($status && in_array($address['iso_code_2'], $iso_codes)) {

          if($this->config->get('shipping_matkahuolto_test_mode')){
            $url = 'https://extservicestest.matkahuolto.fi/noutopistehaku/public/v2/searchoffices'; // testaus-osoite
          } else {
            $url = 'https://extservices.matkahuolto.fi/noutopistehaku/public/v2/searchoffices';
          }

          $ch = curl_init();

          $xml = $this->sendXml($address,$list);

          curl_setopt($ch, CURLOPT_URL,$url); 
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
          curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); 
          curl_setopt($ch, CURLOPT_POST, 1);  
          curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml')); 

         $response = curl_exec($ch);
          curl_close($ch);

        $array = simplexml_load_string($response);

       $ale ='';
     


         if($total  >= $this->config->get('shipping_matkahuolto_cargo_sum')){
              if($this->config->get('shipping_matkahuolto_free_cargo')){
                  $cost = 0;
                  $koti = 0;
              } elseif ($this->config->get('shipping_matkahuolto_discount_cargo') && $this->config->get('shipping_matkahuolto_discount_cargo_percent')){
                  $summa = ($cost/100)*$this->config->get('shipping_matkahuolto_discount_cargo_percent');
                  $cost = round($cost-$summa,2);
                  $koti = $this->config->get('shipping_matkahuolto_kotijakelu_price');
                  $ale = '(Alennus ' . $this->config->get('shipping_matkahuolto_discount_cargo_percent') . '%)';
              }
         }

           foreach($array->Office as $place){
         
               $quote_data[(int)$place->SeqNumber] = array(
                   'code'         => 'matkahuolto.' . $place->Name . '.' . $place->Id,
                   'title'        => $ale . ' ' . $place->Name . ', ' . $place->StreetAddress . ', ' . $place->PostalCode . ' ' . $place->City,
                   'cost'         => trim($cost+$add),
                   'tax_class_id' => $this->config->get('shipping_matkahuolto_tax_class_id'),
                   'text'         => $this->currency->format($this->tax->calculate(trim($cost+$add), $this->config->get('shipping_matkahuolto_tax_class_id')), $this->session->data['currency'])
                    );
               }


               if($kotijakelu && !$error2){
               // lisäpalveluna kotijakelu
                   $quote_data['kotijakelu'] = array(
                    'code'         => 'matkahuolto.kotijakelu',
                    'title'        => $ale . ' ' . 'Matkahuolto, Kotijakelu',
                    'cost'         => trim($cost + $koti),
                    'tax_class_id' => $this->config->get('shipping_matkahuolto_tax_class_id'),
                    'text'         => $this->currency->format($this->tax->calculate(trim($cost + $koti), $this->config->get('shipping_matkahuolto_tax_class_id')), $this->session->data['currency'])
                    );
              }
          } 

	   $method_data = array();


		if ($quote_data) {
			$title = $this->language->get('text_title');
			if ($this->config->get('matkahuolto_pickup_description')) {
				$title .= '          <br/>          <small>' . $this->language->get('text_description') . '          </small>';
			}

			$method_data = array(
				'code'       => 'matkahuolto',
				'title'      => $title,
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('shipping_matkahuolto_sort_order'),
				'error'      => false
			);
		}
		return $method_data;
	}

	protected function length_convertion($length, $length_class_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "length_class_description` WHERE length_class_id = '" . $length_class_id . "'");

		$unit = $query->row['unit'];
		if($unit == 'cm'){
			$length = $length/100;
		}
		if($unit == 'mm'){
			$length = $length/1000;

		}
    return $length;
	}

    protected function get_longest($length, $width, $height, $length_class_id){
      $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "length_class_description` WHERE length_class_id = '" . $length_class_id . "'");

      $unit = $query->row['unit'];
      if($unit == 'cm'){
        $length = $length/100;
        $width = $width/100;
        $height = $height/100;
      }
      if($unit == 'mm'){
        $length = $length/1000;
        $width = $width/1000;
        $height = $height/1000;

      }
        $size = array($length, $width, $height);
      return max($size);
    }

	protected function cost($weight){
		foreach($this->config->get('shipping_matkahuolto_hinnasto') as $result){
			if($weight <= $result['kg']){
				return $result['price'];
			}
		}
	}

	protected function cost2($weight){
		foreach($this->config->get('shipping_matkahuolto_hinnasto_2') as $result){
			if($weight <= $result['kg']){
				return $result['price'];
			}
		}
	}

	protected function cost3($weight){
		foreach($this->config->get('shipping_matkahuolto_hinnasto_3') as $result){
			if( $weight <= $result['kg']){
				return $result['price'];
			}
		}
	}

	protected function cost4($weight){
		foreach($this->config->get('shipping_matkahuolto_hinnasto_4') as $result){
			if($weight <= $result['kg']){
				return $result['price'];
			}
		}
	}

    public function sendXML($address,$list){
        if($this->config->get('shipping_matkahuolto_search_result')){
           $result = $this->config->get('shipping_matkahuolto_search_result');
        } else {
           $result = 5;
        }
      
        if($this->config->get('shipping_matkahuolto_test_mode')){
            $user_id = 9430023;
        } else {
           $user_id = (int)$this->config->get('shipping_matkahuolto_user_id');
        }

          $query ="<?xml version='1.0' encoding='ISO-8859-1'?>
          <MHSearchOfficesRequest>
          <Login>" . $user_id . "</Login>
          <Version>1.0</Version>\r\n
          <StreetAddress>" . $address['address_1'] . "</StreetAddress>
          <PostalCode>" . $address['postcode'] . "</PostalCode>
          <City>" . $address['city'] . "</City>
          <Country>" . $address['iso_code_2'] . "</Country>
          <OfficeType>" . $list . "</OfficeType>
          <ResponseType>XML</ResponseType>
          <MaxResults>" . $result . "</MaxResults>
          <Coordinates>Y</Coordinates>
          </MHSearchOfficesRequest>";

          return $query;

    }
}
