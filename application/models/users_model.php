<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table = 'users';
    }

    /**
     * Get User Profile
     *
     * @access public
     * @param string $sUsername        	
     * @return std Object
     */

    /**
     * function add_data
     * to add data to mitra table
     * @author vina.agustina
     * @date 4 March 2014
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
     * to change data in Mitra table
     * @author vina.agustina
     * @date 14 June 2012
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
     * to delete data from Mitra table
     * @author bambang.adrian
     * @date 14 June 2012
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

    public function check_user($username = null) {
        $result = false;
        $query = $this->db->query('SELECT id FROM ' . $this->_table . ' WHERE username = "' . $username . '" ');
        if ($query->num_rows > 0) {
            $result = true;
        }
        return $result;
    }

    function is_user_exist($uid) {
        $this->get_data('name', array('uid' => $uid));
        return $this->num_rows == 1 ? true : false;
    }

    function get_user_info($user_id = null) {
        return $user_id == null ? array() : $this->get_data(null, array(
                    'uid' => $user_id
                        ), null, null, null, null, 'row');
    }

}

/**
 * End of file sys_users_model.php
 * Location: ./application/models/sys_users_model.php
 */