<?php
class ControllerExtensionModuleHelpNik extends Controller {
	public function index() {
		$this->load->language('extension/module/help_nik');
		$this->load->model('extension/module/help_nik');
        $this->load->model('setting/setting');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['faq'] = $this->url->link('extension/module/help_nik/faq', '', true);

        $settings = $this->model_setting_setting->getSetting('module_help_nik', $this->config->get('config_store_id'));

        $display_help_articles = array();
        $data['display_help_articles'] = array();

        if(isset($settings['module_help_nik_display_articles']) && !empty($settings['module_help_nik_display_articles'])) {
            foreach ($settings['module_help_nik_display_articles'] as $display_help_article) {
                $display_help_articles[] = $this->model_extension_module_help_nik->getHelpArticle($display_help_article);
            }

            foreach ($display_help_articles as $display_help_article) {
                $data['display_help_articles'][] = array(
                    'help_article_id' => $display_help_article['help_article_id'],
                    'title'           => $display_help_article['title'],
                    'description'     => html_entity_decode($display_help_article['description']),
                );
            }
        }

        return $this->load->view('extension/module/help_module_nik', $data);
	}

	public function help() {
        $this->load->language('extension/module/help_nik');
        $this->load->model('extension/module/help_nik');
        $this->load->model('tool/image');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['faq'] = $this->url->link('extension/module/help_nik/faq', '', true);

        $data['search_help_categories'] = $this->getUnderSearchCategories();

        $help_settings = $this->model_extension_module_help_nik->getHelpSettings();

        $data['display_help_articles'] = array();

        if (isset($help_settings['display_help_articles'])) {
            $help_settings['display_help_articles'] = json_decode($help_settings['display_help_articles']);
            $display_help_articles = array();

            foreach ($help_settings['display_help_articles'] as $display_help_article) {
                $display_help_articles[] = $this->model_extension_module_help_nik->getHelpArticle($display_help_article);
            }

            foreach ($display_help_articles as $display_help_article) {
                $data['display_help_articles'][] = array(
                    'help_article_id' => $display_help_article['help_article_id'],
                    'title'           => $display_help_article['title'],
                    'description'     => html_entity_decode($display_help_article['description']),
                );
            }
        }

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

        if (isset($this->request->get['help_search'])) {
            $search = $this->request->get['help_search'];
        } else {
            $search = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $url = '';

        if (isset($this->request->get['search'])) {
            $url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
        }

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_certificate'),
            'href' => $this->url->link('extension/module/help_nik/help', $url)
        );

        $data['search_help_categories'] = $this->getUnderSearchCategories();

        if (isset($this->request->get['help_search'])) {
            $this->document->setTitle($this->language->get('heading_title'));

            $filter_data = array(
                'filter_title' => $search
            );

            $help_categories = $this->model_extension_module_help_nik->getHelpCategoriesBySearch($filter_data);

            $root_categories_ids = array();
            $data['parents_help_categories_ids'] = array();

            foreach ($help_categories as $help_category) {
                $root_categories_ids[] = $this->getRootCategoryId($help_category);
                $parents_categories_id = $this->getParentsCategoryId($help_category);
                $data['parents_help_categories_ids'] = array_merge($data['parents_help_categories_ids'], $parents_categories_id);
                $data['parents_help_categories_ids'][] = $help_category['help_category_id'];
            }

            $data['parents_help_categories_ids'] = array_unique($data['parents_help_categories_ids']);

            $help_categories = $this->model_extension_module_help_nik->getHelpCategories();

            $all_categories = $this->buildTree($help_categories);

            $data['help_categories'] = array();

            foreach ($all_categories as $root_category) {
                if (in_array($root_category['help_category_id'], $root_categories_ids)) {
                    $data['help_categories'][] = $root_category;
                }
            }
            $data['help_search'] = $search;
        } else if (isset($this->request->get['help_category_id'])) {
            $selected_category = $this->model_extension_module_help_nik->getHelpCategory($this->request->get['help_category_id']);

            $this->document->setTitle($selected_category['meta_title']);
            $this->document->setDescription($selected_category['meta_description']);
            $this->document->setKeywords($selected_category['meta_keyword']);

            $root_category_id = $this->getRootCategoryId($selected_category);

            $data['parents_help_categories_ids'] = $this->getParentsCategoryId($selected_category);

            $data['parents_help_categories_ids'][] = $this->request->get['help_category_id'];

            $help_categories = $this->model_extension_module_help_nik->getHelpCategories();

            $all_categories = $this->buildTree($help_categories);

            $data['help_categories'] = array();

            foreach ($all_categories as $root_category) {
                if ((int)$root_category['help_category_id'] == (int)$root_category_id) {
                    $data['help_categories'][] = $root_category;
                }
            }
        } else {
            $this->document->setTitle($this->language->get('heading_title'));
            $help_categories = $this->model_extension_module_help_nik->getHelpCategories();
            $data['help_categories'] = $this->buildTree($help_categories);
        }

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
            $element['description'] = html_entity_decode($element['description']);

            foreach ($element['articles'] as $key => $article) {
                $element['articles'][$key]['description'] = html_entity_decode($article['description']);
            }

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

    private function getParentsCategoryId($category) {
        $parents_categories_ids = array();

        if ($category['parent_id'] != '0') {
            $parents_categories_ids[] = $category['parent_id'];
            $parent_category = $this->model_extension_module_help_nik->getHelpCategory($category['parent_id']);
            $parents_categories_ids = array_merge($parents_categories_ids, $this->getParentsCategoryId($parent_category));
        }

        return $parents_categories_ids;
    }

    private function getRootCategoryId($category) {
        if ($category['parent_id'] == '0') {
            return $category['help_category_id'];
        }

        if ($category['parent_id'] != '0') {
            $parent_category = $this->model_extension_module_help_nik->getHelpCategory($category['parent_id']);
            return $this->getRootCategoryId($parent_category);
        }
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
                    'link'             => $this->url->link('extension/module/help_nik/faq', 'help_category_id=' . $search_help_category['help_category_id']),
                );
            }

//            $sort_order = array();
//
//            foreach ($data['search_help_categories'] as $key => $value) {
//                $sort_order[$key] = $value['sort_order'];
//            }
//
//            array_multisort($sort_order, SORT_ASC, $data['search_help_categories']);
        }

        return $data['search_help_categories'];
    }
}