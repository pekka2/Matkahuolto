<?php
class ControllerExtensionShippingMatkahuolto extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/shipping/matkahuolto');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('matkahuolto', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        // Heading
		$data['heading_title'] = $this->language->get('heading_title');
        // Entry
		$data['entry_cargo_sum'] = $this->language->get('entry_cargo_sum');
		$data['entry_discount_cargo'] = $this->language->get('entry_discount_cargo');
		$data['entry_discount_cargo_percent'] = $this->language->get('entry_discount_cargo_percent');
		$data['entry_free_cargo'] = $this->language->get('entry_free_cargo');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_hinnasto_2'] = $this->language->get('entry_hinnasto_2');
		$data['entry_hinnasto_3'] = $this->language->get('entry_hinnasto_3');
		$data['entry_hinnasto_4'] = $this->language->get('entry_hinnasto_4');
		$data['entry_iso_add_price'] = $this->language->get('entry_iso_add_price');
		$data['entry_iso_palvelu'] = $this->language->get('entry_iso_palvelu');
		$data['entry_kotijakelu'] = $this->language->get('entry_kotijakelu');
		$data['entry_kotijakelu_price'] = $this->language->get('entry_kotijakelu_price');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_search'] = $this->language->get('entry_search');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_user_id'] = $this->language->get('entry_user_id');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_test_mode'] = $this->language->get('entry_test_mode');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		// Text
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_hinnasto_description'] = $this->language->get('text_hinnasto_description');
		$data['text_hinnasto_2_description'] = $this->language->get('text_hinnasto_2_description');
		$data['text_hinnasto_3_description'] = $this->language->get('text_hinnasto_3_description');
		$data['text_hinnasto_4_description'] = $this->language->get('text_hinnasto_4_description');
		$data['text_none'] = $this->language->get('text_none');

		// Tab
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_hinnasto'] = $this->language->get('tab_hinnasto');
		$data['tab_hinnasto_2'] = $this->language->get('tab_hinnasto_2');
		$data['tab_hinnasto_3'] = $this->language->get('tab_hinnasto_3');
		$data['tab_hinnasto_4'] = $this->language->get('tab_hinnasto_4');
		// Column
		$data['column_kg'] = $this->language->get('column_kg');
		$data['column_price'] = $this->language->get('column_price');

        // Help
		$data['help_iso_price'] = $this->language->get('help_iso_price');
		$data['help_iso_palvelu'] = $this->language->get('help_iso_palvelu');
		$data['help_kotijakelu_price'] = $this->language->get('help_kotijakelu_price');
		// Button
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_weight_add'] = $this->language->get('button_weight_add');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/matkahuolto', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/matkahuolto', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true);


		if (isset($this->error['user_id'])) {
			$data['error_user_id'] = $this->error['user_id'];
		} else {
			$data['error_user_id'] = '';
		}

		if (isset($this->request->post['matkahuolto_user_id'])) {
			$data['matkahuolto_user_id'] = $this->request->post['matkahuolto_user_id'];
		} else {
			$data['matkahuolto_user_id'] = $this->config->get('matkahuolto_user_id');
		}

		if (isset($this->request->post['matkahuolto_iso_palvelu'])) {
			$data['matkahuolto_iso_palvelu'] = $this->request->post['matkahuolto_iso_palvelu'];
		} else {
			$data['matkahuolto_iso_palvelu'] = $this->config->get('matkahuolto_iso_palvelu');
		}

		if (isset($this->request->post['matkahuolto_iso_price'])) {
			$data['matkahuolto_iso_price'] = $this->request->post['matkahuolto_iso_price'];
		} else {
			$data['matkahuolto_iso_price'] = $this->config->get('matkahuolto_iso_price');
		}

		if (isset($this->request->post['matkahuolto_kotijakelu'])) {
			$data['matkahuolto_kotijakelu'] = $this->request->post['matkahuolto_kotijakelu'];
		} else {
			$data['matkahuolto_kotijakelu'] = $this->config->get('matkahuolto_kotijakelu');
		}

		if (isset($this->request->post['matkahuolto_kotijakelu_price'])) {
			$data['matkahuolto_kotijakelu_price'] = $this->request->post['matkahuolto_kotijakelu_price'];
		} else {
			$data['matkahuolto_kotijakelu_price'] = $this->config->get('matkahuolto_kotijakelu_price');
		}

		if (isset($this->request->post['matkahuolto_search_result'])) {
			$data['matkahuolto_search_result'] = $this->request->post['matkahuolto_search_result'];
		} else {
			$data['matkahuolto_search_result'] = $this->config->get('matkahuolto_search_result');
		}

		if (isset($this->request->post['matkahuolto_weight_class_id'])) {
			$data['matkahuolto_weight_class_id'] = $this->request->post['matkahuolto_weight_class_id'];
		} else {
			$data['matkahuolto_weight_class_id'] = $this->config->get('matkahuolto_weight_class_id');
		}

		if (isset($this->request->post['matkahuolto_test_mode'])) {
			$data['matkahuolto_test_mode'] = $this->request->post['matkahuolto_test_mode'];
		} else {
			$data['matkahuolto_test_mode'] = $this->config->get('matkahuolto_test_mode');
		}

		if (isset($this->request->post['matkahuolto_length_class_id'])) {
			$data['matkahuolto_length_class_id'] = $this->request->post['matkahuolto_length_class_id'];
		} else {
			$data['matkahuolto_length_class_id'] = $this->config->get('matkahuolto_length_class_id');
		}

		if (isset($this->request->post['matkahuolto_tax_class_id'])) {
			$data['matkahuolto_tax_class_id'] = $this->request->post['matkahuolto_tax_class_id'];
		} else {
			$data['matkahuolto_tax_class_id'] = $this->config->get('matkahuolto_tax_class_id');
		}

		if (isset($this->request->post['matkahuolto_free_cargo'])) {
			$data['matkahuolto_free_cargo'] = $this->request->post['matkahuolto_free_cargo'];
		} else {
			$data['matkahuolto_free_cargo'] = $this->config->get('matkahuolto_free_cargo');
		}

		if (isset($this->request->post['matkahuolto_discount_cargo'])) {
			$data['matkahuolto_discount_cargo'] = $this->request->post['matkahuolto_discount_cargo'];
		} else {
			$data['matkahuolto_discount_cargo'] = $this->config->get('matkahuolto_discount_cargo');
		}

		if (isset($this->request->post['matkahuolto_cargo_sum'])) {
			$data['matkahuolto_cargo_sum'] = $this->request->post['matkahuolto_cargo_sum'];
		} else {
			$data['matkahuolto_cargo_sum'] = $this->config->get('matkahuolto_cargo_sum');
		}

		if (isset($this->request->post['matkahuolto_discount_cargo_percent'])) {
			$data['matkahuolto_discount_cargo_percent'] = $this->request->post['matkahuolto_discount_cargo_percent'];
		} else {
			$data['matkahuolto_discount_cargo_percent'] = $this->config->get('matkahuolto_discount_cargo_percent');
		}

		if (isset($this->request->post['matkahuolto_hinnasto'])) {
			$data['matkahuolto_hinnasto'] = $this->request->post['matkahuolto_hinnasto'];
		} else {
			$data['matkahuolto_hinnasto'] = $this->config->get('matkahuolto_hinnasto');
		}

		if (isset($this->request->post['matkahuolto_hinnasto_2'])) {
			$data['matkahuolto_hinnasto_2'] = $this->request->post['matkahuolto_hinnasto_2'];
		} else {
			$data['matkahuolto_hinnasto_2'] = $this->config->get('matkahuolto_hinnasto_2');
		}

		if (isset($this->request->post['matkahuolto_hinnasto_3'])) {
			$data['matkahuolto_hinnasto_3'] = $this->request->post['matkahuolto_hinnasto_3'];
		} else {
			$data['matkahuolto_hinnasto_3'] = $this->config->get('matkahuolto_hinnasto_3');
		}

		if (isset($this->request->post['matkahuolto_hinnasto_4'])) {
			$data['matkahuolto_hinnasto_4'] = $this->request->post['matkahuolto_hinnasto_4'];
		} else {
			$data['matkahuolto_hinnasto_4'] = $this->config->get('matkahuolto_hinnasto_4');
		}
		if (isset($this->request->post['matkahuolto_hinnasto_2_status'])) {
			$data['matkahuolto_hinnasto_2_status'] = $this->request->post['matkahuolto_hinnasto_2_status'];
		} else {
			$data['matkahuolto_hinnasto_2_status'] = $this->config->get('matkahuolto_hinnasto_2_status');
		}

		if (isset($this->request->post['matkahuolto_hinnasto_3_status'])) {
			$data['matkahuolto_hinnasto_3_status'] = $this->request->post['matkahuolto_hinnasto_3_status'];
		} else {
			$data['matkahuolto_hinnasto_3_status'] = $this->config->get('matkahuolto_hinnasto_3_status');
		}

		if (isset($this->request->post['matkahuolto_hinnasto_4_status'])) {
			$data['matkahuolto_hinnasto_4_status'] = $this->request->post['matkahuolto_hinnasto_4_status'];
		} else {
			$data['matkahuolto_hinnasto_4_status'] = $this->config->get('matkahuolto_hinnasto_4_status');
		}


		if (isset($this->request->post['matkahuolto_status'])) {
			$data['matkahuolto_status'] = $this->request->post['matkahuolto_status'];
		} else {
			$data['matkahuolto_status'] = $this->config->get('matkahuolto_status');
		}

		if (isset($this->request->post['matkahuolto_sort_order'])) {
			$data['matkahuolto_sort_order'] = $this->request->post['matkahuolto_sort_order'];
		} else {
			$data['matkahuolto_sort_order'] = $this->config->get('matkahuolto_sort_order');
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['matkahuolto_geo_zone_id'])) {
			$data['matkahuolto_geo_zone_id'] = $this->request->post['matkahuolto_geo_zone_id'];
		} else {
			$data['matkahuolto_geo_zone_id'] = $this->config->get('matkahuolto_geo_zone_id');
		}

		$this->load->model('localisation/weight_class');
		$this->load->model('localisation/length_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();
		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();('matkahuolto_sort_order');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/matkahuolto', $data));
	}

	public function install(){

        // Hinnasto
         $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
         	(0, 'matkahuolto', 'matkahuolto_hinnasto', '[{\"kg\":\"2\",\"price\":\"7.00\"},{\"kg\":\"5\",\"price\":\"10.95\"},{\"kg\":\"10\",\"price\":\"13.50\"},{\"kg\":\"15\",\"price\":\"15.50\"},{\"kg\":\"20\",\"price\":\"18.25\"},{\"kg\":\"25\",\"price\":\"20.50\"},{\"kg\":\"30\",\"price\":\"23.00\"},{\"kg\":\"40\",\"price\":\"26.10\"},{\"kg\":\"50\",\"price\":\"29.10\"},{\"kg\":\"60\",\"price\":\"32.00\"},{\"kg\":\"70\",\"price\":\"37.10\"},{\"kg\":\"80\",\"price\":\"39.80\"},{\"kg\":\"90\",\"price\":\"43.00\"},{\"kg\":\"100\",\"price\":\"47.00\"}]', 1),
            (0, 'matkahuolto', 'matkahuolto_hinnasto_2', '[{\"kg\":\"2\",\"price\":\"15.28\"},{\"kg\":\"5\",\"price\":\"17.29\"},{\"kg\":\"10\",\"price\":\"21.00\"},{\"kg\":\"15\",\"price\":\"29.50\"},{\"kg\":\"20\",\"price\":\"40.00\"}]', 1),
            (0, 'matkahuolto', 'matkahuolto_hinnasto_3', '[{\"kg\":\"1\",\"price\":\"12.50\"},{\"kg\":\"2\",\"price\":\"12.90\"},{\"kg\":\"5\",\"price\":\"15.00\"},{\"kg\":\"10\",\"price\":\"18.00\"},{\"kg\":\"15\",\"price\":\"21.00\"},{\"kg\":\"20\",\"price\":\"24.00\"},{\"kg\":\"25\",\"price\":\"26.50\"},{\"kg\":\"30\",\"price\":\"28.00\"},{\"kg\":\"32\",\"price\":\"29.00\"}]', 1),
            (0, 'matkahuolto', 'matkahuolto_hinnasto_4', '[{\"kg\":\"2\",\"price\":\"18.90\"},{\"kg\":\"5\",\"price\":\"20.10\"},{\"kg\":\"10\",\"price\":\"24.10\"},{\"kg\":\"15\",\"price\":\"32.20\"},{\"kg\":\"20\",\"price\":\"42.50\"}]', 1)");
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/matkahuolto')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->request->post['matkahuolto_user_id'] && strlen($this->request->post['matkahuolto_user_id']) < 3) {
			$this->error['user_id'] = $this->language->get('error_user_id');
		}

		return !$this->error;
	}
}
