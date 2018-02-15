<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home
 *
 * @author  Vanderwyk Siahaan
 *         @date June 9th, 2014
 */
class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/';
        $this->page_dir = 'home/';
        $this->data['menu'] = 'home';
        $this->load->model('event_model', 'event');
        $this->load->model('story_model', 'story');
        $this->load->model('info_model', 'info');
        $this->load->model('category_model', 'category');
        $this->load->model('city_model', 'city');
        foreach ($this->category->get_data("id, name", array('status' => 1)) as $row) {
            $this->data['list_category'][$row->id] = $row->name;
        }

        foreach ($this->city->get_data("id, name", array('status' => 1)) as $row) {
            $this->data['list_city'][$row->id] = $row->name;
        }
    }

    function index() {
        $this->data['event_category'] = 0;
        $this->data['event_city'] = 0;

        $now = date("Y-m-d");
        $this->data['rec_main_page'] = $this->event->get_data(null, "status = 2 AND main_page = 1 AND DATE(event_date) >= DATE('$now')", 8, null, 'id desc');
        $this->data['rec_latest'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now')", 6, null, 'id desc');
        $this->data['rec_art'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 6", 6, null, 'id desc');
        $this->data['rec_culinary'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 5", 6, null, 'id desc');
        $this->data['rec_photograph'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 4", 6, null, 'id desc');
        $this->data['rec_sports'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 8", 6, null, 'id desc');
        $this->data['rec_exhibition'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 7", 6, null, 'id desc');
        $this->data['rec_workshop'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 2", 6, null, 'id desc');
        $this->data['rec_music'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND category_id = 1", 6, null, 'id desc');
        $this->data['rec_story'] = $this->story->get_data(null, array('status' => 1), 8, NULL, 'id desc');
        $this->data['rec_info'] = $this->info->get_data('preface', array('id' => 1), null, null, null, null, 'row');

        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['index'])) {
            $key_update = $param ['index'];
            $this->data['month'] = $key_update;
            $this->data['year'] = date("Y");
        } else {
            $this->data['month'] = date("m");
            $this->data['year'] = date("Y");
        }

        $this->data['dt'] = 0;
        $date = mktime(0, 0, 0, $this->data['month'], 1, $this->data['year']);
        $this->data['total_day'] = date('t', $date);
        $this->data['month_name'] = date('M', $date);
        $this->data['day_start'] = $this->day_start(date('D', mktime(0, 0, 0, $this->data['month'], 1, $this->data['year'])));
        $this->data['day_now'] = date("d");

        $this->data['rec_calendar'] = $this->event->get_data(null, "status = 2 AND YEAR(event_date) = " . $this->data['year'] . " AND MONTH(event_date) = " . $this->data['month'], 8, null, 'id ASC');
        $kalender = null;
        foreach ($this->data['rec_calendar'] as $row) {
            $vander = strtotime($row->event_date);
            $enita = date('d', $vander) + 0;
            $kalender[$enita][$row->id]['id'] = $row->id;
            $kalender[$enita][$row->id]['title'] = $row->title;
        }
        $this->data['kalender'] = $kalender;

        //debug($this->data['kalender']);

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
        $this->data['list_event'] = array();
        foreach ($this->category->get_data("id, name", array('status' => 1)) as $row) {
            $this->data['list_event'][$row->id]['name'] = $row->name;
            $this->data['list_event'][$row->id]['detail'] = $this->event->get_data(null, array('status' => 1, 'category_id' => $row->id), 5, null, 'id desc');
            $this->data['list_event'][$row->id]['detail_more'] = $this->event->get_data(null, array('status' => 1, 'category_id' => $row->id), 2, null, 'id desc');
        }


        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function day_start($day) {
        $date = 0;
        if ($day == 'Mon') {
            $date = 0;
        } else if ($day == 'Tue') {
            $date = 1;
        } else if ($day == 'Wed') {
            $date = 2;
        } else if ($day == 'Thu') {
            $date = 3;
        } else if ($day == 'Fri') {
            $date = 4;
        } else if ($day == 'Sat') {
            $date = 5;
        } else if ($day == 'Sun') {
            $date = 6;
        }
        return $date;
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
