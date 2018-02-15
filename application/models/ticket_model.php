<?php

defined('BASEPATH') or exit('No Direct Script Allowed');

Class Ticket_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'ticket';
        $this->_view = 'view_ticket';
    }

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

    public function get_related($id = '', $keyword = '', $limit = 0) {
        $query_like = "SELECT id,title,image,category_id FROM " . $this->_table . " WHERE id != " . $id . " AND status = 1 AND (";
        $keyword = extractString($keyword, ',');
        $count = count($keyword);
        $result = null;
        if ($count != 0) {
            for ($i = 0; $i < $count; $i ++) {
                if ($i == 0 && array_key_exists($i, $keyword)) {
                    $query_like .= "keyword LIKE '%" . $keyword [$i] . "%' ";
                } elseif (array_key_exists($i, $keyword)) {
                    $query_like .= "OR keyword LIKE '%" . $keyword [$i] . "%' ";
                }
            }
            $query_like .= ") ORDER BY insert_date DESC LIMIT 0," . $limit;
            $query = $this->db->query($query_like);
            $result = $query->result();
        }
        return $result;
    }

}
