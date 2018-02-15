<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home
 *
 * @author  Vanderwyk Siahaan
 *         @date June 9th, 2014
 */
class News extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/';
        $this->page_dir = 'news/';
        $this->data['menu'] = 'news';
        $this->load->model('news_model', 'news');
        $this->load->model('category_news_model', 'category_news');
        foreach ($this->category_news->get_data("id, name") as $row) {
            $this->data['list_category_news'][$row->id] = $row->name;
        }
    }

    function index() {
        $param = $this->uri->uri_to_assoc(2);
        $this->data['key_update'] = '';
        if (!empty($param ['index'])) {
            $this->data['key_update'] = $param ['index'];
        }

        $this->data['sub_menu'] = $this->data['list_category_news'][$this->data['key_update']];

        $this->data['rec_data'] = $this->news->get_data(NULL, array('status' => 1, 'category_id' => $this->data['key_update']), NULL, NULL, 'id DESC');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function detail() {
        $this->load->model('news_comment_model', 'comment');
        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['detail'])) {
            $key_update = $param ['detail'];
        }
        if ($this->session->userdata('sess-loggedin')) {
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');
                if ($this->form_validation->run()) {
                    $data = array(
                        'news_id' => $key_update,
                        'detail' => $this->input->post('txt_detail'),
                        'insert_user' => $this->session->userdata('sess-id'),
                        'insert_date' => date('Y-m-d h:i:s')
                    );
                    if ($this->comment->add_data($data)) {
                        $this->session->set_flashdata('info_messages', 'Data successfully added');
                    } else {
                        $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                    }
                } else {
                    $this->data ['form_validation_errors'] = get_messages(validation_errors());
                }
            }
        }

        $this->data['rec_detail'] = $this->news->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        $where = "status = 1 AND category_id = " . $this->data['rec_detail']->category_id . " AND id != $key_update ";
        $this->data['rec_related'] = $this->news->get_data(NULL, $where, 3, NULL, 'id DESC');

        $where = "status = 1 AND news_id = $key_update ";
        $this->data['rec_comment'] = $this->comment->get_data(NULL, $where, NULL, NULL, 'id ASC');

        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
