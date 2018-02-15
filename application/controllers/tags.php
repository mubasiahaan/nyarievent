<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home
 *
 * @author  Vanderwyk Siahaan
 *         @date June 9th, 2014
 */
class Tags extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/';
        $this->page_dir = 'news/';
        $this->data['menu'] = 'tags';
        $this->load->model('content_model', 'content');
    }

    function index() {
        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['index'])) {
            $key_update = urldecode($param ['index']);
        }

        $where = "detail LIKE '%" . $key_update . "%'";
        $this->data['rec_data'] = $this->content->get_data(NULL, $where, NULL, NULL, 'id DESC');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function id() {
        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }
        $this->data['rec_detail'] = $this->content->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        $where = "status = 1 AND category_id = " . $this->data['rec_detail']->category_id . " AND id != $key_update ";
        $this->data['rec_related'] = $this->content->get_data(NULL, $where, 3, NULL, 'id DESC');





        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page('id'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
