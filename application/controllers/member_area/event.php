<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Content
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Event extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_user_login();
        $this->layout_dir = 'member_area/layout/';
        $this->page_dir = 'member_area/event/';
        $this->data['active_menu'] = 'Event';
        $this->data['controler'] = 'event';
        $this->load->model('event_model', 'event');
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
        $this->data['status'][0] = 'deleted';
        $this->data['status'][1] = 'pending';
        $this->data['status'][2] = 'published';
        $this->data['status'][3] = 'rejected';
    }

    function index() {

        $this->data ['navigation']['#'] = $this->data['active_menu'];
        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $where = "status != 0 AND insert_user =" . $this->session->userdata('sess-id');
        $this->data ['list_data'] = $this->event->get_data(null, $where, null, null, null, 'id desc');
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
        $this->data ['list_data'] = $this->event->get_data(null, array('status' => 1, 'category_id' => $this->data['cat_id']));
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data['cat_id'] = $this->uri->segment(4);
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Add ' . $this->data['active_menu'];
        $this->data ['navigation']['member_area/event/index/' . $this->data['cat_id']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';
        $this->data ['list_image'] = $this->gallery->get_data(null, null, null, null, 'id DESC');
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Title', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_keyword', 'Keyword', 'trim|xss_clean|required');
            $this->form_validation->set_rules('cbo_category_id', 'Kategory', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_location', 'Alamat', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_preface', 'Preface', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_latitude', 'Latitude', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_longitude', 'Longitude', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_image', 'Image', 'trim|xss_clean');

            if ($this->form_validation->run()) {

                $config['upload_path'] = './assets/uploads/images/content/'; //path folder
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
                $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
                $config['max_size'] = '1920';
                $config['max_width'] = '2048';
                $config['max_height'] = '1200';

                $this->upload->initialize($config);
                if (!empty($_FILES['uploadimage']['name'])) {

                    if ($this->upload->do_upload('uploadimage')) {
                        $gbr = $this->upload->data();
                        //Compress Image 
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/uploads/images/content/' . $gbr['file_name'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['quality'] = '50%';
                        $config['width'] = 300;
                        $config['height'] = 300;
                        $config['new_image'] = './assets/uploads/images/content/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];
                        $data = array(
                            'title' => $this->input->post('txt_name'),
                            'keyword' => $this->input->post('txt_keyword'),
                            'category_id' => $this->input->post('cbo_category_id'),
                            'city_id' => $this->input->post('cbo_city_id'),
                            'location' => $this->input->post('txt_location'),
                            'event_date' => $this->input->post('txt_event_date'),
                            'detail' => $this->input->post('txt_detail'),
                            'preface' => $this->input->post('txt_preface'),
                            'latitude' => $this->input->post('txt_latitude'),
                            'longitude' => $this->input->post('txt_longitude'),
                            'image' => $gambar,
                            'status' => 1,
                            'insert_user' => $this->session->userdata('sess-id'),
                            'insert_date' => date('Y-m-d h:i:s')
                        );

                        if ($this->event->add_data($data)) {
                            $this->session->set_flashdata('info_messages', 'Data successfully added');
                            redirect(site_url('member_area/' . $this->data['controler']));
                        } else {
                            $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                        }
                    } else {
                        $this->data ['form_validation_errors'] = $this->upload->display_errors() ? get_messages(wrap_text($this->upload->display_errors())) : null;
                    }
                    unset($config);
                } else {
                    $this->data ['form_validation_errors'] = get_messages("Image yang diupload kosong", 'alert-success', 'text-muted');
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
        $this->data ['list_image'] = $this->gallery->get_data(null, null, null, null, 'id DESC');
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data['rec_data'] = $this->event->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['navigation']['member_area/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';
        $this->data ['page_title'] = 'Update ' . $this->data['active_menu'];
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Title', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_keyword', 'Keyword', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_location', 'Alamat', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_event_date', 'Date Event', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_detail', 'Detail', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_preface', 'Preface', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_latitude', 'Latitude', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_longitude', 'Longitude', 'trim|xss_clean');
            $this->form_validation->set_rules('txt_image', 'Image', 'trim|xss_clean');

            if ($this->form_validation->run()) {

                if (!empty($_FILES['uploadimage']['name'])) {
                    $config['upload_path'] = './assets/uploads/images/content/'; //path folder
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
                    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
                    $config['max_size'] = '1920';
                    $config['max_width'] = '2048';
                    $config['max_height'] = '1200';

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('uploadimage')) {
                        @unlink('./assets/uploads/images/content/' . $this->data['rec_data']->image);
                        @unlink('./assets/uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $this->data['rec_data']->image));


                        $gbr = $this->upload->data();
                        //Compress Image 
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/uploads/images/content/' . $gbr['file_name'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['quality'] = '50%';
                        $config['width'] = 300;
                        $config['height'] = 300;
                        $config['new_image'] = './assets/uploads/images/content/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $gambar = $gbr['file_name'];
                        $data = array(
                            'title' => $this->input->post('txt_name'),
                            'keyword' => $this->input->post('txt_keyword'),
                            'category_id' => $this->input->post('cbo_category_id'),
                            'city_id' => $this->input->post('cbo_city_id'),
                            'location' => $this->input->post('txt_location'),
                            'detail' => $this->input->post('txt_detail'),
                            'preface' => $this->input->post('txt_preface'),
                            'latitude' => $this->input->post('txt_latitude'),
                            'longitude' => $this->input->post('txt_longitude'),
                            'event_date' => $this->input->post('txt_event_date'),
                            'image' => $gambar,
                            'status' => 1,
                            'insert_user' => $this->session->userdata('sess-id'),
                            'insert_date' => date('Y-m-d h:i:s')
                        );

                        if ($this->event->edit_data($data, array('id' => $id))) {
                            $this->session->set_flashdata('info_messages', 'Data successfully updated');
                            redirect(site_url('member_area/' . $this->data['controler']));
                        } else {
                            $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                        }
                        unset($config);
                    } else {
                        $this->data ['form_validation_errors'] = $this->upload->display_errors() ? get_messages(wrap_text($this->upload->display_errors())) : null;
                    }
                } else {
                    $data = array(
                        'title' => $this->input->post('txt_name'),
                        'keyword' => $this->input->post('txt_keyword'),
                        'category_id' => $this->input->post('cbo_category_id'),
                        'city_id' => $this->input->post('cbo_city_id'),
                        'location' => $this->input->post('txt_location'),
                        'detail' => $this->input->post('txt_detail'),
                        'preface' => $this->input->post('txt_preface'),
                        'latitude' => $this->input->post('txt_latitude'),
                        'longitude' => $this->input->post('txt_longitude'),
                        'event_date' => $this->input->post('txt_event_date'),
                        'status' => 1,
                        'update_user' => $this->session->userdata('sess-id'),
                        'update_date' => date('Y-m-d h:i:s')
                    );

                    if ($this->event->edit_data($data, array('id' => $id))) {
                        $this->session->set_flashdata('info_messages', 'Data successfully updated');
                        redirect(site_url('member_area/' . $this->data['controler']));
                    } else {
                        $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                    }
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }

        $this->data ['page'] = $this->load->view($this->get_page('update'), $this->data, true);
        $this->render();
    }

    function detail() {
        $id = $this->uri->segment(4);
        $this->data ['list_image'] = $this->gallery->get_data(null, null, null, null, 'id DESC');
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data['rec_data'] = $this->event->get_data(null, array('id' => $id), null, null, null, null, 'row');
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['navigation']['member_area/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Detail';
        $this->data ['page_title'] = 'Update ' . $this->data['active_menu'];
        

        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }
    
    function delete() {
        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);
        $ubah = $this->event->edit_data(array('status' => 0), array('id' => $id));
        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }
        redirect(site_url('member_area/event/index/' . $page));
    }

}

/**
 * End of file article.php
 * Location : ./application/controllers/member_area/article.php
 */