<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Enrichment
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Category extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/category/';
        $this->load->model('gallery_model', 'gallery');
        $this->data['active_menu'] = 'Category';
        $this->data['controler'] = 'category';
        $this->load->model('category_model', $this->data['controler']);
        $this->data ['navigation'] = array('admin/home' => 'Dashboard');
    }

    function index() {
        $this->data ['navigation']['#'] = $this->data['active_menu'];


        $this->data ['page_title'] = 'List ' . $this->data['active_menu'];
        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $where = 'status = 1';
        $this->data ['list_data'] = $this->category->get_data(null, $where);
        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function add() {
        $this->data['cat_id'] = $this->uri->segment(4);
        $this->data ['navigation']['admin/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Add';
        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Add ' . $this->data['active_menu'];

        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Category name', 'trim|xss_clean|required');
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('txt_name'),
                    'status' => 1
                );
                if ($this->category->add_data($data)) {
                    $this->session->set_flashdata('info_messages', 'Data successfully added');
                    redirect(site_url('admin/' . $this->data['controler']));
                } else {
                    $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }

        foreach ($this->data['cat_menu'] as $row) {
            $this->data['list_parent'][$row->id] = $row->name;
        }
        $this->data ['page'] = $this->load->view($this->get_page('add'), $this->data, true);
        $this->render();
    }

    function update() {
        $this->data['cat_id'] = $this->uri->segment(4);
        $this->data['rec_data'] = $this->category->get_data(null, array('id' => $this->data['cat_id']), null, null, null, null, 'row');
        $this->data ['navigation']['admin/' . $this->data['controler']] = $this->data['active_menu'];
        $this->data ['navigation']['#'] = 'Update';

        $this->data ['page_icon'] = 'icomoon-icon-plus-circle';
        $this->data ['page_title'] = 'Update ' . $this->data['active_menu'];

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Category name', 'trim|xss_clean|required');
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('txt_name')
                );
                if ($this->category->edit_data($data, array('id' => $this->data['cat_id']))) {
                    $this->session->set_flashdata('info_messages', 'Data successfully updated');
                    redirect(site_url('admin/' . $this->data['controler']));
                } else {
                    $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }

        $this->data['list_status'][1] = 'Aktif';
        $this->data['list_status'][0] = 'Non Aktif';



        $this->data ['page'] = $this->load->view($this->get_page('update'), $this->data, true);
        $this->render();
    }

    function delete() {
        $id = $this->uri->segment(4);
        $page = $this->uri->segment(5);
        $ubah = $this->category->edit_data(array('status' => 0), array('id' => $id));
        if ($ubah == true) {
            $this->session->set_flashdata('info_messages', 'Successfully Deleted');
        } else {
            $this->session->set_flashdata('info_messages', 'Fail Deleted');
        }
        redirect(site_url('admin/' . $this->data['controler']));
    }

}

/**
 * End of file article.php
 * Location : ./application/controllers/admin/article.php
 */