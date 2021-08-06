<?php
class ControllerExtensionModuleHelpNik extends Controller {
	public function index() {
		$this->load->language('extension/module/help_nik');
		$this->load->model('extension/module/help_nik');
		$this->load->model('tool/image');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['faq'] = $this->url->link('extension/module/help_nik/faq', '', true);

        $data['search_help_categories'] = $this->getUnderSearchCategories();

        $data['supports'] = $this->model_extension_module_help_nik->getHelpSupports();

        foreach ($data['supports'] as $key => $support) {
            if ($support['description']) {
                $data['supports'][$key]['description'] = html_entity_decode($support['description']);
            }

            if ($support['image']) {
                $data['supports'][$key]['thumb'] = $this->model_tool_image->resize($support['image'], 40, 40);
            } else {
                $data['supports'][$key]['thumb'] = '';
            }
        }

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('extension/module/help_nik', $data));
	}

	public function faq() {
        $this->load->language('extension/module/help_nik');
        $this->load->model('extension/module/help_nik');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_certificate'),
            'href' => $this->url->link('extension/module/help_nik')
        );

        $data['search_help_categories'] = $this->getUnderSearchCategories();

        $help_categories = $this->model_extension_module_help_nik->getHelpCategories();
        $data['help_categories'] = $this->buildTree($help_categories);

        echo "<pre>";
        print_r($data['help_categories']);
        echo "</pre>";

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('extension/module/help_faq_nik', $data));
    }

    private function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            $element['articles'] = $this->model_extension_module_help_nik->getHelpArticles($element['help_category_id']);

            if ($element['parent_id'] == $parentId) {

                $children = $this->buildTree($elements, $element['help_category_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    protected function getUnderSearchCategories() {
        $this->load->model('extension/module/help_nik');

        $help_settings = $this->model_extension_module_help_nik->getHelpSettings();
        $data['search_help_categories'] = array();

        if (isset($help_settings['search_help_categories'])) {
            $help_settings['search_help_categories'] = json_decode($help_settings['search_help_categories']);
            $search_help_categories = array();

            foreach ($help_settings['search_help_categories'] as $search_help_category) {
                $search_help_categories[] = $this->model_extension_module_help_nik->getHelpCategory($search_help_category);
            }

            foreach ($search_help_categories as $search_help_category) {
                $data['search_help_categories'][] = array(
                    'help_category_id' => $search_help_category['help_category_id'],
                    'title'            => $search_help_category['title'],
                    'sort_order'       => $search_help_category['sort_order'],
                    'link'             => $this->url->link('extension/module/help_nik/faq', 'help_category_id=' . $search_help_category['help_category_id'], true),
                );
            }

            $sort_order = array();

            foreach ($data['search_help_categories'] as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $data['search_help_categories']);
        }

        return $data['search_help_categories'];
    }
}