<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    protected $layout_dir;
    protected $fragment_dir;
    protected $page_dir;

    function __construct() {
        parent::__construct();
        /**
         * load parser library
         */
        $this->load->library('parser');
        /**
         * load configs model
         */
        $this->load->model('configs_model', 'configs');
        $this->__init();
    }

    function __init() {
        /**
         * define global constant - fetching all application configuration
         */
        define('APP_NAME', $this->get_config('app_app_name'));
        define('BASE_URL', $this->get_config('app_base_url'));
        define('MODULE_PATH', APPPATH . 'modules/');
        define('ASSETS_PATH', $this->get_config('app_assets_path') . '/');
        define('CSS_PATH', ASSETS_PATH . 'css/');
        define('JS_PATH', ASSETS_PATH . 'js/');
        define('CSS_PATH_ADMIN', ASSETS_PATH . 'admin/css/');
        define('JS_PATH_ADMIN', ASSETS_PATH . 'admin/js/');
        define('IMG_PATH', ASSETS_PATH . 'img/');
        define('PLUGIN_PATH', ASSETS_PATH . 'plugins/');
        define('FONT_PATH', ASSETS_PATH . 'fonts/');
        define('UPLOADED_PATH', ASSETS_PATH . 'uploads/');
        define('UPLOAD_PATH_IMG_PROFILE', realpath(APPPATH . '../assets/uploads/images/profile'));
        define('UPLOAD_PATH_IMG', realpath(APPPATH . '../assets/uploads/images/'));
        define('UPLOAD_PATH_MAIN', realpath(APPPATH . '../assets/uploads/images/main/'));
        define('UPLOAD_PATH_FILE', realpath(APPPATH . '../assets/uploads/files/'));
        define('UPLOAD_PATH_THUMBS', realpath(APPPATH . '../assets/uploads/images/thumbs/'));
        define('IMG_UPLOADED', ASSETS_PATH . 'uploads/images/');
        define('IMG_UPLOADED_MAIN', ASSETS_PATH . 'uploads/images/main/');
        define('IMG_UPLOADED_THUMBS', ASSETS_PATH . 'uploads/images/thumbs/');
        define('TIMEZONE', $this->get_config('app_default_timezone'));

        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set(TIMEZONE);
        }

        // setup default data property
        $this->data ['form_validation_errors'] = '';
        $this->data ['err_msg'] = '';
        $this->data ['info_msg'] = '';

        // setup metadata and html page properties
        $this->data ['html_title'] = $this->get_config('app_title');
        $this->data ['html_meta'] = $this->get_config('app_meta', TRUE);
        $this->data ['html_link'] = $this->get_config('app_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_script', TRUE);
        $this->data ['html_admin_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_admin_script'] = $this->get_config('app_admin_script', TRUE);
        $this->data ['page_icon'] = $this->get_config('app_icon');
        $this->data ['seo'] = $this->get_config('app_meta');
        $this->data['img_src'] = IMG_PATH . 'logo.png';
        $this->data['link_share'] = site_url();
        $this->data ['page_title'] = 'My Application';
        $this->data['app_name'] = $this->get_config('app_name');

        // setup for data paging and view
        $this->data ['max_rows'] = $this->get_config('paging_rowlimit');
        $this->data ['numlinks'] = $this->get_config('paging_numlinks');

        //setup menu news

        $this->load->model('category_model', 'menu_category');
        $this->data['sub_menu_news'] = $this->menu_category->get_data("id, name", array('status' => 1));

        $this->data['menu'] = "";
        $this->data['sub_menu'] = "";

        //load info
        $this->load->model('info_model', 'info');
        $this->data['web_info'] = $this->info->get_contact();
    }

    function is_admin_login() {
        if (!$this->session->userdata('is_admin')) {
            redirect('admin/login');
        } else {
            $this->data ['userdata'] = $this->session->userdata('sess-user');
        }
    }

    function is_user_login() {
        if (!$this->session->userdata('sess-loggedin')) {
            redirect(site_url('login'));
        } else {
            $this->data ['userdata'] = $this->session->userdata('sess-user');
        }
    }

    function get_config($set_name, $convertoarr = FALSE, $delimiter = ',') {
        $result = NULL;
        $this->data ['configs'] [$set_name] = $this->configs->get_data(NULL, array(
            'config_name' => $set_name
                ), NULL, NULL, NULL, NULL, 'row');

        if (!empty($this->data ['configs'] [$set_name]->config_value)) {
            $config_type = $this->data ['configs'] [$set_name]->config_type;

            // parse value to get the right configs value
            preg_match_all('/(?<=\{\b)(\w+)(?=\})\b/', $this->data ['configs'] [$set_name]->config_value, $matches);
            $matches = array_unique($matches [1]);
            if (!empty($matches)) {
                foreach ($matches as $match) {
                    if (!isset($this->data ['configs'] [$match])) {
                        $this->get_config($match);
                    }
                    if (isset($this->data ['configs'] [$match])) {
                        $this->data ['configs'] [$set_name]->config_value = str_ireplace('{' . $match . '}', ($config_type === 'json') ? addcslashes($this->data ['configs'] [$match]->config_value, '/"') : $this->data ['configs'] [$match]->config_value, $this->data ['configs'] [$set_name]->config_value);
                    }
                }
            }
            $config_value = $this->data ['configs'] [$set_name]->config_value;
            if ($config_type === 'serial') {
                $config_value = preg_replace_callback('/s:(\d+):"(.*?)";/s', function ($m) {
                    return 's:' . strlen("{$m[2]}") . ':"' . $m [2] . '";';
                }, $config_value);
                $result = $convertoarr ? unserialize($config_value) : $config_value;
            } elseif ($config_type === 'json') {
                $result = $convertoarr ? object_to_array(json_decode($config_value)) : $config_value;
            } else {
                $result = $convertoarr ? explode($config_value, $delimiter) : $config_value;
            }
        }

        return $result;
    }

    protected function get_page($filename = 'index') {
        return $this->page_dir . $filename;
    }

    protected function render($filename = 'index', $buff = FALSE) {
        return $this->load->view($this->layout_dir . $filename, $this->data, $buff);
    }

    protected function build_pagination($base_url = '', $uri_segment = NULL, $total_rows = 0, $limit = 10, $num_links = 10) {
        $this->load->library('pagination');

        if (is_array($base_url)) {
            $base_url_val = $base_url [0];
            if (!empty($base_url [1])) {
                $fragment_val = $base_url [1];
            }
        } else {
            $base_url_val = $base_url;
            $fragment_val = '';
        }

        $config = array(
            'base_url' => $base_url_val,
            'total_rows' => $total_rows,
            'per_page' => $limit,
            'num_links' => $num_links,
            'uri_segment' => $uri_segment,
            'full_tag_open' => '<div class="text-center"><ul class="pagination">',
            'full_tag_close' => '</ul></div>',
            'use_page_numbers' => TRUE,
            'cur_tag_open' => '<li class="active"><a href="javascript:void(0);">',
            'cur_tag_close' => "</a></li>",
            'first_link' => 'First',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_link' => '&raquo;',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_link' => '&laquo;',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'fragment' => $base_url_val
        );

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    protected function load_form_validation() {
        $this->form_validation->set_error_delimiters("<p class='error-item'>", "</p>");
    }

    protected function get_fragment($fragment_dir = 'fragment') {
        $this->data ['fragment'] = $this->input->post('fragment');
        $this->fragment_dir = $this->page_dir . $fragment_dir . '/';
    }

}

/**
 * End of file MY_Controller.php
 * Location : ./application/core/MY_Controller.php
 */