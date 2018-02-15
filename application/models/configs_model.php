<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configs_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table = 'configs';
    }

}

/**
 * End of file configs_model.php
 * Location: ./application/models/configs_model.php
 */