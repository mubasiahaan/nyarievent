<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/login/';
        $this->page_dir = 'admin/login/';
        if ($this->session->userdata('is_admin')) {
            redirect('admin');
        }
    }

    function index() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_error_delimiters("<li>", "</li>");
            $this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
            if ($this->form_validation->run()) {
                $this->load->model('users_model', 'users');
                $rec_user = $this->users->get_data(null, array(
                    'username' => $_POST ['username'], 'role' => 1
                        ), null, null, null, null, 'row');
                if ($this->users->total_rows == 1) {
                    if (md5($_POST ['password']) == $rec_user->password) {

                        $this->session->set_userdata(array(
                            'sess-id' => $rec_user->id,
                            'sess-user' => $rec_user->username,
                            'sess-name' => $rec_user->name,
                            'sess-role' => $rec_user->role,
                            'sess-loggedin' => true,
                            'is_admin' => true,
                            'sess-starttime' => date('Y-m-d H:i:s')
                        ));
                        redirect('admin');
                    } else {
                        //$kkk = md5($_POST ['password']);
                        $this->data ['form_validation_errors'] = wrap_text('Your password doesn\'t match');
                    }
                } else {
                    $this->data ['form_validation_errors'] = wrap_text('Your username not valid');
                }
            } else {
                $this->data ['form_validation_errors'] = validation_errors();
            }
        }
        $this->data ['html_title'] = 'Administration Login';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

}

/**
 * End of file login.php
 * Location : ./application/controllers/login.php
 */