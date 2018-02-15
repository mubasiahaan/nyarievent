<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'layout/inside/';
        $this->data['menu'] = 'home';
        $this->page_dir = 'register/';
        $this->load->model('users_model', 'users');
        if ($this->session->userdata('is_admin')) {
            redirect('admin');
        }
    }

    function index() {

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_username', 'Username Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_name', 'Name Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_password', 'Password', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_email', 'Email Address', 'trim|xss_clean|valid_email|required');
            $this->form_validation->set_rules('txt_phone', 'Password', 'trim|xss_clean|required');

            if ($this->form_validation->run() == TRUE) {
                $where = "username = '" . $this->input->post('txt_username') . "' OR email = '" . $this->input->post('txt_email') . "'";
                $rec_user = $this->users->get_data(null, $where, null, null, null, null, 'row');
                if (!($this->users->total_rows >= 1)) {
                    $randnum = md5(rand(1111111111, 9999999999));
                    $data = array(
                        'username' => $this->input->post('txt_username'),
                        'name' => $this->input->post('txt_name'),
                        'role' => 3,
                        'status' => 3,
                        'activation' => $randnum,
                        'email' => $this->input->post('txt_email'),
                        'phone' => $this->input->post('txt_phone'),
                        'password' => md5($this->input->post('txt_password')),
                        'insert_date' => date("Y-m-d h:m:s")
                    );

                    $message = 'Dear ' . $this->input->post('txt_name') . '<br>'
                            . 'Silahkan klik link berikut untuk mengaktivkan accout nyarievent anda <br>'
                            . '<a href="' . site_url('register/activation/' . $randnum) . '">' . site_url('register/activation/' . $randnum) . '<a>';

                    if (send_email($this->input->post('txt_email'), "Activation link request", $message)) {

                        if ($this->users->add_data($data)) {
                            redirect('login/index/1');
                        } else {
                            $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                        }
                    } else {
                        $this->data ['error_messages'] = get_messages('periksa kembali alamat email anda');
                    }
                } else {
                    $this->data ['error_messages'] = get_messages('Username atau email telah terdaftar, silahkan pilih yang lain');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }

        $this->data['list_status']['1'] = "Active";
        $this->data['list_status']['2'] = "Non Active";

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Add Users';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function activation() {
        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['activation'])) {
            $key_update = $param ['activation'];
        }

        if ($key_update == '0') {
            redirect('login/index/2');
        } else {
            $rec_user = $this->users->get_data(null, array('activation' => $key_update), null, null, null, null, 'row');
            if (($this->users->total_rows == 1)) {
                $data = array('status' => 1, 'activation' => 0);
                if ($this->users->edit_data($data, array('id' => $rec_user->id))) {
                    redirect('login/index/3');
                } else {
                    redirect('login/index/2');
                }
            } else {
                redirect('login/index/2');
            }
        }
        //debug($key_update);
    }

}

/**
 * End of file login.php
 * Location : ./application/controllers/login.php
 */