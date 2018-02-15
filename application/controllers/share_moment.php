<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home
 *
 * @author  Vanderwyk Siahaan
 *         @date June 9th, 2014
 */
class Share_moment extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/inside/';
        $this->page_dir = 'story/';
        $this->data['menu'] = 'story';
        $this->load->model('story_model', 'story');
        $this->load->model('category_model', 'category_story');
        foreach ($this->category_story->get_data("id, name") as $row) {
            $this->data['list_category_story'][$row->id] = $row->name;
        }
    }

    function index() {
        $param = $this->uri->uri_to_assoc(2);
        $this->data['key_update'] = '';
        if (!empty($param ['index'])) {
            $this->data['key_update'] = $param ['index'];
        }

        
        $this->data['rec_data'] = $this->story->get_data(null, array('status' => 1), 6, null, 'id DESC');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function detail() {

        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['detail'])) {
            $key_update = $param ['detail'];
        }

        $this->data['rec_detail'] = $this->story->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        $this->data['view'] = $this->data['rec_detail']->view + 1;
        $data = array(
            'view' => $this->data['view']
        );
        if ($this->story->edit_data($data, array('id' => $key_update))) {
            
        }

        $where = "status = 1 AND category_id = " . $this->data['rec_detail']->category_id . " AND id != $key_update ";
        $this->data['rec_related'] = $this->story->get_data(NULL, $where, 3, NULL, 'id DESC');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
