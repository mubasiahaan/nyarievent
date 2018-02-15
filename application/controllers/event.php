<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home
 *
 * @author  Vanderwyk Siahaan
 *         @date June 9th, 2014
 */
class Event extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/inside/';
        $this->page_dir = 'event/';
        $this->data['menu'] = 'event';
        $this->load->model('event_model', 'event');
        $this->load->model('event_comment_model', 'event_comment');
        $this->load->model('category_model', 'category');
        $this->load->library('pagination');
        $this->load->model('city_model', 'city');
        foreach ($this->category->get_data("id, name") as $row) {
            $this->data['list_category'][$row->id] = $row->name;
            $this->data['list_category_check'][$row->id] = "";
        }

        foreach ($this->city->get_data("id, name", array('status' => 1)) as $row) {
            $this->data['list_city'][$row->id] = $row->name;
            $this->data['list_city_check'][$row->id] = "";
        }
    }

    function index() {

        $this->data['event_category'] = 0;
        $this->data['event_city'] = 0;
        $this->data['event_date'] = "";
        $this->data['tab'] = "";
        $now = date("Y-m-d");
        $this->data['rec_main_page'] = $this->event->get_data(null, "status = 2 AND main_page = 1 AND DATE(event_date) >= DATE('$now')", 8, null, 'id desc');

        $total_data = $this->event->get_data("COUNT(id) as total", "status = 2 AND DATE(event_date) >= DATE('$now')", null, null, null, null, 'row')->total;
        $config = configPagination('event/index/', $total_data);

        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $this->data['rec_latest'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now')", $config['per_page'], $from, 'event_date ASC');

        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function category() {

        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['category'])) {
            $key_update = $param ['category'];
            $data[0] = $key_update;
            $this->session->set_userdata(array(
                'list_category_check' => $data
            ));
            redirect('event/search');
        } else {
            redirect('home');
        }
    }

    function search() {

        $now = date("Y-m-d");
        $this->data['rec_main_page'] = $this->event->get_data(null, "status = 2 AND main_page = 1 AND DATE(event_date) >= DATE('$now')", 8, null, 'id desc');
        $search = "status = 2 AND DATE(event_date) >= DATE('$now')";
        $category = "";
        $city = "";
        $tab = "";
        $data_category = 0;
        $data_city = 0;
        $this->data['event_category'] = 0;
        $this->data['event_city'] = 0;
        $this->data['event_date'] = "";

        if ($this->input->post('sumit_home')) {
            $data_category = 0;
            $data_city = 0;
            $this->session->set_userdata(array(
                'list_category_check' => $data_category
            ));
            $this->session->set_userdata(array(
                'list_city_check' => $data_category
            ));
            if ($this->input->post('event_date')) {
                $search = "status = 2  AND DATE(event_date) = DATE('" . $this->input->post('event_date') . "')";
                $tab = $tab . '<a href="#">' . $this->input->post('event_date') . '</a>';
                $this->data['event_date'] = $this->input->post('event_date');
            }
            if ($this->input->post('event_category')) {
                $search = $search . " AND category_id = " . $this->input->post('event_category');
                $tab = $tab . '<a href="#">' . $this->data['list_category'][$this->input->post('event_category')] . '</a>';
                $this->data['list_category_check'][$this->input->post('event_category')] = 'checked=""';
                $this->data['event_category'] = $this->input->post('event_category');
            }
            if ($this->input->post('event_city')) {
                $search = $search . " AND city_id = " . $this->input->post('event_city');
                $tab = $tab . '<a href="#">' . $this->data['list_category'][$this->input->post('event_city')] . '</a>';
                $this->data['list_city_check'][$this->input->post('event_city')] = 'checked=""';
                $this->data['event_city'] = $this->input->post('event_city');
            }
        }


        if ($this->session->userdata('list_category_check')) {
            $data_category = $this->session->userdata('list_category_check');
        }
        if ($this->session->userdata('list_city_check')) {
            $data_city = $this->session->userdata('list_city_check');
        }

        if ($this->input->post('search')) {
            $data_category = 0;
            $data_city = 0;
            $this->session->set_userdata(array(
                'list_category_check' => $data_category
            ));
            $this->session->set_userdata(array(
                'list_city_check' => $data_category
            ));
            if ($this->input->post('category')) {
                $data_category = $this->input->post('category');
                $this->session->set_userdata(array(
                    'list_category_check' => $this->input->post('category')
                ));
            }
            if ($this->input->post('city')) {
                $data_city = $this->input->post('city');
                $this->session->set_userdata(array(
                    'list_city_check' => $this->input->post('category')
                ));
            }
        }

        if ($data_category) {
            $i = 0;
            foreach ($data_category as $key => $value) {
                if ($i == 0) {
                    $category = "( category_id = " . $value;
                } else {
                    $category = $category . " OR category_id = " . $value;
                }
                $tab = $tab . '<a href="#">' . $this->data['list_category'][$value] . '</a>';
                $this->data['list_category_check'][$value] = 'checked=""';
                $i++;
            }
            $search = $search . " AND " . $category . " )";
        }
        if ($data_city) {
            $i = 0;
            foreach ($data_city as $key => $value) {
                if ($i == 0) {
                    $city = "( city_id = " . $value;
                } else {
                    $city = $city . " OR city_id = " . $value;
                }
                $tab = $tab . '<a href="#">' . $this->data['list_city'][$value] . '</a>';
                $this->data['list_city_check'][$value] = 'checked=""';

                $i++;
            }
            $search = $search . " AND " . $city . " )";
        }

        $this->data['tab'] = $tab;
        $total_data = $this->event->get_data("COUNT(id) as total", $search, null, null, null, null, 'row')->total;
        $config = configPagination('event/search/', $total_data);

        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $this->data['rec_latest'] = $this->event->get_data(null, $search, $config['per_page'], $from, 'event_date ASC');

        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function detail() {

        $param = $this->uri->uri_to_assoc(2);
        $key_update = '';
        if (!empty($param ['detail'])) {
            $key_update = $param ['detail'];
        }

        
        
        if ($this->session->userdata('sess-loggedin')) {
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('rating', 'rating', 'trim|xss_clean');
                $this->form_validation->set_rules('detail', 'detail', 'trim|xss_clean');
                if ($this->form_validation->run()) {
                    $data = array(
                        'event_id' => $key_update,
                        'rating' => $this->input->post('rating'),
                        'detail' => $this->input->post('detail'),
                        'status' => 1,
                        'insert_user' => $this->session->userdata('sess-id'),
                        'insert_date' => date('Y-m-d h:i:s')
                    );

                    if ($this->event_comment->add_data($data)) {

                        $jumlah_review = $this->event_comment->get_data(" Count(id) as jumlah", "status = 1 AND rating >= 1 AND event_id = $key_update ", null, null, null, null, 'row');
                        $total_review = $this->event_comment->get_data(" Sum(rating) as total", "status = 1 AND rating >= 1 AND event_id = $key_update ", null, null, null, null, 'row');
                        $rating = @($total_review->total / $jumlah_review->jumlah);

                        $data = array(
                            'rating' => $rating
                        );
                        if ($this->event->edit_data($data, array('id' => $key_update))) {
                            
                        }
                        $this->session->set_flashdata('info_messages', 'Data successfully added');
                    } else {
                        $this->data ['form_validation_errors'] = get_messages('Failed to save Data', 'alert-success', 'text-muted');
                    }
                } else {
                    $this->data ['form_validation_errors'] = get_messages(validation_errors());
                }
            }
        }


        $this->data['rec_comment'] = $this->event_comment->get_data(null, "status = 1 AND event_id = $key_update ", null, null, 'id desc');
        $this->data['rec_detail'] = $this->event->get_data(null, array(
            'id' => $key_update
                ), null, null, null, null, 'row');
        $this->data['link'] = site_url('event/detail/'.$key_update.'/'.  urlencode($this->data['rec_detail']->title));
        $this->data['view'] = $this->data['rec_detail']->view + 1;
        $data = array(
            'view' => $this->data['view']
        );
        if ($this->event->edit_data($data, array('id' => $key_update))) {
            
        }

        $where = "status = 1 AND category_id = " . $this->data['rec_detail']->category_id . " AND id != $key_update ";
        $this->data['rec_related'] = $this->event->get_data(NULL, $where, 3, NULL, 'id DESC');
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page('detail'), $this->data, true);
        $this->render();
    }

    function users() {
        $users = $this->uri->segment(3);
        $this->data['event_category'] = 0;
        $this->data['event_city'] = 0;
        $this->data['event_date'] = "";
        $this->data['tab'] = "";
        $now = date("Y-m-d");
        $this->load->model('users_model', 'users');
        $this->data['user_update'] = $this->users->get_data(null, array('id' => $users), null, null, null, null, 'row');
        
        $total_data = $this->event->get_data("COUNT(id) as total", "status = 2 AND DATE(event_date) >= DATE('$now') AND insert_user = $users ", null, null, null, null, 'row')->total;
        $config = configPagination('event/users/' . $users . '/', $total_data);

        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $this->data['rec_latest'] = $this->event->get_data(null, "status = 2 AND DATE(event_date) >= DATE('$now') AND insert_user = $users ", $config['per_page'], $from, 'event_date ASC');

        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page'] = $this->load->view($this->get_page('users'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
