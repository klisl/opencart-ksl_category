<?php
class ControllerExtensionModuleCategoryKsl extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/categoryKsl');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		//Если форма отправлена
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			//debug($this->request->post);
			$post = $this->request->post;
			$this->model_setting_setting->editSetting('categoryKsl', $post);
			$this->session->data['success'] = $this->language->get('text_success');
			
			//При нажатии на кнопку "сохранить", переадрессовываем на ту же страницу
			if (isset($post['ksl_save'])){
				$this->response->redirect($this->url->link('extension/module/categoryKsl', 'token=' . $this->session->data['token'], true));
			} else {
				$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
			}			
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_children'] = $this->language->get('entry_children');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['ksl_main_categories'] = $this->language->get('ksl_main_categories');
		$data['ksl_child_categories'] = $this->language->get('ksl_child_categories');
		$data['ksl_images'] = $this->language->get('ksl_images');
		$data['ksl_save'] = $this->language->get('ksl_save');
		$data['ksl_check'] = $this->language->get('ksl_check');
		$data['ksl_cancel'] = $this->language->get('ksl_cancel');
		$data['ksl_weight'] = $this->language->get('ksl_weight');
		$data['ksl_height'] = $this->language->get('ksl_height');
		$data['ksl_cat_label'] = $this->language->get('ksl_cat_label');
		$data['ksl_cat_p'] = $this->language->get('ksl_cat_p');
		
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		//Хлебные крошки
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/categoryKsl', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/categoryKsl', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		
		//Сохраняем в переменные значения полей для передачи в форму (значения по-умолчанию)
		if (isset($this->request->post['categoryKsl_status'])) {
			$data['categoryKsl_status'] = $this->request->post['categoryKsl_status'];
		} else {
			$data['categoryKsl_status'] = $this->config->get('categoryKsl_status');
		}
		if (isset($this->request->post['categoryKsl_children'])) {
			$data['categoryKsl_children'] = $this->request->post['categoryKsl_children'];
		} else {
			$data['categoryKsl_children'] = $this->config->get('categoryKsl_children');
		}
		if (isset($this->request->post['categoryKsl_images'])) {
			$data['categoryKsl_images'] = $this->request->post['categoryKsl_images'];
		} else {
			$data['categoryKsl_images'] = $this->config->get('categoryKsl_images');
		}
		if (isset($this->request->post['categoryKsl_img_weight'])) {
			$data['categoryKsl_img_weight'] = $this->request->post['categoryKsl_img_weight'];
		} else {
			$data['categoryKsl_img_weight'] = $this->config->get('categoryKsl_img_weight') ? $this->config->get('categoryKsl_img_weight') : 70;
		}
		if (isset($this->request->post['categoryKsl_img_height'])) {
			$data['categoryKsl_img_height'] = $this->request->post['categoryKsl_img_height'];
		} else {
			$data['categoryKsl_img_height'] = $this->config->get('categoryKsl_img_height') ? $this->config->get('categoryKsl_img_height') : 50;
		}
		if (isset($this->request->post['categoryKsl_checkbox'])) {
			$data['categoryKsl_checkbox'] = $this->request->post['categoryKsl_checkbox'];
		} else {
			$data['categoryKsl_checkbox'] = $this->config->get('categoryKsl_checkbox');
		}
		if (isset($this->request->post['categoryKsl_child_images'])) {
			$data['categoryKsl_child_images'] = $this->request->post['categoryKsl_child_images'];
		} else {
			$data['categoryKsl_child_images'] = $this->config->get('categoryKsl_child_images');
		}
		if (isset($this->request->post['categoryKsl_child_img_weight'])) {
			$data['categoryKsl_child_img_weight'] = $this->request->post['categoryKsl_child_img_weight'];
		} else {
			$data['categoryKsl_child_img_weight'] = $this->config->get('categoryKsl_child_img_weight') ? $this->config->get('categoryKsl_child_img_weight') : 40;
		}
		if (isset($this->request->post['categoryKsl_child_img_height'])) {
			$data['categoryKsl_child_img_height'] = $this->request->post['categoryKsl_child_img_height'];
		} else {
			$data['categoryKsl_child_img_height'] = $this->config->get('categoryKsl_child_img_height') ? $this->config->get('categoryKsl_child_img_height') : 28;
		}
		
		

		$this->load->model('catalog/category');
		//Подключаем свою модель, в которую переносим метод getCategories() из аналогичной модели в каталоге Catalog
		$this->load->model('catalog/categoryKsl'); 		
		$data['categories'] = array();		
		$categories = $this->model_catalog_categoryKsl->getCategories(0);
		

			foreach ($categories as $category) {
			$children_data = array();

				$children = $this->model_catalog_categoryKsl->getCategories($category['category_id']);

				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'],
					);
				}
				
			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);
			
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'children'    => $children_data,
			);
		}

		//подключаем js
		$this->document->addScript('view/javascript/categoryKSL/categoryKSL.js');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/categoryKsl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/categoryKsl')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
}