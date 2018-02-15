<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Info
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->is_admin_login();
        $this->data ['html_link'] = $this->get_config('app_admin_link', TRUE);
        $this->data ['html_script'] = $this->get_config('app_admin_script', TRUE);
        $this->layout_dir = 'admin/layout/';
        $this->page_dir = 'admin/home/';
        $this->data['menu'] = 'home';
        $this->load->model('event_model', 'event');
        $this->load->model('category_model', 'category');
        $this->load->model('city_model', 'city');
        $this->load->model('story_model', 'story');
        $this->load->model('ticket_model', 'ticket');
        $this->load->model('messages_model', 'messages');
        $this->load->model('gold_confirm_model', 'gold_confirm');
        $this->data['active_menu'] = 'home';
        $this->data ['navigation'] = array('#' => 'Dashboard');

        $where = 'status != 0';
        foreach ($this->category->get_data(null, $where) as $row) {
            $this->data['category_id'][$row->id] = $row->name;
        }
        foreach ($this->city->get_data(null, $where) as $row) {
            $this->data['city_id'][$row->id] = $row->name;
        }


        $this->data['status'][1] = 'open';
        $this->data['status'][2] = 'closed';
        $this->data['status']["all"] = "All";

        $this->data['list_status'][1] = 'pending';
        $this->data['list_status'][2] = 'published';
        $this->data['list_status'][3] = 'rejected';
        $this->data['list_status']["all"] = "All";
    }

    function index() {

        $this->data ['list_data_upgrade'] = $this->gold_confirm->get_data(null, 'status = 1', null, null, null, 'id desc');
        $this->data ['list_data_event'] = $this->event->get_data(null, 'status = 1', null, null, null, 'id desc');
        $this->data ['list_data_story'] = $this->story->get_data(null, 'status = 1', null, null, null, 'id desc');
        $this->data ['list_data_inbox'] = $this->ticket->get_data(null, 'status = 1', null, null, null, 'id desc');
        $this->data ['list_data_message'] = $this->messages->get_data(null, array("status" => 1), null, null, "id DESC");

        $this->data ['page_icon'] = 'icomoon-icon-list';
        $this->data ['page_title'] = 'Company Info';

        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
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