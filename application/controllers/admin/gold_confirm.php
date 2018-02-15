<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Content
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Gold_confirm extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_user_login();
        
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/gold_confirm/';
        $this->data['active_menu'] = 'Gold Confirm';
        $this->data['controler'] = 'gold_confirm';
        $this->load->model('gold_confirm_model', 'gold_confirm');
        $this->load->model('users_model', 'users');

        $this->load->library('upload');

        $this->data ['navigation'] = array('admin/home' => 'Dashboard');


        $where = 'status != 0';

        foreach ($this->users->get_data(null, $where) as $row) {
            $this->data['list_users'][$row->id] = $row->name;
        }


        $this->data['list_status'][1] = 'pending';
        $this->data['list_status'][2] = 'received';
        $this->data['list_status'][3] = 'rejected';
        $this->data['list_status']["all"] = "All";
    }

    function index() {

        $param = $this->uri->uri_to_assoc(4);
        $this->data ['status'] = 1;
        $now = date("Y-m-d");

        $status_act = " AND status = 1";
        if (!empty($param ['status'])) {
            $this->data ['status'] = $param ['status'];
            if ($this->data ['status'] == 'all') {
                $status_act = "";
            } else {
                $status_act = " AND status = '" . $this->data ['status'] . "'";
            }
        }


        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data ['list_data'] = $this->gold_confirm->get_data(null, 'status !=0' . $status_act, null, null, null, 'id desc');
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
                    'status' => 1,
                    'insert_user' => $this->input->post('cbo_insert_user'),
                    'update_user' => $this->session->userdata('sess-id'),
                    'insert_date' => date('Y-m-d h:i:s')
                );

                if ($this->gold_confirm->add_data($data)) {
                    $this->session->set_flashdata('info_messages', 'Data successfully added');
                    redirect(site_url('admin/' . $this->data['controler']));
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

    function delete() {
        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);
        $ubah = $this->gold_confirm->edit_data(array('status' => 0), array('id' => $id));
        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }
        redirect(site_url('admin/gold_confirm/index/' . $page));
    }

    function approve() {

        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);

        $this->data['rec_data'] = $this->gold_confirm->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $nextmonth = date("Y-m-d", mktime(0, 0, 0, date("m") + 3, date("d"), date("Y")));

        $ubah = $this->users->edit_data(array('gold_expired' => $nextmonth), array('id' => $this->data['rec_data']->insert_user));
        $ubah = $this->gold_confirm->edit_data(array('status' => 2), array('id' => $id));
        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }

        redirect(site_url('admin/gold_confirm/index/' . $page));
    }

    function reject() {

        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);

        $this->data['rec_data'] = $this->gold_confirm->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $nextmonth = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 2, date("Y")));

        $ubah = $this->users->edit_data(array('gold_expired' => $nextmonth), array('id' => $this->data['rec_data']->insert_user));
        $ubah = $this->gold_confirm->edit_data(array('status' => 3), array('id' => $id));

        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }
        redirect(site_url('admin/gold_confirm/index/' . $page));
    }

}

/**
 * End of file article.php
 * Location : ./application/controllers/admin/article.php
 */