<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * About
 *
 * @author  Vanderwyk Siahaan
 *         @date april 29th, 2015
 */
class About extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/';
        $this->page_dir = 'about/';
        $this->data['menu'] = 'about';
        $this->load->model('info_model', 'info');
    }

    function index() {
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['title'] = 'history';
        $this->data['rec_info'] = $this->info->get_data('detail,preface', array('id' => 1), null, null, null, null, 'row');
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }
    
    function visi_misi() {
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['title'] = 'visi_misi';

        $this->data['rec_info'] = $this->info->get_data('detail,preface', array('id' => 3), null, null, null, null, 'row');

        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

}
