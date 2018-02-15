<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Read
 *
 * @author hunter.nainggolan
 *         @date June 9th, 2014
 */
class login_by extends MY_Controller {

    public $user = "";

    function __construct() {
        parent::__construct();
        $this->layout_dir = 'layout/';
        $this->page_dir = 'login/';
        $this->load->model('users_model', 'users');
        $this->load->config('facebook');
        $this->load->config('google');
        $this->load->library('facebook');
        $this->load->library('googleplus');

        //  $this->get_default_data();
    }

    function index() {
        $this->data['advertise'] = $this->get_advertise();
        $this->data ['page_icon'] = 'glyphicon-stats';
        $this->data ['page_title'] = 'Welcome to Jawaban.com - Register';

        if ($this->input->post('sbm')) {
            $this->proceed_login();
        }

        $this->data ['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function facebook_handler() {
        $this->user = $this->facebook->getUser();

        if ($this->user) {
            $this->data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url()));
            $this->data['user_profile'] = $this->facebook->api('/me');
			
			
            $uid = $this->data['user_profile']['id'];
            if (!$this->users->is_user_exist($uid)) {
                $user_info = array(
                    'uid' => $uid,
                    'username' => "",
                    'name' => $this->data['user_profile']['name'],
                    'role' => 3,
                    'status' => 1,
                    'facebook_uid' => $uid,
                    'insert_date' => date('Y-m-d H:i:s'),
                    'last_login' => date('Y-m-d H:i:s')
                );

                $this->users->add_data($user_info);
            } else {
                $this->users->update(array(
                    'last_login' => date('Y-m-d H:i:s')
                        ), array(
                    'uid' => $uid
                ));
            }

            unset($last_page);
            if ($this->session->userdata('last_page')) {
                $last_page = $this->session->userdata('last_page');
                $this->session->unset_userdata('last_page');
            }

            $rec_user = $this->users->get_user_info($uid);
            $this->session->set_userdata(array(
                'sess-id' => $rec_user->id,
                'sess-user' => $rec_user->username,
                'sess-name' => $rec_user->name,
                'sess-role' => $rec_user->role,
                'sess-gold_expired' => $rec_user->gold_expired,
                'sess-loggedin' => true,
                'is_admin' => false,
                'sess-starttime' => date('Y-m-d H:i:s')
            ));

            if (isset($last_page))
                redirect($last_page);
            else
                redirect('member_area', 'refresh');
        } else {
            redirect($this->facebook->getLoginUrl());
        }
    }

    function google_handler() {
        if ($this->session->userdata('sess-loggedin') == true) {
            redirect('home');
        } else {
            if (isset($_GET['code'])) {
                $this->googleplus->getAuthenticate();
                $this->data['user_profile'] = $this->googleplus->getUserInfo();

                $uid = $this->data['user_profile']['id'];
                if (!$this->users->is_user_exist($uid)) {
                    $user_info = array(
                        'uid' => $uid,
                        'username' => "",
                        'name' => $this->data['user_profile']['name'],
                        'email' => $this->data['user_profile']['email'],
                        'role' => 3,
                        'status' => 1,
                        'insert_date' => date('Y-m-d H:i:s'),
                        'last_login' => date('Y-m-d H:i:s')
                    );

                    $this->users->add_data($user_info);
                } else {
                    $this->users->update(array(
                        'last_login' => date('Y-m-d H:i:s')
                            ), array(
                        'uid' => $uid
                    ));
                }

                unset($last_page);
                if ($this->session->userdata('last_page')) {
                    $last_page = $this->session->userdata('last_page');
                    $this->session->unset_userdata('last_page');
                }

                $rec_user = $this->users->get_user_info($uid);
                $this->session->set_userdata(array(
                    'sess-id' => $rec_user->id,
                    'sess-user' => $rec_user->username,
                    'sess-name' => $rec_user->name,
                    'sess-role' => $rec_user->role,
                    'sess-gold_expired' => $rec_user->gold_expired,
                    'sess-loggedin' => true,
                    'is_admin' => false,
                    'sess-starttime' => date('Y-m-d H:i:s')
                ));

                if (isset($last_page))
                    redirect($last_page);
                else
                    redirect('member_area', 'refresh');
            }

            redirect($this->googleplus->loginURL());
        }
    }

    function proceed_login() {
        if ($this->input->post('sbm')) {
            $this->form_validation->set_error_delimiters("<li>", "</li>");
            $this->form_validation->set_rules('txt_username', 'User ID', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_pass', 'Password', 'required');
            $this->data ['last_position'] = $this->input->post('cur_url');
            if ($this->form_validation->run()) {
                $this->load->model('m_user', 'users');
                $rec_user = $this->users->get_user_info($this->input->post('txt_username'));
                if ($this->users->total_rows == 1) {
                    if ((md5($this->input->post('txt_pass')) == $rec_user->pass) && $rec_user->group != '0') {
                        if ($this->session->userdata('last_page')) {
                            $last_page = $this->session->userdata('last_page');
                            $this->session->unset_userdata('last_page');
                        }

                        $this->session->set_userdata(array(
                            'sess-user' => $rec_user,
                            'sess-loggedin' => true,
                            'is_admin' => $rec_user->group == '999' ? true : false,
                            'sess-adminloggedin' => true,
                            'sess-starttime' => date('Y-m-d H:i:s'),
                            'sess-donationdate' => date('Y-m-d')
                        ));

                        $this->users->update(array(
                            'last_login' => date('Y-m-d H:i:s')
                                ), array(
                            'uid' => $this->input->post('txt_username')
                        ));

                        if (isset($last_page))
                            redirect($last_page);
                        else
                            redirect('home');
                    } else {
                        $this->data['login_pray'] = false;
                        $this->data['sys_msg'] = get_messages('Your password doesn\'t match');
                        //$this->session->set_flashdata('msg', get_messages(wrap_text('Your password doesn\'t match')));
                    }
                } else {
                    $this->data['login_pray'] = false;
                    $this->data['sys_msg'] = get_messages('Your id not registered');
                    //$this->session->set_flashdata('msg', get_messages(wrap_text('Your id not registered')));
                }
            } else {
                $this->data['login_pray'] = false;
                $this->data['sys_msg'] = get_messages(validation_errors());
                //$this->session->set_flashdata('msg', get_messages(validation_errors()));
            }
        }
    }

    function other() {
        $this->data['page'] = $this->load->view($this->get_page(), $this->data, true);
        $this->render();
    }

    function forgot_password() {
        $this->data['advertise'] = $this->get_advertise();
        $this->data['page_icon'] = 'glyphicon-stats';
        $this->data['page_title'] = 'Welcome to Jawaban.com - Register';

        if ($this->input->post('sbm')) {
            $this->load_form_validation();
            $this->form_validation->set_rules('txt_email', 'Email', 'trim|xss_clean|required|valid_email');

            if ($this->form_validation->run()) {
                $this->data['email'] = $this->input->post('txt_email');
                $this->data['name'] = $this->users->get_nama($this->data['email']);
                $this->data['uid'] = $this->users->get_uid($this->data['email']);
                $this->data['code'] = md5($this->data['uid']) . md5(date('ymdHis'));
                $this->data['link'] = 'http://www.jawaban.com/login/password_recovery/' . $this->data['code'];

                $data = array('code' => $this->data['code']);

                if (!empty($this->data['name']) && !empty($this->data['uid'])) {
                    if ($this->users->edit_data($data, array('email' => $this->data['email'], 'uid' => $this->data['uid']->uid))) {
                        require_once APPPATH . 'libraries/swiftmail/swift_required.php';

                        $transport = Swift_SmtpTransport::newInstance('137.59.126.242', 25);
                        $transport->setUsername('no-reply@jawaban.com');
                        $transport->setPassword('cbni2016');

                        $swift = Swift_Mailer::newInstance($transport);
                        $message = Swift_Message::newInstance(null);

                        $message->setSubject('Password Recovery Jawaban.com');
                        $message->setBody($this->load->view('login/email', $this->data, true), 'text/html');
                        $mailer = Swift_Mailer::newInstance($transport);

                        if (!Swift_Validate::email($this->data['email'])) { //if email is not valid
                            $this->data ['message'] = get_messages('Email tidak valid');
                        } else {
                            $message->setTo($this->data['email']);
                            $message->setFrom('no-reply@jawaban.com');
                            $result = $mailer->send($message, $failures);

                            if (!($result)) {
                                $this->data ['sys_msg'] = get_messages($failures);
                            } else {
                                $this->data ['sys_msg'] = get_messages('Instruksi lebih lanjut telah dikirim ke email Anda.');
                            }
                        }
                    }
                } else
                    $this->data ['sys_msg'] = get_messages('Email Anda tidak terdaftar!');
            } else {
                $this->data['sys_msg'] = get_messages(validation_errors());
            }
        }

        $this->data['page'] = $this->load->view($this->get_page('forgot_password'), $this->data, true);
        $this->render();
    }

    function password_recovery() {
        $this->data['code'] = $this->uri->segment(3);
        $this->data['advertise'] = $this->get_advertise();
        $this->data['page_icon'] = 'glyphicon-stats';
        $this->data['page_title'] = 'Welcome to Jawaban.com - Register';

        if ($this->input->post('sbm')) {
            $this->load_form_validation();
            $this->form_validation->set_rules('txt_new', 'New Password', 'trim|xss_clean|required');
            $this->form_validation->set_rules('txt_retype', 'Retype Password', 'trim|xss_clean|required|matches[txt_new]');

            if ($this->form_validation->run()) {
                $this->data['uid'] = $this->users->get_uid_by_code($this->data['code']);
                $this->data['new'] = $this->input->post('txt_new');

                $data_pswd = array('pass' => md5($this->data['new']));
                if ($this->users->edit_data($data_pswd, array('uid' => $this->data['uid']->uid, 'code' => $this->data['code']))) {
                    //debug($this->db->last_query());
                    $empty_data = array('code' => '');
                    if ($this->users->edit_data($empty_data, array('uid' => $this->data['uid']->uid))) {
                        $this->data['success'] = get_messages('Success!');
                    } else
                        $this->data['sys_msg'] = get_messages('Error!');
                } else {
                    $this->data['sys_msg'] = get_messages('Error!');
                }
            } else {
                $this->data['sys_msg'] = get_messages(validation_errors());
            }
        } else {
            if (empty($this->users->get_uid_by_code($this->data['code'])))
                redirect(base_url() . 'notfound');
        }

        $this->data['page'] = $this->load->view($this->get_page('password_recovery'), $this->data, true);
        $this->render();
    }

    function success() {
        $this->data['advertise'] = $this->get_advertise();
        $this->data['page_icon'] = 'glyphicon-stats';
        $this->data['page_title'] = 'Welcome to Jawaban.com - Register';

        $this->data['page'] = $this->load->view($this->get_page('success'), $this->data, true);
        $this->render();
    }

}

/**
 * End of file home.php
 * Location : ./application/controllers/home.php
 */
