<?php
class ControllerExtensionShippingMatkahuolto extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/shipping/matkahuolto');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('shipping_matkahuolto', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/matkahuolto', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/matkahuolto', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=shipping', true);


		if (isset($this->error['user_id'])) {
			$data['error_user_id'] = $this->error['user_id'];
		} else {
			$data['error_user_id'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['sender_id'])) {
			$data['error_sender_id'] = $this->error['sender_id'];
		} else {
			$data['error_sender_id'] = '';
		}

		if (isset($this->request->post['shipping_matkahuolto_user_id'])) {
			$data['shipping_matkahuolto_user_id'] = $this->request->post['shipping_matkahuolto_user_id'];
		} else {
			$data['shipping_matkahuolto_user_id'] = $this->config->get('shipping_matkahuolto_user_id');
		}

		if (isset($this->request->post['shipping_matkahuolto_test_mode'])) {
			$data['shipping_matkahuolto_test_mode'] = $this->request->post['shipping_matkahuolto_test_mode'];
		} else {
			$data['shipping_matkahuolto_test_mode'] = $this->config->get('shipping_matkahuolto_test_mode');
		}

		if (isset($this->request->post['shipping_matkahuolto_kotijakelu'])) {
			$data['shipping_matkahuolto_kotijakelu'] = $this->request->post['shipping_matkahuolto_kotijakelu'];
		} else {
			$data['shipping_matkahuolto_kotijakelu'] = $this->config->get('shipping_matkahuolto_kotijakelu');
		}

		if (isset($this->request->post['shipping_matkahuolto_iso_palvelu'])) {
			$data['shipping_matkahuolto_kotijakelu_iso_palvelu'] = $this->request->post['shipping_matkahuolto_iso_palvelu'];
		} else {
			$data['shipping_matkahuolto_iso_palvelu'] = $this->config->get('shipping_matkahuolto_iso_palvelu');
		}

		if (isset($this->request->post['shipping_matkahuolto_iso_price'])) {
			$data['shipping_matkahuolto_kotijakelu_iso_price'] = $this->request->post['shipping_matkahuolto_iso_price'];
		} else {
			$data['shipping_matkahuolto_iso_price'] = $this->config->get('shipping_matkahuolto_iso_price');
		}

		if (isset($this->request->post['shipping_matkahuolto_kotijakelu_price'])) {
			$data['shipping_matkahuolto_kotijakelu_kotijakelu_price'] = $this->request->post['shipping_matkahuolto_kotijakelu_price'];
		} else {
			$data['shipping_matkahuolto_kotijakelu_price'] = $this->config->get('shipping_matkahuolto_kotijakelu_price');
		}

		if (isset($this->request->post['shipping_matkahuolto_kotijakelu_add'])) {
			$data['shipping_matkahuolto_kotijakelu_add'] = $this->request->post['shipping_matkahuolto_kotijakelu_add'];
		} else {
			$data['shipping_matkahuolto_kotijakelu_add'] = $this->config->get('shipping_matkahuolto_kotijakelu_add');
		}

		if (isset($this->request->post['shipping_matkahuolto_search_result'])) {
			$data['shipping_matkahuolto_search_result'] = $this->request->post['shipping_matkahuolto_search_result'];
		} else {
			$data['shipping_matkahuolto_search_result'] = $this->config->get('shipping_matkahuolto_search_result');
		}

		if (isset($this->request->post['shipping_matkahuolto_weight_class_id'])) {
			$data['shipping_matkahuolto_weight_class_id'] = $this->request->post['shipping_matkahuolto_weight_class_id'];
		} else {
			$data['shipping_matkahuolto_weight_class_id'] = $this->config->get('shipping_matkahuolto_weight_class_id');
		}

		if (isset($this->request->post['shipping_matkahuolto_length_class_id'])) {
			$data['shipping_matkahuolto_length_class_id'] = $this->request->post['shipping_matkahuolto_length_class_id'];
		} else {
			$data['shipping_matkahuolto_length_class_id'] = $this->config->get('shipping_matkahuolto_length_class_id');
		}

		if (isset($this->request->post['shipping_matkahuolto_tax_class_id'])) {
			$data['shipping_matkahuolto_tax_class_id'] = $this->request->post['shipping_matkahuolto_tax_class_id'];
		} else {
			$data['shipping_matkahuolto_tax_class_id'] = $this->config->get('shipping_matkahuolto_tax_class_id');
		}

		if (isset($this->request->post['shipping_matkahuolto_free_cargo'])) {
			$data['shipping_matkahuolto_free_cargo'] = $this->request->post['shipping_matkahuolto_free_cargo'];
		} else {
			$data['shipping_matkahuolto_free_cargo'] = $this->config->get('shipping_matkahuolto_free_cargo');
		}

		if (isset($this->request->post['shipping_matkahuolto_discount_cargo'])) {
			$data['shipping_matkahuolto_discount_cargo'] = $this->request->post['shipping_matkahuolto_discount_cargo'];
		} else {
			$data['shipping_matkahuolto_discount_cargo'] = $this->config->get('shipping_matkahuolto_discount_cargo');
		}

		if (isset($this->request->post['shipping_matkahuolto_cargo_sum'])) {
			$data['shipping_matkahuolto_cargo_sum'] = $this->request->post['shipping_matkahuolto_cargo_sum'];
		} else {
			$data['shipping_matkahuolto_cargo_sum'] = $this->config->get('shipping_matkahuolto_cargo_sum');
		}

		if (isset($this->request->post['shipping_matkahuolto_discount_cargo_percent'])) {
			$data['shipping_matkahuolto_discount_cargo_percent'] = $this->request->post['shipping_matkahuolto_discount_cargo_percent'];
		} else {
			$data['shipping_matkahuolto_discount_cargo_percent'] = $this->config->get('shipping_matkahuolto_discount_cargo_percent');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto'])) {
			$data['shipping_matkahuolto_hinnasto'] = $this->request->post['shipping_matkahuolto_hinnasto'];
		} else {
			$data['shipping_matkahuolto_hinnasto'] = $this->config->get('shipping_matkahuolto_hinnasto');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto_2'])) {
			$data['shipping_matkahuolto_hinnasto_2'] = $this->request->post['shipping_matkahuolto_hinnasto_2'];
		} else {
			$data['shipping_matkahuolto_hinnasto_2'] = $this->config->get('shipping_matkahuolto_hinnasto_2');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto_3'])) {
			$data['shipping_matkahuolto_hinnasto_3'] = $this->request->post['shipping_matkahuolto_hinnasto_3'];
		} else {
			$data['shipping_matkahuolto_hinnasto_3'] = $this->config->get('shipping_matkahuolto_hinnasto_3');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto_4'])) {
			$data['shipping_matkahuolto_hinnasto_4'] = $this->request->post['shipping_matkahuolto_hinnasto_4'];
		} else {
			$data['shipping_matkahuolto_hinnasto_4'] = $this->config->get('shipping_matkahuolto_hinnasto_4');
		}
		if (isset($this->request->post['shipping_matkahuolto_hinnasto_2_status'])) {
			$data['shipping_matkahuolto_hinnasto_2_status'] = $this->request->post['shipping_matkahuolto_hinnasto_2_status'];
		} else {
			$data['shipping_matkahuolto_hinnasto_2_status'] = $this->config->get('shipping_matkahuolto_hinnasto_2_status');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto_3_status'])) {
			$data['shipping_matkahuolto_hinnasto_3_status'] = $this->request->post['shipping_matkahuolto_hinnasto_3_status'];
		} else {
			$data['shipping_matkahuolto_hinnasto_3_status'] = $this->config->get('shipping_matkahuolto_hinnasto_3_status');
		}

		if (isset($this->request->post['shipping_matkahuolto_hinnasto_4_status'])) {
			$data['shipping_matkahuolto_hinnasto_4_status'] = $this->request->post['shipping_matkahuolto_hinnasto_4_status'];
		} else {
			$data['shipping_matkahuolto_hinnasto_4_status'] = $this->config->get('shipping_matkahuolto_hinnasto_4_status');
		}


		if (isset($this->request->post['shipping_matkahuolto_status'])) {
			$data['shipping_matkahuolto_status'] = $this->request->post['shipping_matkahuolto_status'];
		} else {
			$data['shipping_matkahuolto_status'] = $this->config->get('shipping_matkahuolto_status');
		}

		if (isset($this->request->post['shipping_matkahuolto_sort_order'])) {
			$data['shipping_matkahuolto_sort_order'] = $this->request->post['shipping_matkahuolto_sort_order'];
		} else {
			$data['shipping_matkahuolto_sort_order'] = $this->config->get('shipping_matkahuolto_sort_order');
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['shipping_matkahuolto_geo_zone_id'])) {
			$data['shipping_matkahuolto_geo_zone_id'] = $this->request->post['shipping_matkahuolto_geo_zone_id'];
		} else {
			$data['shipping_matkahuolto_geo_zone_id'] = $this->config->get('shipping_matkahuolto_geo_zone_id');
		}

		$this->load->model('localisation/weight_class');
		$this->load->model('localisation/length_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();('shipping_matkahuolto_sort_order');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/matkahuolto', $data));
	}

	public function install(){

        // Hinnasto
         $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
         	(0, 'shipping_matkahuolto', 'shipping_matkahuolto_hinnasto', '[{\"kg\":\"2\",\"price\":\"7.00\"},{\"kg\":\"5\",\"price\":\"10.95\"},{\"kg\":\"10\",\"price\":\"13.50\"},{\"kg\":\"15\",\"price\":\"15.50\"},{\"kg\":\"20\",\"price\":\"18.25\"},{\"kg\":\"25\",\"price\":\"20.50\"},{\"kg\":\"30\",\"price\":\"23.00\"},{\"kg\":\"40\",\"price\":\"26.10\"},{\"kg\":\"50\",\"price\":\"29.10\"},{\"kg\":\"60\",\"price\":\"32.00\"},{\"kg\":\"70\",\"price\":\"37.10\"},{\"kg\":\"80\",\"price\":\"39.80\"},{\"kg\":\"90\",\"price\":\"43.00\"},{\"kg\":\"100\",\"price\":\"47.00\"}]', 1),
            (0, 'shipping_matkahuolto', 'shipping_matkahuolto_hinnasto_2', '[{\"kg\":\"2\",\"price\":\"15.28\"},{\"kg\":\"5\",\"price\":\"17.29\"},{\"kg\":\"10\",\"price\":\"21.00\"},{\"kg\":\"15\",\"price\":\"29.50\"},{\"kg\":\"20\",\"price\":\"40.00\"}]', 1),
            (0, 'shipping_matkahuolto', 'shipping_matkahuolto_hinnasto_3', '[{\"kg\":\"1\",\"price\":\"12.50\"},{\"kg\":\"2\",\"price\":\"12.90\"},{\"kg\":\"5\",\"price\":\"15.00\"},{\"kg\":\"10\",\"price\":\"18.00\"},{\"kg\":\"15\",\"price\":\"21.00\"},{\"kg\":\"20\",\"price\":\"24.00\"},{\"kg\":\"25\",\"price\":\"26.50\"},{\"kg\":\"30\",\"price\":\"28.00\"},{\"kg\":\"32\",\"price\":\"29.00\"}]', 1),
            (0, 'shipping_matkahuolto', 'shipping_matkahuolto_hinnasto_4', '[{\"kg\":\"2\",\"price\":\"18.90\"},{\"kg\":\"5\",\"price\":\"20.10\"},{\"kg\":\"10\",\"price\":\"24.10\"},{\"kg\":\"15\",\"price\":\"32.20\"},{\"kg\":\"20\",\"price\":\"42.50\"}]', 1)");
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/matkahuolto')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->request->post['shipping_matkahuolto_user_id'] && strlen($this->request->post['shipping_matkahuolto_user_id']) < 3) {
			$this->error['user_id'] = $this->language->get('error_user_id');
		}

		return !$this->error;
	}
}
