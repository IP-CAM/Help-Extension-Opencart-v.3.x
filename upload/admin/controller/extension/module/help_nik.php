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

        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

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
            $data['sort_order'] = '';
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