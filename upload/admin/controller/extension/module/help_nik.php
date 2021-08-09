<?php
class ControllerExtensionModuleHelpNik extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/help_nik');

		$this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

		$this->getList();
	}

    public function addSupport() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateSupportForm()) {
            $this->model_extension_module_help_nik->addHelpSupport($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormSupport();
    }

    public function editSupport() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateSupportForm()) {
            $this->model_extension_module_help_nik->editHelpSupport($this->request->get['help_support_id'],$this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormSupport();
    }

    public function deleteSupport() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (isset($this->request->get['help_support_id']) && $this->validateDelete()) {
            $this->model_extension_module_help_nik->deleteHelpSupport($this->request->get['help_support_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getList();
    }

    public function addCategory() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateCategoryForm()) {
            $this->model_extension_module_help_nik->addHelpCategory($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormCategory();
    }

    public function editCategory() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateCategoryForm()) {
            $this->model_extension_module_help_nik->editHelpCategory($this->request->get['help_category_id'],$this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormCategory();
    }

    public function deleteCategory() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (isset($this->request->get['help_category_id']) && $this->validateDelete()) {
            $this->model_extension_module_help_nik->deleteHelpCategory($this->request->get['help_category_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getList();
    }

    public function addArticle() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateArticleForm()) {
            $this->model_extension_module_help_nik->addHelpArticle($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormArticle();
    }

    public function editArticle() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateArticleForm()) {
            $this->model_extension_module_help_nik->editHelpArticle($this->request->get['help_article_id'],$this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormArticle();
    }

    public function deleteArticle() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (isset($this->request->get['help_article_id']) && $this->validateDelete()) {
            $this->model_extension_module_help_nik->deleteHelpArticle($this->request->get['help_article_id']);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getList();
    }

    public function saveHelpSettings() {
        $this->load->language('extension/module/help_nik');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/help_nik');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $post = $this->request->post;
            if (!isset($post['search_help_categories'])) {
                $post['search_help_categories'] = array();
            }
            if (!isset($post['display_help_articles'])) {
                $post['display_help_articles'] = array();
            }

            $this->model_extension_module_help_nik->saveHelpSettings($post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }

        $this->getFormHelpSetting();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'hsd.title';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
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
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['addSupport'] = $this->url->link('extension/module/help_nik/addSupport', 'user_token=' . $this->session->data['user_token'], true);
        $data['addCategory'] = $this->url->link('extension/module/help_nik/addCategory', 'user_token=' . $this->session->data['user_token'], true);
        $data['addArticle'] = $this->url->link('extension/module/help_nik/addArticle', 'user_token=' . $this->session->data['user_token'], true);
        $data['changeSettings'] = $this->url->link('extension/module/help_nik/saveHelpSettings', 'user_token=' . $this->session->data['user_token'], true);

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        $data['sort_support_title'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=hsd.title' . $url, true);
        $data['sort_support_sort_order'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=hs.sort_order' . $url, true);

        $data['sort_category_title'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=hcd.title' . $url, true);
        $data['sort_category_sort_order'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=hc.sort_order' . $url, true);

        $data['sort_article_title'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=had.title' . $url, true);
        $data['sort_article_sort_order'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . '&sort=ha.sort_order' . $url, true);

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
        );

        $results = $this->model_extension_module_help_nik->getHelpSupports($filter_data);

        foreach ($results as $result) {
            $data['help_supports'][] = array(
                'help_support_id' => $result['help_support_id'],
                'title'           => $result['title'],
                'sort_order'      => $result['sort_order'],
                'edit'            => $this->url->link('extension/module/help_nik/editSupport', 'user_token=' . $this->session->data['user_token'] . '&help_support_id=' . $result['help_support_id'], true),
                'delete'          => $this->url->link('extension/module/help_nik/deleteSupport', 'user_token=' . $this->session->data['user_token'] . '&help_support_id=' . $result['help_support_id'], true)
            );
        }

        $results = $this->model_extension_module_help_nik->getHelpCategories($filter_data);

        foreach ($results as $result) {
            $data['help_categories'][] = array(
                'help_category_id'      => $result['help_category_id'],
                'title'                 => $result['title'],
                'sort_order'            => $result['sort_order'],
                'edit'                  => $this->url->link('extension/module/help_nik/editCategory', 'user_token=' . $this->session->data['user_token'] . '&help_category_id=' . $result['help_category_id'], true),
                'delete'                => $this->url->link('extension/module/help_nik/deleteCategory', 'user_token=' . $this->session->data['user_token'] . '&help_category_id=' . $result['help_category_id'], true)
            );
        }

        $results = $this->model_extension_module_help_nik->getHelpArticles($filter_data);

        foreach ($results as $result) {
            $data['help_articles'][] = array(
                'help_article_id'       => $result['help_article_id'],
                'title'                 => $result['title'],
                'sort_order'            => $result['sort_order'],
                'edit'                  => $this->url->link('extension/module/help_nik/editArticle', 'user_token=' . $this->session->data['user_token'] . '&help_article_id=' . $result['help_article_id'], true),
                'delete'                => $this->url->link('extension/module/help_nik/deleteArticle', 'user_token=' . $this->session->data['user_token'] . '&help_article_id=' . $result['help_article_id'], true)
            );
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/help_list_nik', $data));
    }

    protected function getFormSupport() {
        $data['text_form'] = !isset($this->request->get['help_support_id']) ? $this->language->get('text_add_support') : $this->language->get('text_edit_support');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }

        if (isset($this->error['link'])) {
            $data['error_link'] = $this->error['link'];
        } else {
            $data['error_link'] = array();
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );

        $data['cancel'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true);

        if (isset($this->request->get['help_support_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $help_support_info = $this->model_extension_module_help_nik->getHelpSupport($this->request->get['help_support_id']);
            $help_support_description = $this->model_extension_module_help_nik->getHelpSupportDescription($this->request->get['help_support_id']);
        }

        if (isset($this->request->get['help_support_id'])) {
            $data['action'] = $this->url->link('extension/module/help_nik/editSupport', 'user_token=' . $this->session->data['user_token'] . '&help_support_id=' . $this->request->get['help_support_id'] . $url, true);
        } else {
            $data['action'] = $this->url->link('extension/module/help_nik/addSupport', 'user_token=' . $this->session->data['user_token'] . $url, true);
        }

        $data['user_token'] = $this->session->data['user_token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['help_support_description'])) {
            $data['help_support_description'] = $this->request->post['help_support_description'];
        } elseif (!empty($help_support_description)) {
            $data['help_support_description'] = $help_support_description;
        } else {
            $data['help_support_description'] = array();
        }

        $this->load->model('tool/image');

        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($help_support_info)) {
            $data['image'] = $help_support_info['image'];
        } else {
            $data['image'] = '';
        }

        $data['thumb'] = $data['image'] ? $this->model_tool_image->resize($data['image'], 100, 100) : $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($help_support_info)) {
            $data['sort_order'] = $help_support_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($help_support_info)) {
            $data['status'] = $help_support_info['status'];
        } else {
            $data['status'] = true;
        }

        $data['img_placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/help_support_form_nik', $data));
    }

    protected function getFormCategory() {
        $data['text_form'] = !isset($this->request->get['help_category_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = array();
        }

        if (isset($this->error['meta_title'])) {
            $data['error_meta_title'] = $this->error['meta_title'];
        } else {
            $data['error_meta_title'] = array();
        }

        if (isset($this->error['parent'])) {
            $data['error_parent'] = $this->error['parent'];
        } else {
            $data['error_parent'] = array();
        }

        if (isset($this->error['keyword'])) {
            $data['error_keyword'] = $this->error['keyword'];
        } else {
            $data['error_keyword'] = '';
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );

        if (!isset($this->request->get['help_category_id'])) {
            $data['action'] = $this->url->link('extension/module/help_nik/addCategory', 'user_token=' . $this->session->data['user_token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('extension/module/help_nik/editCategory', 'user_token=' . $this->session->data['user_token'] . '&help_category_id=' . $this->request->get['help_category_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true);

        if (isset($this->request->get['help_category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $help_category_info = $this->model_extension_module_help_nik->getHelpCategory($this->request->get['help_category_id']);
        }

        $data['user_token'] = $this->session->data['user_token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['help_category_description'])) {
            $data['help_category_description'] = $this->request->post['help_category_description'];
        } elseif (isset($this->request->get['help_category_id'])) {
            $data['help_category_description'] = $this->model_extension_module_help_nik->getHelpCategoryDescription($this->request->get['help_category_id']);
        } else {
            $data['help_category_description'] = array();
        }

        $this->load->model('setting/store');

        $data['stores'] = array();

        $data['stores'][] = array(
            'store_id' => 0,
            'name'     => $this->language->get('text_default')
        );

        $stores = $this->model_setting_store->getStores();

        foreach ($stores as $store) {
            $data['stores'][] = array(
                'store_id' => $store['store_id'],
                'name'     => $store['name']
            );
        }

        if (isset($this->request->post['help_category_store'])) {
            $data['help_category_store'] = $this->request->post['help_category_store'];
        } elseif (isset($this->request->get['help_category_id'])) {
            $data['help_category_store'] = $this->model_extension_module_help_nik->getHelpCategoryStores($this->request->get['help_category_id']);
        } else {
            $data['help_category_store'] = array(0);
        }

        if (isset($this->request->post['path'])) {
            $data['path'] = $this->request->post['path'];
        } elseif (!empty($help_category_info)) {
            $data['path'] = $this->model_extension_module_help_nik->getHelpCategoryParent($help_category_info['parent_id']);
        } else {
            $data['path'] = '';
        }

        if (isset($this->request->post['parent_id'])) {
            $data['parent_id'] = $this->request->post['parent_id'];
        } elseif (!empty($help_category_info)) {
            $data['parent_id'] = $help_category_info['parent_id'];
        } else {
            $data['parent_id'] = 0;
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($help_category_info)) {
            $data['sort_order'] = $help_category_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($help_category_info)) {
            $data['status'] = $help_category_info['status'];
        } else {
            $data['status'] = true;
        }

        if (isset($this->request->post['help_category_seo_url'])) {
            $data['help_category_seo_url'] = $this->request->post['help_category_seo_url'];
        } elseif (isset($this->request->get['help_category_id'])) {
            $data['help_category_seo_url'] = $this->model_extension_module_help_nik->getHelpCategorySeoUrls($this->request->get['help_category_id']);
        } else {
            $data['help_category_seo_url'] = array();
        }

        if (isset($this->request->post['help_category_layout'])) {
            $data['help_category_layout'] = $this->request->post['help_category_layout'];
        } elseif (isset($this->request->get['help_category_id'])) {
            $data['help_category_layout'] = $this->model_extension_module_help_nik->getHelpCategoryLayouts($this->request->get['help_category_id']);
        } else {
            $data['help_category_layout'] = array();
        }

        $this->load->model('design/layout');

        $data['layouts'] = $this->model_design_layout->getLayouts();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/help_category_form_nik', $data));
    }

    protected function getFormArticle() {
        $data['text_form'] = !isset($this->request->get['help_article_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = array();
        }

        if (isset($this->error['meta_title'])) {
            $data['error_meta_title'] = $this->error['meta_title'];
        } else {
            $data['error_meta_title'] = array();
        }

        if (isset($this->error['parent'])) {
            $data['error_parent'] = $this->error['parent'];
        } else {
            $data['error_parent'] = array();
        }

        if (isset($this->error['keyword'])) {
            $data['error_keyword'] = $this->error['keyword'];
        } else {
            $data['error_keyword'] = '';
        }

        if (isset($this->error['parent'])) {
            $data['error_parent'] = $this->error['parent'];
        } else {
            $data['error_parent'] = array();
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );

        if (!isset($this->request->get['help_article_id'])) {
            $data['action'] = $this->url->link('extension/module/help_nik/addArticle', 'user_token=' . $this->session->data['user_token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('extension/module/help_nik/editArticle', 'user_token=' . $this->session->data['user_token'] . '&help_article_id=' . $this->request->get['help_article_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true);

        if (isset($this->request->get['help_article_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $help_article_info = $this->model_extension_module_help_nik->getHelpArticle($this->request->get['help_article_id']);
        }

        $data['user_token'] = $this->session->data['user_token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['help_article_description'])) {
            $data['help_article_description'] = $this->request->post['help_article_description'];
        } elseif (isset($this->request->get['help_article_id'])) {
            $data['help_article_description'] = $this->model_extension_module_help_nik->getHelpArticleDescription($this->request->get['help_article_id']);
        } else {
            $data['help_article_description'] = array();
        }

        $this->load->model('setting/store');

        $data['stores'] = array();

        $data['stores'][] = array(
            'store_id' => 0,
            'name'     => $this->language->get('text_default')
        );

        $stores = $this->model_setting_store->getStores();

        foreach ($stores as $store) {
            $data['stores'][] = array(
                'store_id' => $store['store_id'],
                'name'     => $store['name']
            );
        }

        if (isset($this->request->post['help_article_store'])) {
            $data['help_article_store'] = $this->request->post['help_article_store'];
        } elseif (isset($this->request->get['help_article_id'])) {
            $data['help_article_store'] = $this->model_extension_module_help_nik->getHelpArticleStores($this->request->get['help_article_id']);
        } else {
            $data['help_article_store'] = array(0);
        }

        if (isset($this->request->post['path'])) {
            $data['path'] = $this->request->post['path'];
        } elseif (!empty($help_article_info)) {
            $data['path'] = $this->model_extension_module_help_nik->getHelpCategoryParent($help_article_info['help_category_id']);
        } else {
            $data['path'] = '';
        }

        if (isset($this->request->post['help_category_id'])) {
            $data['help_category_id'] = $this->request->post['help_category_id'];
        } elseif (!empty($help_article_info)) {
            $data['help_category_id'] = $help_article_info['help_category_id'];
        } else {
            $data['help_category_id'] = '';
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($help_article_info)) {
            $data['sort_order'] = $help_article_info['sort_order'];
        } else {
            $data['sort_order'] = 0;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($help_article_info)) {
            $data['status'] = $help_article_info['status'];
        } else {
            $data['status'] = true;
        }

        if (isset($this->request->post['help_article_seo_url'])) {
            $data['help_article_seo_url'] = $this->request->post['help_article_seo_url'];
        } elseif (isset($this->request->get['help_article_id'])) {
            $data['help_article_seo_url'] = $this->model_extension_module_help_nik->getHelpArticleSeoUrls($this->request->get['help_article_id']);
        } else {
            $data['help_article_seo_url'] = array();
        }

        if (isset($this->request->post['help_article_layout'])) {
            $data['help_article_layout'] = $this->request->post['help_article_layout'];
        } elseif (isset($this->request->get['help_article_id'])) {
            $data['help_article_layout'] = $this->model_extension_module_help_nik->getHelpArticleLayouts($this->request->get['help_article_id']);
        } else {
            $data['help_article_layout'] = array();
        }

        $this->load->model('design/layout');

        $data['layouts'] = $this->model_design_layout->getLayouts();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/help_article_form_nik', $data));
    }

    protected function getFormHelpSetting() {
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $help_settings = $this->model_extension_module_help_nik->getHelpSettings();

        $help_settings['search_help_categories'] = isset($help_settings['search_help_categories']) ? json_decode($help_settings['search_help_categories']) : array();
        $help_settings['display_help_articles'] = isset($help_settings['display_help_articles']) ? json_decode($help_settings['display_help_articles']) : array();

        $data['for_search_help_categories'] = array();
        $data['for_display_help_articles'] = array();
        $categories = $this->model_extension_module_help_nik->getHelpCategories();

        foreach ($categories as $category) {
            if ( !in_array($category['help_category_id'], $help_settings['search_help_categories']) ) {
                $data['for_search_help_categories'][] = array(
                    'help_category_id' => $category['help_category_id'],
                    'title' => $category['title'],
                );
            }
        }

        foreach ($categories as $category) {
            $help_articles = $this->model_extension_module_help_nik->getHelpArticlesByParent($category['help_category_id']);
            $not_added_help_articles = array();

            foreach ($help_articles as $help_article) {
                if ( !in_array($help_article['help_article_id'], $help_settings['display_help_articles']) ) {
                    $not_added_help_articles[] = $help_article;
                }
            }

            $data['for_display_help_categories'][] = array(
                'help_category_id' => $category['help_category_id'],
                'title' => $category['title'],
                'help_articles' => $not_added_help_articles
            );
        }

        $data['search_help_categories'] = array();

        foreach ($help_settings['search_help_categories'] as $search_help_category) {
            $help_category = $this->model_extension_module_help_nik->getHelpCategoryDescription($search_help_category);
            $help_category = $help_category[$this->config->get('config_language_id')];
            $data['search_help_categories'][] = array(
                'help_category_id' => $search_help_category,
                'title'            => $help_category['title']
            );
        }

        $data['display_help_articles'] = array();

        foreach ($help_settings['display_help_articles'] as $display_help_article) {
            $help_article = $this->model_extension_module_help_nik->getHelpArticleInfo($display_help_article);
            $data['display_help_articles'][] = array(
                'help_article_id' => $display_help_article,
                'help_category_id'=> $help_article['help_category_id'],
                'title'           => $help_article['title']
            );
        }

        $url = '';

        $data['action'] = $this->url->link('extension/module/help_nik/saveHelpSettings', 'user_token=' . $this->session->data['user_token'] . $url, true);

        $data['cancel'] = $this->url->link('extension/module/help_nik', 'user_token=' . $this->session->data['user_token'] . $url, true);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/help_settings_form_nik', $data));
    }

    public function autocompleteHelpCategory() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('extension/module/help_nik');

            $filter_data = array(
                'filter_name' => $this->request->get['filter_name'],
                'sort'        => 'name',
                'order'       => 'ASC',
                'start'       => 0,
                'limit'       => 5
            );

            $results = $this->model_extension_module_help_nik->getHelpCategories($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'help_category_id' => $result['help_category_id'],
                    'name'             => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function install() {
        if ($this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->load->model('extension/module/help_nik');

            $this->model_extension_module_help_nik->install();
        }
    }

    public function uninstall() {
        if ($this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->load->model('extension/module/help_nik');

            $this->model_extension_module_help_nik->uninstall();
        }
    }

    protected function validateSupportForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['help_support_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title_support');
            }

            if ((utf8_strlen($value['link']) < 1) || (utf8_strlen($value['link']) > 255)) {
                $this->error['link'][$language_id] = $this->language->get('error_link_support');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateCategoryForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['help_category_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title_support');
            }

            if ((utf8_strlen($value['description']) < 1) || (utf8_strlen($value['description']) > 255)) {
                $this->error['description'][$language_id] = $this->language->get('error_description');
            }

            if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
                $this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
            }
        }

        if (isset($this->request->get['help_category_id']) && $this->request->post['parent_id']) {
            $results = $this->model_extension_module_help_nik->getHelpCategoryPath($this->request->post['parent_id']);

            foreach ($results as $result) {
                if ($result['path_id'] == $this->request->get['help_category_id']) {
                    $this->error['parent'] = $this->language->get('error_parent');

                    break;
                }
            }
        }

        if ($this->request->post['help_category_seo_url']) {
            $this->load->model('design/seo_url');

            foreach ($this->request->post['help_category_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (!empty($keyword)) {
                        if (count(array_keys($language, $keyword)) > 1) {
                            $this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
                        }

                        $seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);

                        foreach ($seo_urls as $seo_url) {
                            if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['help_category_id']) || ($seo_url['query'] != 'help_category_id=' . $this->request->get['help_category_id']))) {
                                $this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');

                                break;
                            }
                        }
                    }
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateArticleForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['help_article_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title_support');
            }

            if ((utf8_strlen($value['description']) < 1) || (utf8_strlen($value['description']) > 255)) {
                $this->error['description'][$language_id] = $this->language->get('error_description');
            }

            if ((utf8_strlen($value['meta_title']) < 1) || (utf8_strlen($value['meta_title']) > 255)) {
                $this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
            }
        }

        if (isset($this->request->post['help_category_id']) && strlen($this->request->post['help_category_id']) < 1) {
            $this->error['parent'] = $this->language->get('error_article_parent');
        }

        if ($this->request->post['help_article_seo_url']) {
            $this->load->model('design/seo_url');

            foreach ($this->request->post['help_article_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (!empty($keyword)) {
                        if (count(array_keys($language, $keyword)) > 1) {
                            $this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
                        }

                        $seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);

                        foreach ($seo_urls as $seo_url) {
                            if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['help_article_id']) || ($seo_url['query'] != 'help_article_id=' . $this->request->get['help_article_id']))) {
                                $this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');

                                break;
                            }
                        }
                    }
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'extension/module/help_nik')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/help_nik')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}