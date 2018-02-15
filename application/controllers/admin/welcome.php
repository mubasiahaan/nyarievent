<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Info
 *
 *  @author Vanderwyk Siahaan
 *  @date March 16th, 2015
 */
class Welcome extends MY_Controller {

    function __construct() {
        parent::__construct();
        redirect(site_url('admin/home'));
    }

}

/**
 * End of file info.php
 * Location : ./application/controllers/admin/info.php
 */