<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Company
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Slider extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/slider/';
        $this->data['menu'] = 'slider';
        $this->load->model('slider_model', 'slider');
        $this->data['active_menu'] = 'slider';
        $this->data ['navigation'] = array('admin/home' => 'Dashboard');
    }

    function index() {
        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['list_slider'] = $this->slider->get_data(null);
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page_title'] = 'Daftar Slider';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data ['navigation']['admin/'. $this->data['active_menu']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Name ', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_link', 'Link ', 'trim|xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $target_dir = (APPPATH . '../assets/uploads/images/slider/');
                $target_file = $target_dir . basename($_FILES["file_image"]["name"]);
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
                    $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $this->data ['error_messages'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    $this->data ['error_messages'] = "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["file_image"]["tmp_name"], $target_file)) {
                        $this->data ['error_messages'] = "The file " . basename($_FILES["file_image"]["name"]) . " has been uploaded.";
                        $data = array(
                            'name' => $this->input->post('txt_name'),
                            'link' => $this->input->post('txt_link'),
                            'file_name' => $_FILES["file_image"]["name"],
                            'status' => $this->input->post('cbo_status'),
                            'order' => $this->input->post('txt_order'),
                            'insert_user' => $this->session->userdata('sess-id'),
                            'insert_date' => date("Y-m-d h:m:s"),
                        );
                        if ($this->slider->add_data($data)) {
                            redirect('admin/slider');
                        } else {
                            $this->data ['error_messages'] = get_messages('Gagal Menyimpan Data slider Ini');
                        }
                    } else {
                        $this->data ['error_messages'] = "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                $this->data ['error_messages'] = validation_errors() ? get_messages(validation_errors()) : '';
            }
        }

        $this->data ['list_status'][0] = 'Non Aktif';
        $this->data ['list_status'][1] = 'Aktif';

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Add Slider';
        $this->data ['page'] = $this->load->view($this->get_page('add'), $this->data, true);
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
        $this->data['cont_update'] = $this->slider->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');

        $this->data ['page_icon'] = 'icomoon-icon-newspaper';
        $this->data ['page_title'] = 'Detail Artilce';
        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
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
        $this->data ['cont_update'] = $this->slider->get_data(null, array(
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

                if ($this->slider->edit_data($data, array(
                            'id' => $key_update
                        ))) {
                    redirect('admin/slider');
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
        $this->data ['page_title'] = 'Update Slider';
        $this->data ['page'] = $this->load->view($this->get_page('edit'), $this->data, true);
        $this->render();
    }

    public function delete() {
        $param = $this->uri->uri_to_assoc(4);
        $key_update = '';
        if (!empty($param ['id'])) {
            $key_update = $param ['id'];
        }

        if ($this->slider->delete_data(array(
                    'id' => $key_update
                ))) {
            redirect('admin/slider');
        } else {
            $this->data ['messages'] = 'Data Gagal di Hapus';
        }
    }

    function logo() {
        $this->data ['menu'] = array('admin/slider' => 'Slider', 'admin/slider' => 'Add');
        if ($this->input->post('submit')) {
            $target_dir = (APPPATH . '../assets/img/');
            $target_file = $target_dir . 'logo.png';
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

            if ($imageFileType != "png") {
                $this->data ['error_messages'] = "Sorry, only .png are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $this->data ['error_messages'] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["file_image"]["tmp_name"], $target_file)) {
                    //redirect('admin/slider/logo');
                    $this->data ['error_messages'] = "Your logo has been replace, please refresh or clear your history cache.";
                } else {
                    $this->data ['error_messages'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $this->data ['list_status'][0] = 'Non Aktif';
        $this->data ['list_status'][1] = 'Aktif';

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Replace Logo';
        $this->data ['page'] = $this->load->view($this->get_page('logo'), $this->data, true);
        $this->render();
    }

    function background() {
        $this->data ['menu'] = array('admin/slider' => 'Slider', 'admin/slider' => 'Add');
        if ($this->input->post('submit')) {
            $target_dir = (APPPATH . '../assets/img/');
            $target_file = $target_dir . 'bg.jpg';
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

            if ($imageFileType != "jpg") {
                $this->data ['error_messages'] = "Sorry, only .jpg are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $this->data ['error_messages'] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["file_image"]["tmp_name"], $target_file)) {
                    //redirect('admin/slider/logo');
                    $this->data ['error_messages'] = "Your logo has been replace, please refresh or clear your history cache.";
                } else {
                    $this->data ['error_messages'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $this->data ['list_status'][0] = 'Non Aktif';
        $this->data ['list_status'][1] = 'Aktif';

        $this->data ['page_icon'] = 'icomoon-icon-plus';
        $this->data ['page_title'] = 'Replace Backgroud';
        $this->data ['page'] = $this->load->view($this->get_page('background'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file slider.php
 * Location : ./application/controllers/admin/slider.php
 */