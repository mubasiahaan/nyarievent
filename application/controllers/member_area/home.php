<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Info
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_user_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'member_area/layout/';
        $this->page_dir = 'member_area/home/';
        $this->data['menu'] = 'home';
        $this->data['controler'] = 'home';
        $this->load->model('info_model', 'info');
        $this->load->model('users_model', 'user');
        $this->data['active_menu'] = 'users';
        $this->data['list_role']['1'] = "Admin";
        $this->data['list_role']['2'] = "Web Content";
        $this->data['list_role']['3'] = "Member";
        $this->data['active_menu'] = 'home';
        $this->data ['navigation'] = array('#' => 'Dashboard');

        $key_update = $this->session->userdata('sess-id');
        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');
    }

    function index() {

        $this->load->model('event_model', 'event');
        $this->load->model('category_model', 'category');
        $this->load->model('story_model', 'story');
        $this->load->model('ticket_model', 'ticket');

        $where = 'status != 0';
        foreach ($this->category->get_data(null, $where) as $row) {
            $this->data['category_id'][$row->id] = $row->name;
        }
        $this->data ['navigation']['admin/' . $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';

        $this->data['list_status'][1] = 'open';
        $this->data['list_status'][2] = 'closed';
        $this->data['list_status']["all"] = "All";

        $this->data['status'][1] = 'pending';
        $this->data['status'][2] = 'published';
        $this->data['status'][3] = 'rejected';
        $this->data['status']["all"] = "All";

        $key_update = $this->session->userdata('sess-id');
        $this->data ['list_data_inbox'] = $this->ticket->get_data(null, 'status = 1 AND insert_user = ' . $key_update, null, null, null, 'id desc');
        $this->data ['list_data_event'] = $this->event->get_data(null, 'status = 1 AND insert_user = ' . $key_update, null, null, null, 'id desc');
        $this->data ['list_data_story'] = $this->story->get_data(null, 'status = 1 AND insert_user = ' . $key_update, null, null, null, 'id desc');

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Edit Users';

        $this->data ['page'] = $this->load->view($this->get_page('index'), $this->data, true);
        $this->render();
    }

    function edit_profile() {
        $this->data ['navigation']['admin/' . $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';
        $key_update = $this->session->userdata('sess-id');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Name Harus Disi', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_email', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_phone', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_qoutes', 'Qoutes', 'trim|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'name' => $this->input->post('txt_name'),
                    'email' => $this->input->post('txt_email'),
                    'phone' => $this->input->post('txt_phone'),
                    'qoutes' => $this->input->post('txt_qoutes'),
                    'update_date' => date("Y-m-d h:m:s")
                );

                if ($this->user->edit_data($data, array('id' => $key_update))) {
                    redirect('member_area');
                } else {
                    $this->data ['error_messages'] = get_messages('Gagal Mengupdate Data kategori Ini');
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }

        if ($this->input->post('avatar')) {
            $target_dir = (APPPATH . '../assets/uploads/avatar/');
            $target_file = $target_dir . $this->session->userdata('sess-id') . '.' . 'jpg';
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            $check = getimagesize($_FILES["file_image"]["tmp_name"]);
            if ($check !== false) {
                $this->data ['error_messages'] = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $this->data ['error_messages'] = "File is not an image.";
                $uploadOk = 0;
            }
            if (file_exists($target_file)) {
                $this->data ['error_messages'] = "Sorry, file already exists.";
                $uploadOk = 1;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $this->data ['error_messages'] = "Sorry, only jpg, files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $this->data ['error_messages'] = "Sorry, your file was not uploaded.";
            } else {

                if (move_uploaded_file($_FILES["file_image"]["tmp_name"], $target_file)) {
                    $this->data ['error_messages'] = "Foto Telah Di Update";
                } else {
                    $this->data ['error_messages'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $this->data ['user_update'] = $this->user->get_data(null, array('id' => $key_update), null, null, null, null, 'row');

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Edit Users';

        $this->data ['page'] = $this->load->view($this->get_page('edit_profile'), $this->data, true);
        $this->render();
    }

    function reset_pass() {
        $key_update = $this->session->userdata('sess-id');
        $this->data ['navigation']['admin/' . $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['admin/' . $this->data['active_menu'] . '/update/' . $key_update] = 'update';
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
                        redirect('member_area');
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

    function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

}

/**
 * End of file info.php
 * Location : ./application/controllers/admin/info.php
 */