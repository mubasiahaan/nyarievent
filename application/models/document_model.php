<?php

defined('BASEPATH') or exit('No Direct Script Allowed');

Class Document_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'document';
//        $this->_view = 'v_product';
    }

}
