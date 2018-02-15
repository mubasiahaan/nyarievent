<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Users
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Users extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/users/';
        $this->data['menu'] = 'users';
        $this->load->model('users_model', 'user');
        $this->data['active_menu'] = 'users';
        $this->data['list_role']['1'] = "Admin";
        $this->data['list_role']['2'] = "Web Content";
        $this->data['list_role']['3'] = "Member";
        $this->data ['navigation'] = array('admin/home' => 'Dashboard');
    }

    function index() {
        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page_title'] = 'Daftar Users';
        $this->data ['list_users'] = $this->user->get_data();
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data ['navigation']['admin/'. $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_username', 'Username Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_name', 'Name Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_password', 'Password', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_email', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_phone', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('cbo_role', 'Role', 'trim|xss_clean|required');
            $this->form_validation->set_rules('cbo_status', 'Role', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'username' => $this->input->post('txt_username'),
                    'name' => $this->input->post('txt_name'),
                    'role' => $this->input->post('cbo_role'),
                    'status' => $this->input->post('cbo_status'),
                    'email' => $this->input->post('txt_email'),
                    'phone' => $this->input->post('txt_phone'),
                    'password' => md5($this->input->post('txt_password')),
                    'insert_user' => $this->session->userdata('sess-user')->id,
                    'insert_date' => date("Y-m-d h:m:s")
                );

                if ($this->user->add_data($data)) {
                    redirect('admin/users');
                } else {
                    $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }


        $this->data['list_status']['1'] = "Active";
        $this->data['list_status']['2'] = "Non Active";

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Add Users';
        $this->data ['page'] = $this->load->view($this->get_page('add'), $this->data, true);
        $this->render();
    }

    function update() {
        $this->data ['navigation']['admin/'. $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_username', 'Username Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_name', 'Name Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_email', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_phone', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('cbo_role', 'Role', 'trim|xss_clean|required');
            $this->form_validation->set_rules('cbo_status', 'Role', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'username' => $this->input->post('txt_username'),
                    'name' => $this->input->post('txt_name'),
                    'role' => $this->input->post('cbo_role'),
                    'status' => $this->input->post('cbo_status'),
                    'email' => $this->input->post('txt_email'),
                    'phone' => $this->input->post('txt_phone'),
                    'update_date' => date("Y-m-d h:m:s")
                );

                if ($this->user->edit_data($data, array('id' => $key_update))) {
                    redirect('admin/users');
                } else {
                    $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }

        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');


        $this->data['list_status']['1'] = "Active";
        $this->data['list_status']['2'] = "Non Active";

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Edit Users';

        $this->data ['page'] = $this->load->view($this->get_page('edit'), $this->data, true);
        $this->render();
    }

    function detail() {
        $this->data ['navigation']['admin/'. $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Detail';
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }


        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');


        $this->data['list_status']['1'] = "Active";
        $this->data['list_status']['2'] = "Non Active";

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Edit Users';

        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }

    function reset_pass() {
        
        
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }

        
        $this->data ['navigation']['admin/'. $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['admin/'. $this->data['active_menu'].'/update/'.$key_update] = 'update';
        $this->data ['navigation']['#'] = 'reset password';
        
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_new_pass', 'New Pass Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_retype', 'Retype Harus Disi', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post('txt_new_pass') == $this->input->post('txt_retype')) {
                    $data = array(
                        'password' => md5($this->input->post('txt_new_pass'))
                    );
                    if ($this->user->edit_data($data, array(
                                'id' => $key_update
                            ))) {
                        redirect('admin/users');
                    } else {
                        $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                    }
                } else {
                    $this->data ['error_messages'] = get_messages('New pass tidak sama dengan retype');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }
        $this->data ['key_update'] = $key_update;
        $this->data ['page_icon'] = 'icomoon-icon-key-2';
        $this->data ['page_title'] = 'Reset Password';
        $this->data ['page'] = $this->load->view($this->get_page('respass'), $this->data, true);
        $this->render();
    }

    function change_pass() {
        $this->data['menu'] = array('admin/users' => 'Users', 'admin/client/detail' => 'Change Password User');
        $key_update = $this->session->userdata('sess-user')->id;
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_old_pass', 'Old Pass Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_new_pass', 'New Pass Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_retype', 'Retype Harus Disi', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->input->post('txt_new_pass') == $this->input->post('txt_retype')) {
                    if ($this->user->get_data(null, array('id' => $key_update, 'password' => $this->input->post('txt_old_pass')), null, null, null, null, 'row')) {
                        $data = array(
                            'password' => md5($this->input->post('txt_new_pass'))
                        );
                        if ($this->user->edit_data($data, array(
                                    'id' => $key_update
                                ))) {
                            redirect('dashboard/user');
                        } else {
                            $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                        }
                    } else {
                        $this->data ['error_messages'] = get_messages('Old Pass Salah');
                    }
                } else {
                    $this->data ['error_messages'] = get_messages('New pass tidak sama dengan retype');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }
        $this->data ['key_update'] = $key_update;
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page_title'] = 'Update Category';
        $this->data ['page'] = $this->load->view($this->get_page('chpass'), $this->data, true);
        $this->render();
    }

    public function delete() {
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }
        if ($this->user->delete_data(array(
                    'id' => $key_update
                ))) {
            redirect('dashboard/users');
        } else {
            $this->data ['messages'] = 'Data Gagal di Hapus';
        }
    }

}

/**
 * End of file article.php
 * Location : ./application/controllers/admin/article.php
 */