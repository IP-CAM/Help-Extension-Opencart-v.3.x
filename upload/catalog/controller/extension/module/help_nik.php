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
}