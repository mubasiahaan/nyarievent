<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Content
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Upgrade extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_user_login();
        $this->layout_dir = 'member_area/layout/';
        $this->page_dir = 'member_area/upgrade/';
        $this->data['active_menu'] = 'Upgrade';
        $this->data['controler'] = 'upgrade';
        $this->load->model('gold_confirm_model', 'gold_confirm');

        $this->data ['navigation'] = array('member_area/home' => 'Dashboard');

        $this->load->model('users_model', 'user');
        $key_update = $this->session->userdata('sess-id');
        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');
        $this->data['list_status'][1] = 'pending';
        $this->data['list_status'][2] = 'received';
        $this->data['list_status'][3] = 'rejected';
        $this->data['list_status']["all"] = "All";
    }

    function index() {
        $this->data['rec_gold'] = $this->info->get_data(null, array('id' => 4), null, null, null, null, 'row');
        
        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $where = "status != 0 AND insert_user =" . $this->session->userdata('sess-id');
        $this->data ['list_data'] = $this->gold_confirm->get_data(null, $where, null, null, null, 'id desc');
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data['cat_id'] = $this->uri->segment(4);
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Add ' . $this->data['active_menu'];
        $this->data ['navigation']['admin/gold_confirm/index/' . $this->data['cat_id']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';

        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;


        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_transfer_date', 'Tanggal Transfer', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_total', 'Total transfer', 'trim|numeric|xss_clean|required');
            $this->form_validation->set_rules('txt_validation', 'Kode Validasi', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_account', 'Nama Account', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_message', 'Pesan ', 'trim|xss_clean');

            if ($this->form_validation->run()) {

                $data = array(
                    'transfer_date' => $this->input->post('txt_transfer_date'),
                    'total' => $this->input->post('txt_total'),
                    'validation' => $this->input->post('txt_validation'),
                    'account' => $this->input->post('txt_account'),
                    'message' => $this->input->post('txt_message'),
                    'status' => 1,
                    'insert_user' => $this->session->userdata('sess-id'),
                    'update_user' => $this->session->userdata('sess-id'),
                    'insert_date' => date('Y-m-d h:i:s')
                );

                if ($this->gold_confirm->add_data($data)) {
                    $this->session->set_flashdata('info_messages', 'Data successfully added');
                    redirect(site_url('member_area/' . $this->data['controler']));
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
        $this->data['rec_data'] = $this->gold_confirm->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['navigation']['admin/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';
        $this->data ['page_title'] = 'Update ' . $this->data['active_menu'];
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_transfer_date', 'Tanggal Transfer', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_total', 'Total transfer', 'trim|numeric|xss_clean|required');
            $this->form_validation->set_rules('cbo_insert_user', 'User', 'trim|numeric|xss_clean|required');
            $this->form_validation->set_rules('txt_validation', 'Kode Validasi', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_account', 'Nama Account', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_message', 'Pesan ', 'trim|xss_clean');

            if ($this->form_validation->run()) {

                $data = array(
                    'transfer_date' => $this->input->post('txt_transfer_date'),
                    'total' => $this->input->post('txt_total'),
                    'validation' => $this->input->post('txt_validation'),
                    'account' => $this->input->post('txt_account'),
                    'message' => $this->input->post('txt_message'),
                    'insert_user' => $this->input->post('cbo_insert_user'),
                    'update_user' => $this->session->userdata('sess-id'),
                    'update_date' => date('Y-m-d h:i:s')
                );

                if ($this->gold_confirm->edit_data($data, array('id' => $id))) {
                    $this->session->set_flashdata('info_messages', 'Data successfully updated');
                    redirect(site_url('admin/' . $this->data['controler']));
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

}

/**
 * End of file article.php
 * Location : ./application/controllers/member_area/article.php
 */