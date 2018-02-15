<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Info
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Info extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/info/';
        $this->data['menu'] = 'info';
        $this->load->model('info_model', 'info');
        $this->data['active_menu'] = 'info';
        $this->data ['navigation'] = array('#' => 'Dashboard');
    }

    function index() {

        $this->data['info_messages'] = $this->session->flashdata('info_messages') ? get_messages(wrap_text($this->session->flashdata('info_messages')), 'alert-success') : null;
        $this->data['send'] = $_POST;
        $this->data ['about'] = $this->info->get_data(null, array('id' => 1), null, null, null, null, 'row');
        $this->data ['faq'] = $this->info->get_data(null, array('id' => 3), null, null, null, null, 'row');
        $this->data ['gold'] = $this->info->get_data(null, array('id' => 4), null, null, null, null, 'row');
        $contact = $this->info->get_data(null, array('id' => 2), null, null, null, null, 'row');
        $this->data ['contact'] = unserialize($contact->detail);

        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page_title'] = 'Company Info';
        if ($this->input->post('submit-about')) {
            $this->update_about();
        } else if ($this->input->post('submit-contact')) {
            $this->update_contact();
        } else if ($this->input->post('submit-faq')) {
            $this->update_faq();
        } else if ($this->input->post('submit-gold')) {
            $this->update_gold();
        }
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function update_about() {
        $this->form_validation->set_rules('txt_about_preface', 'About Preface', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_about_detail', 'About Company', 'trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'preface' => $this->input->post('txt_about_preface'),
                'detail' => $this->input->post('txt_about_detail'),
                'update_date' => date('Y-m-d h:i:s')
            );
            if ($this->info->edit_data($data, array('id' => 1))) {
                $this->session->set_flashdata('info_messages', 'Company Data successfully updated');
                redirect(site_url('admin/info'));
            } else {
                $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
            }
        } else {
            $this->data ['form_validation_errors'] = get_messages(validation_errors());
        }
    }

    function update_faq() {

        $this->form_validation->set_rules('txt_faq_detail', 'Prepace faq', 'trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'detail' => $this->input->post('txt_faq_detail'),
                'update_date' => date('Y-m-d h:i:s')
            );
            if ($this->info->edit_data($data, array('id' => 3))) {
                $this->session->set_flashdata('info_messages', 'FAQ successfully updated');
                redirect(site_url('admin/info'));
            } else {
                $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
            }
        } else {
            $this->data ['form_validation_errors'] = get_messages(validation_errors());
        }
    }

    function update_gold() {

        $this->form_validation->set_rules('txt_faq_detail', 'Prepace faq', 'trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'detail' => $this->input->post('txt_gold_detail'),
                'update_date' => date('Y-m-d h:i:s')
            );
            if ($this->info->edit_data($data, array('id' => 4))) {
                $this->session->set_flashdata('info_messages', 'Gold message successfully updated');
                redirect(site_url('admin/info'));
            } else {
                $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
            }
        } else {
            $this->data ['form_validation_errors'] = get_messages(validation_errors());
        }
    }

    function update_contact() {
        $this->form_validation->set_rules('txt_address', 'Company Address', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_city', 'City', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_country', 'Country', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_phone', 'Phone', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_fb', 'Facebook', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_gp', 'Google Plus', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_fax', 'Fax', 'trim|xss_clean');
        $this->form_validation->set_rules('txt_sms', 'SMS', 'trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = array(
                'address' => $this->input->post('txt_address'),
                'city' => $this->input->post('txt_city'),
                'country' => $this->input->post('txt_country'),
                'phone' => $this->input->post('txt_phone'),
                'email' => $this->input->post('txt_email'),
                'fb' => $this->input->post('txt_fb'),
                'gplus' => $this->input->post('txt_gp'),
                'fax' => $this->input->post('txt_fax'),
                'sms' => $this->input->post('txt_sms'),
                'update_date' => date('Y-m-d h:i:s')
            );
            $insert = serialize($data);
            if ($this->info->edit_data(array('detail' => $insert), array('id' => 2))) {
                $this->session->set_flashdata('info_messages', 'Company Data successfully updated');
                redirect(site_url('admin/info'));
            } else {
                $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
            }
        } else {
            $this->data ['form_validation_errors'] = get_messages(validation_errors());
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}

/**
 * End of file info.php
 * Location : ./application/controllers/admin/info.php
 */