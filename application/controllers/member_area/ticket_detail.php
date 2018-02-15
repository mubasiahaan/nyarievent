<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Content
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Ticket_detail extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_user_login();
        $this->layout_dir = 'member_area/layout/';
        $this->page_dir = 'member_area/ticket_detail/';
        $this->data['active_menu'] = 'Inbox';
        $this->data['controler'] = 'ticket_detail';
        $this->load->model('ticket_detail_model', 'detail');
        $this->load->model('ticket_model', 'ticket');
        $this->load->model('gallery_model', 'gallery');
        $this->load->model('category_model', 'category');
        $this->load->model('city_model', 'city');
        $this->load->library('upload');

        $this->data ['navigation'] = array('member_area/home' => 'Dashboard');
        $this->data['list_directory'] = $this->category->get_data();

        $where = 'status = 1';
        foreach ($this->category->get_data(null, $where) as $row) {
            $this->data['category_id'][$row->id] = $row->name;
        }
        foreach ($this->city->get_data(null, $where) as $row) {
            $this->data['city_id'][$row->id] = $row->name;
        }
        $this->load->model('users_model', 'user');
        $key_update = $this->session->userdata('sess-id');
        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');
        
        $this->data['list_status'][1] = 'open';
        $this->data['list_status'][2] = 'closed';
        $this->data['list_status']["all"] = "All";
    }

    function index() {
        $id = $this->uri->segment(4);
        $this->data['rec_data'] = $this->ticket->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data ['list_data'] = $this->detail->get_data(null, array('ticket_id' => $id, 'status' => 1));
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);

        $this->render();
    }

    function add() {
        $this->data['cat_id'] = $this->uri->segment(4);

        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Add ' . $this->data['active_menu'];

        $this->data ['navigation']['admin/detail/index/' . $this->data['cat_id']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';

        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = array(
                    'ticket_id' => $this->data['cat_id'],
                    'detail' => $this->input->post('txt_detail'),
                    'status' => 1,
                    'insert_user' => $this->session->userdata('sess-id'),
                    'insert_date' => date('Y-m-d h:i:s')
                );

                $ubah = $this->ticket->edit_data(array('respon_status' => 0), array('id' => $this->data['cat_id']));

                if ($this->detail->add_data($data)) {
                    $this->session->set_flashdata('info_messages', 'Data successfully added');
                    redirect(site_url('member_area/' . $this->data['controler'] . '/index/' . $this->data['cat_id']));
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

}

/**
 * End of file article.php
 * Location : ./application/controllers/member_area/article.php
 */