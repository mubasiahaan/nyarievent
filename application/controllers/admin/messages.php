<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Company
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Messages extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/messages/';
        $this->data['menu'] = 'messages';
        $this->load->model('messages_model', 'messages');
        $this->data['active_menu'] = 'setting';
        $this->data ['navigation'] = array('admin/home' => 'Dashboard');
    }

    function index() {
        $this->data ['menu'] = array('admin/messages' => 'Messages');
        $this->data ['list_messages'] = $this->messages->get_data(null, array("status" => 1), null, null, "id DESC");
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page_title'] = 'Daftar Messages';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function detail() {
        $this->data ['menu'] = array('admin/messages' => 'Messages', 'admin/messages' => 'Detail');
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }
        $this->data['cont_update'] = $this->messages->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        $this->data ['page_icon'] = 'icomoon-icon-newspaper';
        $this->data ['page_title'] = 'Detail Artilce';
        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }

    function update() {
        $this->data ['menu'] = array('admin/ messages' => 'Messages', 'admin/ messages' => 'Edit');
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }
        $this->data ['cont_update'] = $this->messages->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Name ', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_link', 'Link ', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $detail = str_replace('&lt;', '<', $this->input->post('txt_detail'));
                $detail = str_replace('&gt;', '>', $detail);
                $data = array(
                    'name' => $this->input->post('txt_name'),
                    'link' => $this->input->post('txt_link'),
                    'status' => $this->input->post('cbo_status'),
                    'order' => $this->input->post('txt_order'),
                    'insert_user' => $this->session->userdata('sess-id'),
                    'update_date' => date("Y-m-d h:m:s"),
                );

                if ($this->messages->edit_data($data, array(
                            'id' => $key_update
                        ))) {
                    redirect('admin/ messages');
                } else {
                    $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }

        $this->data ['list_status'][0] = 'Non Aktif';
        $this->data ['list_status'][1] = 'Aktif';

        $this->data ['page_icon'] = 'icomoon-icon-pencil-3';
        $this->data ['page_title'] = 'Update Messages';
        $this->data ['page'] = $this->load->view($this->get_page('edit'), $this->data, true);
        $this->render();
    }

    public function delete() {
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }

        if ($this->messages->delete_data(array(
                    'id' => $key_update
                ))) {
            redirect('admin/messages');
        } else {
            $this->data ['messages'] = 'Data Gagal di Hapus';
        }
    }

}

/**
 * End of file  messages.php
 * Location : ./application/controllers/admin/ messages.php
 */