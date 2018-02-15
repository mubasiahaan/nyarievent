<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Content
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Comment extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/comment/';
        $this->data['active_menu'] = 'Comment';
        $this->data['controler'] = 'comment';
        $this->load->model('comment_model', 'comment');
        $this->load->model('forum_model', 'forum');
        $this->load->model('category_forum_model', 'category_forum');
        $this->data ['navigation'] = array('admin/home' => 'Dashboard');
        $where = 'status = 1';
        foreach ($this->category_forum->get_data(null, $where) as $row) {
            $this->data['category_id'][$row->id] = $row->name;
        }
    }

    function index() {
        $id = $this->uri->segment(4);
        $this->data['rec_data'] = $this->forum->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data ['list_data'] = $this->comment->get_data(null, array('thread_id' => $id, 'status' => 1));
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);

        $this->render();
    }

    function index_category() {
        $this->data['cat_id'] = $this->uri->segment(4);
        $this->data['rec_data'] = $this->category->get_data(null, array('id' => $this->data['cat_id']), null, null, null, null, 'row');
        $this->data['active_menu'] = $this->data['rec_data']->name;
        $this->data ['navigation']['#'] = $this->data['active_menu'];

        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data ['list_data'] = $this->comment->get_data(null, array('status' => 1, 'category_id' => $this->data['cat_id']));
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data['cat_id'] = $this->uri->segment(4);

        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Add ' . $this->data['active_menu'];

        $this->data ['navigation']['admin/comment/index/' . $this->data['cat_id']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';

        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = array(
                    'thread_id' => $this->data['cat_id'],
                    'detail' => $this->input->post('txt_detail'),
                    'insert_user' => $this->session->userdata('sess-id'),
                    'insert_date' => date('Y-m-d h:i:s')
                );

                if ($this->comment->add_data($data)) {
                    $this->session->set_flashdata('info_messages', 'Data successfully added');
                    redirect(site_url('admin/' . $this->data['controler'] . '/index/' . $this->data['cat_id']));
                } else {
                    $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }

        $this->data ['page'] = $this->load->view($this->get_page('add'), $this->data, true);
        $this->render();
    }

    function update() {

        $id = $this->uri->segment(4);
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data['rec_data'] = $this->comment->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';

        $this->data ['navigation']['admin/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';

        $this->data ['page_title'] = 'Update ' . $this->data['active_menu'];
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean|required');

            if ($this->form_validation->run()) {
                $data = array(
                    'detail' => $this->input->post('txt_detail'),
                    'update_user' => $this->session->userdata('sess-id'),
                    'update_date' => date('Y-m-d h:i:s')
                );
                if ($this->comment->edit_data($data, array('id' => $id))) {
                    $this->session->set_flashdata('info_messages', 'Data successfully updated');
                    redirect(site_url('admin/' . $this->data['controler'] . '/index/' . $this->data['rec_data']->thread_id));
                } else {
                    $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }

        $this->data ['page'] = $this->load->view($this->get_page('update'), $this->data, true);
        $this->render();
    }

    function delete() {
        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);
        $ubah = $this->comment->edit_data(array('status' => 0), array('id' => $id));
        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }
        redirect(site_url('admin/comment/index/' . $page));
    }

}

/**
 * End of file article.php
 * Location : ./application/controllers/admin/article.php
 */