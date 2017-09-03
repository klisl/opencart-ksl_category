<?php
class ControllerExtensionModuleCategoryKsl extends Controller {
	public function index() {
	
		//Определяем текущую категорию (path из GET запроса)
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		if (isset($parts[0])) {
			$data['category_id'] = $parts[0]; //родительская
		} else {
			$data['category_id'] = 0;
		}
		if (isset($parts[1])) {
			$data['child_id'] = $parts[1]; //дочерняя
		} else {
			$data['child_id'] = 0;
		}

		if($data['child_id']) $data['category_id'] = null;

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$data['categories'] = array();
		$categories = $this->model_catalog_category->getCategories(0);

		//Загружаем модель которая работает с таблицей настроек модулей (oc_setting)
		$this->load->model('setting/setting');

		//Получаем значение - показывать ли изображения
		$category_images = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_images'];
		//Получаем значение - размеры изображений
		$category_images_height = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_img_height'];
		$category_images_weight = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_img_weight'];

		//Для дочерних категорий
		$category_children = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_children'];
		$category_child_images = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_child_images'];
		$category_child_images_height = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_child_img_height'];
		$category_child_images_weight = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_child_img_weight'];

		//Массив категорий, которые не нужно выводить
		if(isset($this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_checkbox'])){
			$categoryKsl_checkbox = $this->model_setting_setting->getSetting('categoryKsl')['categoryKsl_checkbox'];
		} else $categoryKsl_checkbox = null;

		foreach ($categories as $category) {

			//Пропускаем, если в настройках указано отключить данную категорию
			if (isset($categoryKsl_checkbox[$category['category_id']])) {
				continue;				
			}
			$children_data = array();

			if ($category_children) {

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					//Пропускаем, если в настройках указано отключить данную категорию
					if (isset($categoryKsl_checkbox[$child['category_id']])) {
						continue;				
					}
			
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					//Работа с изображениями			
					if ($category_child_images && is_file(DIR_IMAGE . $child['image'])) {
						$this->load->model('tool/image');
						//метод создает изображения указанного размера
						$image = $this->model_tool_image->resize($child['image'], $category_child_images_weight, $category_child_images_height);
					} else {
						$image = '';
					}
			
					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
						'image' => $image,
					);
				}
			}
			
			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			//Работа с изображениями			
			if ($category_images && is_file(DIR_IMAGE . $category['image'])) {
				$this->load->model('tool/image');
				//метод создает изображения указанного размера
				$image = $this->model_tool_image->resize($category['image'], $category_images_weight, $category_images_height);
			} else {
				$image = '';
			}
			
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id']),
				'image' => $image,
			);
		}	
		//Добавляем свои стили
		$this->document->addStyle('catalog/view/theme/default/stylesheet/categoryKSL.css');
		
		return $this->load->view('extension/module/categoryKsl', $data);
	}
}