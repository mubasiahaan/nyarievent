<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Info_model
 * created by : Hunter Nainggolan <hunter.nainggolan@gmail.com>
 * date : April 04th, 2015
 */
class Info_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->set_table('info');
    }

    /**
     * function add_data
     * to add data to company table
     * @author hunter.nainggolan
     * @date April 4, 2015
     * @access public
     * 
     * @param array $data  
     * @return boolean
     */
    public function add_data($data) {
        $this->trans_begin();
        $this->insert($data);
        $this->insert_id = $this->get_insert_id();
        if ($this->trans_status()) {
            $this->trans_commit();
            return true;
        } else {
            $this->trans_rollback();
            return false;
        }
    }

    /**
     * edit_data
     * to change data in company table
     * @author hunter.nainggolan
     * @date April 4, 2015
     * @access public
     * 
     * @param array $data
     * @param array $where 
     * @return boolean
     */
    public function edit_data($data, $where = null) {
        $this->trans_begin();
        $this->update($data, $where);
        if ($this->trans_status()) {
            $this->trans_commit();
            return true;
        } else {
            $this->trans_rollback();
            return false;
        }
    }

    /**
     * delete_data
     * to delete data from company table
     * @author hunter.nainggolan
     * @date April 4, 2015
     * @access public
     * 
     * @param array $where
     * @return boolean
     */
    public function delete_data($where = null) {
        $this->trans_begin();
        $this->delete($where);
        if ($this->trans_status()) {
            $this->trans_commit();
            return true;
        } else {
            $this->trans_rollback();
            return false;
        }
    }

    public function get_about() {
        return $this->get_data(null, array('id' => 1), null, null, null, null, 'row');
    }

    public function get_contact() {
        $data = $this->get_data(null, array('id' => 2), null, null, null, null, 'row');
        return unserialize($data->detail);
    }

}

/**
 * End of file info_model.php
 * Location: ./application/models/info_model.php
 */