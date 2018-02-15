<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Register
 *
 * @author  Vanderwyk Siahaan
 *         @date april 29th, 2015
 */
class Contact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/inside/';
        $this->page_dir = 'contact/';
        $this->data['menu'] = 'contact';
        $this->load->model('info_model', 'info');
    }

    function index() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('txt_name', 'Name', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_email', 'Email Address', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_message', 'Message', 'trim|xss_clean|required');
            if ($this->form_validation->run()) {
                $this->load->model('messages_model', 'messages');
                $data = array(
                    'name' => $this->input->post('txt_name'),
                    'email' => $this->input->post('txt_email'),
                    'message' => $this->input->post('txt_message'),
                    'insert_date' => date('Y-m-d h:i:s'),
                    'status' => 1
                );
                if ($this->messages->add_data($data)) {
                    $this->data ['form_validation_errors'] = get_messages('Terima kasih atas masukan dan pertanyaannya, kami akan menkonfirmasikan segera', 'alert-success', 'text-muted');
                } else {
                    $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                }
            } else {
                $this->data ['form_validation_errors'] = get_messages(validation_errors());
            }
        }
        
        $this->data ['page_icon'] = 'glyphicon-stats';
        $info = $this->info->get_data('detail', array('id' => 2), null, null, null, null, 'row');
        $this->data['rec_info'] = unserialize($info->detail);
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }


}
