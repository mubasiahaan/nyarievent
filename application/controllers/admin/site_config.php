<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Category
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Site_config extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/site_config/';
        $this->data['menu'] = 'home';
        $this->load->model('configs_model', 'site_config');
        $this->data['active_menu'] = 'site_config';
    }

    function index() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_app_name', 'Application Name', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_app_author', 'Application Author', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_app_title', 'Application Title', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_app_desc', 'Application Description', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_app_keyword', 'Application Keyword', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                
            } else {
                $this->data['err_messages'] = get_messages(validation_errors());
            }
        }
        $this->data['app_meta'] = $this->get_config('app_meta', TRUE);
        $this->data['app_title'] = $this->get_config('app_title');
        $this->data['app_codename'] = $this->get_config('app_codename');
        $this->data['paging_rowlimit'] = $this->get_config('paging_rowlimit');
        $this->data['paging_numlinks'] = $this->get_config('paging_numlinks');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page_title'] = '<span class="icon icomoon-icon-equalizer"></span> Site Config';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

}

/**
 * End of file category.php
 * Location : ./application/controllers/admin/category.php
 */