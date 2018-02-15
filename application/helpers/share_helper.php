<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('debug')) {

    function debug($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

}

if (!function_exists('wrap_text')) {

    function wrap_text($text, $prefix = '<li>', $sufix = '</li>') {
        return $prefix . $text . $sufix;
    }

}

if (!function_exists('get_messages')) {

    function get_messages($errors, $msg_type = 'alert-danger', $list_type = 'text-danger') {
        return '<div class="alert ' . $msg_type . '  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul class="list-unstyled ' . $list_type . '">' . $errors . '</ul></div>';
    }

}

if (!function_exists('print_avatar')) {

    function print_avatar($id) {
        $avatar = "";
        $target_dir = (APPPATH . '../assets/uploads/avatar/');
        $target_file = $target_dir . $id . '.' . 'jpg';
        if (file_exists($target_file)) {
            $avatar = BASE_URL . 'assets/uploads/avatar/' . $id . '.jpg';
        } else {
            $avatar = BASE_URL . 'assets/uploads/avatar/default.jpg';
        }
        return $avatar;
    }

}


if (!function_exists('generate_random_string')) {

    function generate_random_string($code_length = 8) {
        $alpha_numeric = '23456789abcdefghijkmnpqrstuvwxyz';
        return substr(str_shuffle($alpha_numeric), 0, $code_length);
    }

}




if (!function_exists('get_offset')) {

    function get_offset($page = 0, $limit = 10) {
        return ($page == 0 ? $page : ($page - 1)) * $limit;
    }

}

if (!function_exists('get_array_dimension_level')) {

    function get_array_dimension_level($arr, $level = 0) {
        if (is_array($arr)) {
            $level = $level + 1;
            if (count($arr) != count($arr, COUNT_RECURSIVE)) {
                $count = 0;
                foreach ($arr as $key => $val) {
                    if (is_array($val)) {
                        $countTemp = count($val, COUNT_RECURSIVE);
                        if ($countTemp > $count) {
                            $count = $countTemp;
                            $selected = $key;
                        }
                    }
                }
                return get_array_dimension_level($arr [$selected], $level);
            } else {
                return $level;
            }
        } else {
            return $level;
        }
    }

}

if (!function_exists('is_multidimensional_array')) {

    function is_multidimensional_array($arr) {
        return get_array_dimension_level($arr) > 1 ? TRUE : FALSE;
    }

}

if (!function_exists('parse_into_single_array')) {

    function parse_into_single_array($array, $level = 0, $key = 0, $opt_id = 0) {
        $dimension = get_array_dimension_level($array);
        $numrow1 = count($array);
        $data = array();
        $repeating_index = false;
        if ($level <= $dimension) {
            foreach ($array as $row) {
                $counter = 1;
                if (is_array($row)) {
                    $counter ++;
                    foreach ($row as $idx => $val) {
                        if ($counter === $level) {
                            if ($idx === $key) {
                                if ($opt_id === 0) {
                                    $data [] = $val;
                                } elseif ($opt_id === 1) {
                                    $data [$val] = $val;
                                } elseif ($opt_id === 2 || $opt_id === 3) {
                                    if (isset($data [$idx]) && !empty($data [$idx])) {
                                        if (!$repeating_index) {
                                            $temp = $data [$idx];
                                            unset($data);
                                            if ($opt_id === 2) {
                                                $data [$idx] [] = $temp;
                                            } elseif ($opt_id === 3) {
                                                $data [$idx] [$temp] = $temp;
                                            }
                                        }
                                        if ($opt_id === 2) {
                                            $data [$idx] [] = $val;
                                        } elseif ($opt_id === 3) {
                                            $data [$idx] [$val] = $val;
                                        }
                                        $repeating_index = true;
                                    } else {
                                        $data [$idx] = $val;
                                    }
                                }
                            }
                        }
                        $arr = $idx;
                    }
                } else {
                    foreach ($row as $idx => $val) {
                        if ($opt_id === 0) {
                            $data [] = $val;
                        } elseif ($opt_id === 1) {
                            $data [$val] = $val;
                        } elseif ($opt_id === 2 || $opt_id === 3) {
                            $data [$idx] = $val;
                        }
                    }
                    break;
                }
            }
        }
        return $data;
    }

}

if (!function_exists('convert_text')) {

    function convert_text($text) {
        $code_entities_match = array(
            ' ',
            '--',
            '_',
            '&quot;',
            '!',
            '@',
            '#',
            '$',
            '%',
            '^',
            '&',
            '*',
            '(',
            ')',
            '+',
            '{',
            '}',
            '|',
            ':',
            '"',
            '<',
            '>',
            '?',
            '[',
            ']',
            '\\',
            ';',
            "'",
            ',',
            '.',
            '/',
            '*',
            '+',
            '~',
            '`',
            '='
        );
        $code_entities_replace = '-';
        $text = strtolower(str_replace($code_entities_match, $code_entities_replace, trim($text)));
        $text = str_replace('--', '-', $text);
        if (substr($text, - 1, 1) == '-') {
            $text = substr($text, 0, strlen($text) - 1);
        }
        return $text;
    }

}

if (!function_exists('array_to_object')) {

    function array_to_object($data) {
        if (!is_array($data)) {
            return $data;
        }

        $object = new stdClass ();
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $name => $value) {
                $name = strtolower(convert_text($name));
                $object->{$name} = array_to_object($value);
            }
            return $object;
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('object_to_array')) {

    function object_to_array($data) {
        if ((!is_array($data)) and ( !is_object($data)))
            return $data;

        $data = (array) $data;
        $result = array();

        foreach ($data as $key => $value) {
            if (is_object($value))
                $value = (array) $value;
            if (is_array($value))
                $result [$key] = object_to_array($value);
            else
                $result [$key] = $value;
        }

        return $result;
    }

}

if (!function_exists('build_int_to_combo')) {

    function build_int_to_combo($start = 0, $end = 10, $name = 'int_choice', $default_value = 0, $increment = 1, $pad_left = true, $pad_length = 2, $pad_content = '0', $render_dropdown = true, $other_options = null) {
        $arr_combo = array();
        for ($i = $start; $i <= $end; $i = $i + $increment) {
            $val = str_pad($i, $pad_length, $pad_content, STR_PAD_LEFT);
            if ($pad_left) {
                $key = $val;
            } else {
                $key = $i;
            }
            $arr_combo ["{$key}"] = $val;
        }
        if ($render_dropdown) {
            return form_dropdown($name, $arr_combo, set_value("$name", $default_value), 'id="' . $name . '" class="form-control" ' . $other_options);
        } else {
            return $arr_combo;
        }
    }

}


if (!function_exists('get_permalink')) {

    function get_permalink($param, $controller_path, $method) {
        return site_url($controller_path . '/' . $method . '/' . $param);
    }

}

if (!function_exists('get_date_picker')) {

    function get_date_picker($opt = null, $render = false) {
        $opt ['lang'] = isset($opt ['lang']) ? $opt ['lang'] : 'id';
        // year config
        $opt ['active_year'] = isset($opt ['active_year']) ? $opt ['active_year'] : date('Y');
        $opt ['start_year'] = isset($opt ['start_year']) ? ($opt ['active_year'] + $opt ['start_year']) : $opt ['active_year'] - 10;
        $opt ['end_year'] = isset($opt ['end_year']) ? ($opt ['active_year'] + $opt ['end_year']) : $opt ['active_year'] + 10;
        $opt ['year_sort'] = isset($opt ['year_sort']) ? $opt ['year_sort'] : 'desc';
        // month config
        $opt ['active_month'] = isset($opt ['active_month']) ? $opt ['active_month'] : date('n');
        $opt ['start_month'] = isset($opt ['start_month']) ? ($opt ['active_month'] + $opt ['start_month']) : 1;
        $opt ['end_month'] = isset($opt ['end_month']) ? ($opt ['active_month'] + $opt ['end_month']) : 12;
        // date config
        $opt ['active_date'] = isset($opt ['active_date']) ? $opt ['active_date'] : date('d');
        $opt ['start_date'] = isset($opt ['start_date']) ? ($opt ['active_date'] + $opt ['start_date']) : 1;
        $opt ['end_date'] = isset($opt ['end_date']) ? ($opt ['active_date'] + $opt ['end_date']) : 31;
        // hour config
        $opt ['active_hour'] = isset($opt ['active_hour']) ? $opt ['active_hour'] : date('h');
        $opt ['start_hour'] = isset($opt ['start_hour']) ? $opt ['start_hour'] : 0;
        $opt ['end_hour'] = isset($opt ['end_hour']) ? $opt ['end_hour'] : 23;
        // minute config
        $opt ['active_minute'] = isset($opt ['active_minute']) ? $opt ['active_minute'] : date('i');
        $opt ['start_minute'] = isset($opt ['start_minute']) ? $opt ['start_minute'] : 0;
        $opt ['end_minute'] = isset($opt ['end_minute']) ? $opt ['end_minute'] : 59;
        // config enable display
        $opt ['show_minute'] = isset($opt ['show_minute']) ? $opt ['show_minute'] : true;
        $opt ['show_hour'] = isset($opt ['show_hour']) ? $opt ['show_hour'] : true;
        $opt ['show_date'] = isset($opt ['show_date']) ? $opt ['show_date'] : true;
        $opt ['show_month'] = isset($opt ['show_month']) ? $opt ['show_month'] : true;
        $opt ['show_year'] = isset($opt ['show_year']) ? $opt ['show_year'] : true;
        // config option name
        $opt ['minute_optname'] = isset($opt ['minute_optname']) ? $opt ['minute_optname'] : 'opt_minute';
        $opt ['hour_optname'] = isset($opt ['hour_optname']) ? $opt ['hour_optname'] : 'opt_hour';
        $opt ['date_optname'] = isset($opt ['date_optname']) ? $opt ['date_optname'] : 'opt_date';
        $opt ['month_optname'] = isset($opt ['month_optname']) ? $opt ['month_optname'] : 'opt_month';
        $opt ['year_optname'] = isset($opt ['year_optname']) ? $opt ['year_optname'] : 'opt_year';
        // exception config
        $opt ['exc_minute'] = isset($opt ['exc_minute']) && is_array($opt ['exc_minute']) ? $opt ['exc_minute'] : array();
        $opt ['exc_hour'] = isset($opt ['exc_hour']) && is_array($opt ['exc_hour']) ? $opt ['exc_hour'] : array();
        $opt ['exc_date'] = isset($opt ['exc_date']) && is_array($opt ['exc_date']) ? $opt ['exc_date'] : array();
        $opt ['exc_month'] = isset($opt ['exc_month']) && is_array($opt ['exc_month']) ? $opt ['exc_month'] : array();
        $opt ['exc_year'] = isset($opt ['exc_year']) && is_array($opt ['exc_year']) ? $opt ['exc_year'] : array();
        // interval config
        $opt ['minute_interval'] = isset($opt ['minute_interval']) ? $opt ['minute_interval'] : 10;
        $opt ['hour_interval'] = isset($opt ['hour_interval']) ? $opt ['hour_interval'] : 1;
        $opt ['date_interval'] = isset($opt ['date_interval']) ? $opt ['date_interval'] : 1;
        $opt ['month_interval'] = isset($opt ['month_interval']) ? $opt ['month_interval'] : 1;
        $opt ['year_interval'] = isset($opt ['year_interval']) ? $opt ['year_interval'] : 1;
        // default value
        $opt ['default_minute'] = isset($opt ['default_minute']) ? $opt ['default_minute'] : date('i');
        $opt ['default_hour'] = isset($opt ['default_hour']) ? $opt ['default_hour'] : date('h');
        $opt ['default_date'] = isset($opt ['default_date']) ? $opt ['default_date'] : date('d');
        $opt ['default_month'] = isset($opt ['default_month']) ? $opt ['default_month'] : date('n');
        $opt ['default_year'] = isset($opt ['default_year']) ? $opt ['default_year'] : date('Y');
        // extra option
        $opt ['extra_opt_minute'] = isset($opt ['extra_opt_minute']) ? $opt ['extra_opt_minute'] : '';
        $opt ['extra_opt_hour'] = isset($opt ['extra_opt_hour']) ? $opt ['extra_opt_hour'] : '';
        $opt ['extra_opt_date'] = isset($opt ['extra_opt_date']) ? $opt ['extra_opt_date'] : '';
        $opt ['extra_opt_month'] = isset($opt ['extra_opt_month']) ? $opt ['extra_opt_month'] : '';
        $opt ['extra_opt_year'] = isset($opt ['extra_opt_year']) ? $opt ['extra_opt_year'] : '';
        // option wrapper
        $opt ['wrapper_opt_minute'] = '';
        $data = array();
        for ($i = $opt ['start_minute']; $i <= $opt ['end_minute'];) {
            if (!in_array($i, $opt ['exc_minute'])) {
                $data ['minute'] [$i] = str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            $i += $opt ['minute_interval'];
        }

        for ($i = $opt ['start_hour']; $i <= $opt ['end_hour'];) {
            if (!in_array($i, $opt ['exc_hour'])) {
                $data ['hour'] [$i] = str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            $i += $opt ['hour_interval'];
        }

        for ($i = $opt ['start_date']; $i <= $opt ['end_date'];) {
            if (!in_array($i, $opt ['exc_date'])) {
                $data ['date'] [$i] = str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            $i += $opt ['date_interval'];
        }

        for ($i = $opt ['start_month']; $i <= $opt ['end_month'];) {
            if (!in_array($i, $opt ['exc_month'])) {
                $data ['month'] [$i] = convertNumToMonth($i - 1, $opt ['lang']);
            }
            $i += $opt ['month_interval'];
        }

        if ($opt ['year_sort'] === 'desc') {
            for ($i = $opt ['end_year']; $i >= $opt ['start_year'];) {
                if (!in_array($i, $opt ['exc_year'])) {
                    $data ['year'] [$i] = $i;
                }
                $i -= $opt ['year_interval'];
            }
        } else {
            for ($i = $opt ['start_year']; $i <= $opt ['end_year'];) {
                if (!in_array($i, $opt ['exc_year'])) {
                    $data ['year'] [$i] = $i;
                }
                $i += $opt ['year_interval'];
            }
        }

        $datepicker ['minute'] = form_dropdown($opt ['minute_optname'], $data ['minute'], set_value("{$opt['minute_optname']}", $opt ['default_minute']), 'id="' . $opt ['minute_optname'] . '" class="form-control" ' . $opt ['extra_opt_minute']);
        $datepicker ['hour'] = form_dropdown($opt ['hour_optname'], $data ['hour'], set_value("{$opt['hour_optname']}", $opt ['default_hour']), 'id="' . $opt ['hour_optname'] . '" class="form-control" ' . $opt ['extra_opt_hour']);
        $datepicker ['date'] = form_dropdown($opt ['date_optname'], $data ['date'], set_value("{$opt['date_optname']}", $opt ['default_date']), 'id="' . $opt ['date_optname'] . '" class="form-control" ' . $opt ['extra_opt_date']);
        $datepicker ['month'] = form_dropdown($opt ['month_optname'], $data ['month'], set_value("{$opt['month_optname']}", $opt ['default_month']), 'id="' . $opt ['month_optname'] . '" class="form-control" ' . $opt ['extra_opt_month']);
        $datepicker ['year'] = form_dropdown($opt ['year_optname'], $data ['year'], set_value("{$opt['year_optname']}", $opt ['default_year']), 'id="' . $opt ['year_optname'] . '" class="form-control" ' . $opt ['extra_opt_year']);

        if ($render) {
            $result = implode(' ', $datepicker);
            return $result;
        } else {
            return $datepicker;
        }
    }

}

if (!function_exists('render_html_title')) {

    function render_html_title($data, $buff = FALSE) {
        $str_title = '<title>' . htmlentities($data) . '</title>';
        if ($buff === TRUE) {
            return $str_title;
        } else {
            echo $str_title;
        }
    }

}

if (!function_exists('render_html_metalink')) {

    function render_html_metalink($data, $type = 'meta', $buff = FALSE) {
        $str_metalink = '';
        if (is_array($data)) {
            foreach ($data as $metalink) {
                $str_metalink .= '<' . $type . ' ';
                foreach ($metalink as $key => $val) {
                    $str_metalink .= $key . ' ="' . $val . '" ';
                }
                if ($type === 'script') {
                    $str_metalink .= '></' . $type . '>';
                } else {
                    $str_metalink .= ' />';
                }
            }
        }

        if ($buff === TRUE) {
            return $str_metalink;
        } else {
            echo $str_metalink;
        }
    }

}

if (!function_exists('disp_data')) {

    function disp_data($data, $default = '-') {
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return $default;
        }
    }

}

if (!function_exists('generate_hash')) {

    function generate_hash($password) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }

}

if (!function_exists('verify_hashed_pwd')) {

    function verify_hashed_pwd($password, $hashedPassword) {
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

}

if (!function_exists('generate_user_key')) {

    function generate_user_key() {
        return hash('sha256', generate_rand_string() . microtime());
    }

}

if (!function_exists('generate_rand_string')) {

    function generate_rand_string($code_length = 8) {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($alpha_numeric), 0, $code_length);
    }

}

if (!function_exists('resized_image')) {

    function resized_image($filename, $new_filename, $file_ext, $new_width = null, $new_height = null, $percent = 25) {
        list ( $width, $height ) = getimagesize($filename);
        /**
         * Create Width *
         */
        if (empty($new_width)) {
            $tmp_width = $width * ($percent / 100);
        } else {
            $tmp_width = $new_width;
        }
        /**
         * Create Height *
         */
        if (empty($new_height)) {
            $tmp_height = $height * ($percent / 100);
        } else {
            $tmp_height = $new_height;
        }

        $thumb = imagecreatetruecolor($tmp_width, $tmp_height);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $tmp_width, $tmp_height, $width, $height);
        $result = imagejpeg($thumb, UPLOAD_PATH_IMG_THUMB . '/' . $new_filename . $file_ext);
        imagedestroy($thumb);
        return $result;
    }

}
if (!function_exists('setup_seo')) {

    /**
     * is_exists
     * this function in to Setup SEO
     *
     * @author hunter.nainggolan
     *         @date 04/06/2014
     * @param string $title        	
     * @param string $desc        	
     * @param string $image        	
     * @return array
     */
    function setup_seo($title, $desc, $image) {
        $data [0] ['property'] = 'og:title';
        $data [0] ['content'] = $title;
        $data [1] ['property'] = 'og:description';
        $data [1] ['content'] = $desc;
        $data [2] ['property'] = 'og:image';
        $data [2] ['content'] = $image;
        return $data;
    }

}
if (!function_exists('is_exists')) {

    /**
     * is_exists
     * this function in to check existency url or file
     *
     * @author hunter.nainggolan
     *         @date 11/12/2012
     * @param string $url
     *        	url to be in check
     * @return boolean
     */
    function is_exists($url) {
        error_reporting(0);
        $result = (bool) file_get_contents($url);
        error_reporting(- 1);
        return $result;
    }

}

if (!function_exists('folder_user')) {

    /**
     * function folder_user
     * check is folder upload path user id exist.
     * if not, create folder user and subfolder main and thumbs
     *
     * @author hunter.nainggolan
     *         @date February 12th, 2013
     *        
     * @param string $uid
     *        	userid uploader
     * @return void
     */
    function folder_user($uid) {
        $filename = realpath(APPPATH . '../assets/uploads/' . $uid);
        $user = 'assets/uploads/' . $uid;
        $image = 'assets/uploads/' . $uid . '/images';
        $main = 'assets/uploads/' . $uid . '/images/main';
        $thumb = 'assets/uploads/' . $uid . '/images/thumbs';
        $audio = 'assets/uploads/' . $uid . '/audios';
        $video = 'assets/uploads/' . $uid . '/videos';
        $video_main = 'assets/uploads/' . $uid . '/videos/main';
        $video_thumb = 'assets/uploads/' . $uid . '/videos/thumbs';
        $document = 'assets/uploads/' . $uid . '/documents';
        $document_main = 'assets/uploads/' . $uid . '/documents/main';
        $document_thumb = 'assets/uploads/' . $uid . '/documents/thumbs';

        if (!is_dir($filename)) {
            mkdir($user);
            mkdir($image);
            mkdir($main);
            mkdir($thumb);
            mkdir($audio);
            mkdir($video);
            mkdir($video_main);
            mkdir($video_thumb);
            mkdir($document);
            mkdir($document_main);
            mkdir($document_thumb);
        }
    }

}

if (!function_exists('extractString')) {

    /**
     * extractString
     * extracting keyword that separated by commas delimiter into array
     *
     * @package share_helper on jawaban.com
     * @author hunter.nainggolan <hunter.nainggolan@gmail.com>
     * @copyright (c) October 2014, Hunter Nainggolan
     * @param string $string        	
     * @param string $separator     
     * @return array $arrString
     */
    function extractString($string, $separator = ',') {
        $arrString = array();
        $string = trim($string);
        $arrString = explode($separator, $string);
        $arrString = array_unique(array_filter($arrString));
        foreach ($arrString as $index => $value) {
            $arrString [$index] = trim($value);
        }
        return $arrString;
    }

}
if (!function_exists('convertToRupiah')) {

    /**
     * convertToRupiah
     * extracting keyword that separated by commas delimiter into array
     *
     * @package share_helper on jawaban.com
     * @author hunter.nainggolan <hunter.nainggolan@gmail.com>
     * @copyright (c) October 2015, Hunter Nainggolan
     * @param string $string        	
     * @return string $rupiah
     */
    function convertToRupiah($value) {
        return 'Rp. ' . strrev(implode('.', str_split(strrev(strval($value)), 3)));
    }

}

if (!function_exists('configPagination')) {

    /**
     * configPagination
     * config for pagination database
     *
     * @package share_helper on leveloco.com
     * @author vanderwyk.siahaan <mubasiahaan@gmail.com>
     * @copyright (c) January 2017, Vanderwk Siahaan
     * @param string $controler, integer $total, integer $per_page        	
     * @return array $config
     */
    function configPagination($controler, $total, $per_page = 4) {

        $config['base_url'] = BASE_URL . $controler;
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['query_string_segment'] = 'start';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_link'] = 'first';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'prev-';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '-next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = 'last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        return $config;
    }

}

if (!function_exists('create_rating')) {

    function create_rating($var) {
        $rat = floor($var);
        $rating = "";
        switch ($rat) {
            case 1:
                $rating = 'onestar';
                break;
            case 2:
                $rating = 'twostar';
                break;
            case 3:
                $rating = 'threestar';
                break;
            case 4:
                $rating = 'fourstar';
                break;
            case 5:
                $rating = 'fivestar';
                break;
            default:
                break;
        }
        return $rating;
    }

}

if (!function_exists('send_email')) {

    function send_email($recepient, $subject, $html) {
        include_once "assets/plugins/swift_mail/swift_required.php";


        $from = array('no-reply@nyarievent.com' => 'no-reply');
        $to = array(
            $recepient => ''
        );

        $message = "";
        $status = false;

        $transport = Swift_SmtpTransport::newInstance('101.50.1.204', 26);
        $transport->setUsername('no-reply@nyarievent.com');
        $transport->setPassword('nyaripass');

        $swift = Swift_Mailer::newInstance($transport);

        $message = new Swift_Message($subject);
        $message->setFrom($from);
        $message->setBody($html, 'text/html');
        $message->setTo($to);
        //$message->addPart($text, 'text/plain');
        //$message->attach(Swift_Attachment::fromPath('2228.pdf'));

        if ($recipients = $swift->send($message, $failures)) {

            $message = "Message successfully sent!";
            $status = true;
        } else {

            $message = "There was an error:\n";
            $status = false;
        }

        return 'horas';
    }

}

/**
 * End of file share_helper.php
 * Location : ./application/helpers/share_helper.php
 */