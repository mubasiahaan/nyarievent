<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    protected $_ci;
    protected $_table;
    protected $_view;
    protected $_relations = array();
    protected $_foreign_key;
    protected $_result;
    protected $_obj_return;
    protected $_row_return;
    var $num_rows;
    var $total_rows;

    function __construct()
    {
        parent::__construct();
    }

    function connect_database($Config = "default")
    {
        $this->load->database($Config, TRUE);
    }

    function set_table($table)
    {
        $this->_table = $table;
    }

    protected function filter_input($data, $opt = true)
    {
        $fields = $this->db->list_fields($this->_table);

        foreach ($data as $key => $value) {
            if (!in_array($key, $fields)) {
                unset($data[$key]);
            } else {
                if ($opt == true) {
                    $data[$key] = trim($this->security->xss_clean($value));
                }
            }
        }

        return $data;
    }

    function set_view($view)
    {
        $this->_view = $view;
    }

    function get_table()
    {
        return $this->_table;
    }

    function get_view()
    {
        return $this->_view;
    }

    function get_datasource($use_view = true)
    {
        if ($use_view && !empty($this->_view)) {
            return $this->_view;
        } else {
            return $this->_table;
        }
    }

    function get($use_view = true)
    {
        return $this->db->get($this->get_datasource($use_view));
    }

    function get_where($filters, $limit = "", $offset = "")
    {
        return ($limit === "" ? $this->db->get_where($this->get_datasource(), $filters) : $this->db->get_where($this->get_datasource(), $filters, $limit, $offset));
    }

    function get_result($method = "result")
    {
        $this->from($this->get_datasource());
        return $this->db->get()->{$method}();
    }

    function result($query, $method = "result")
    {
        return $query->{$method}();
    }

    function select($field)
    {
        $this->db->select($field);
    }

    function select_max($field, $alias = null)
    {
        $alias ? $this->db->select_max($field) : $this->db->select_max($field, $alias);
    }

    function select_min($field, $alias = null)
    {
        $alias ? $this->db->select_min($field) : $this->db->select_min($field, $alias);
    }

    function select_avg($field, $alias = null)
    {
        $alias ? $this->db->select_avg($field) : $this->db->select_avg($field, $alias);
    }

    function select_sum($field, $alias = null)
    {
        $alias ? $this->db->select_sum($field) : $this->db->select_sum($field, $alias);
    }

    function from($table)
    {
        $this->db->from($table);
    }

    function join($table, $join_field, $join_type = null)
    {
        $join_type ? $this->db->join($table, $join_field, $join_type) : $this->db->join($table, $join_field);
    }

    function where($field, $value = null)
    {
        $this->db->where($field, $value);
    }

    function or_where($field, $value)
    {
        $this->db->or_where($field, $value);
    }

    function where_in($field, $values)
    {
        $this->db->where_in($field, $values);
    }

    function or_where_in($field, $values)
    {
        $this->db->or_where_in($field, $values);
    }

    function where_not_in($field, $values)
    {
        $this->db->where_not_in($field, $values);
    }

    function or_where_not_in($field, $values)
    {
        $this->db->or_where_not_in($field, $values);
    }

    function like($field, $value = null, $wildcard = "both")
    {
        $this->db->like($field, $value, $wildcard);
    }

    function or_like($field, $value = null, $wildcard = "both")
    {
        $this->db->or_like($field, $value, $wildcard);
    }

    function not_like($field, $value = null, $wildcard = "both")
    {
        $this->db->not_like($field, $value, $wildcard);
    }

    function or_not_like($field, $value = null, $wildcard = "both")
    {
        $this->db->or_not_like($field, $value, $wildcard);
    }

    function group_by($fields)
    {
        $this->db->group_by($fields);
    }

    function distinct()
    {
        $this->db->distinct();
    }

    function having($field, $value = null)
    {
        $this->db->having($field, $value);
    }

    function or_having($field, $value = null)
    {
        $this->db->or_having($field, $value);
    }

    function order_by($field, $direction = 'asc')
    {
        $this->db->order_by($field, $direction);
    }

    function limit($row, $offset = null)
    {
        $this->db->limit($row, $offset);
    }

    function insert($data = array(), $opt = true)
    {
        return $this->db->insert($this->_table, $this->filter_input($data, $opt));
    }

    function insert_batch($data)
    {
        return $this->db->insert_batch($this->_table, $data);
    }

    function get_insert_id()
    {
        return $this->db->insert_id();
    }

    function delete($key = array())
    {
        return $this->db->delete($this->_table, $this->filter_input($key));
    }

    function update($data = array(), $key = array(), $opt = true)
    {
        return $this->db->update($this->_table, $this->filter_input($data, $opt), $key);
    }

    function update_batch($data, $key)
    {
        return $this->db->update_batch($this->_table, $data, $key);
    }

    function empty_table()
    {
        return $this->db->empty_table($this->_table);
    }

    function truncate()
    {
        return $this->db->truncate($this->_table);
    }

    function start_cache()
    {
        return $this->db->start_cache();
    }

    function stop_cache()
    {
        return $this->db->stop_cache();
    }

    function set($field, $value = null, $opt = true)
    {
        return $this->db->set($field, $value, $opt);
    }

    function trans_begin()
    {
        return $this->db->trans_begin();
    }

    function trans_start($value = false)
    {
        return $this->db->trans_start($value);
    }

    function trans_status()
    {
        return $this->db->trans_status();
    }

    function trans_strict($value = true)
    {
        return $this->db->trans_strict($value);
    }

    function trans_commit()
    {
        return $this->db->trans_commit();
    }

    function trans_complete()
    {
        return $this->db->trans_complete();
    }

    function trans_rollback()
    {
        return $this->db->trans_rollback();
    }

    function trans_off()
    {
        return $this->db->trans_off();
    }

    function call_sp($query_sp, $data_input = null, $data_return = null)
    {
        $query = "call {$query_sp}({$data_input})";
        $this->_result = $this->db->query($query);

        if (!empty($data_return)) {
            $query_return = "select {$data_return}";
            $this->_obj_return = $this->db->query($query_return);
            $this->_row_return = $this->_obj_return->row();
        }

        return $this->_result;
    }

    function get_enum_values($field_name, $opt_key = 1)
    {
        $arr_enum_values = array();
        $sql = "SHOW COLUMNS FROM " . $this->get_datasource() . " WHERE FIELD =\"" . $field_name . "\"";
        $res = $this->db->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->row();
            $str_enum = $row->Type;
            $offset = strpos($str_enum, '(');
            $data_enum = substr($str_enum, $offset + 1, strlen($str_enum) - $offset - 2);
            $val_enum = explode(',', $data_enum);
            foreach ($val_enum as $key => $val) {
                $val = trim(str_replace("'", "", $val));
                $arr_enum_values[($opt_key ? $val : $key)] = $val;
            }
        }
        return $arr_enum_values;
    }

    function get_data($field = null, $search = null, $limit = null, $offset = 0, $field_order = null, $group_by = null, $method = 'result', $join = null, $use_view = true)
    {
        if (is_array($search)) {
            $search = $this->filter_input($search);
        }

        // get count of all results
        // *************************************************************

        $is_multidimensional_join = is_multidimensional_array($join);
        if (!empty($join)) {
            if ($is_multidimensional_join) {
                foreach ($join as $key => $val) {
                    $table_join = $val[0];
                    $table_portion = $val[1];
                    if (isset($val[2])) {
                        $join_type = $val[2];
                        $this->join($table_join, $table_portion, $join_type);
                    } else {
                        $this->join($table_join, $table_portion);
                    }
                }
            } else {
                $table_join = $join[0];
                $table_portion = $join[1];
                if (isset($join[2])) {
                    $join_type = $join[2];
                    $this->join($table_join, $table_portion, $join_type);
                } else {
                    $this->join($table_join, $table_portion);
                }
            }
        }

        if (!empty($search)) {
            $this->where($search);
        }

        $this->total_rows = $this->count_all_results();
        // ************************************************************************

        if (!empty($field)) {
            $this->select($field);
        }

        if (!empty($join)) {
            if ($is_multidimensional_join) {
                foreach ($join as $key => $val) {
                    $table_join = $val[0];
                    $table_portion = $val[1];
                    if (isset($val[2])) {
                        $join_type = $val[2];
                        $this->join($table_join, $table_portion, $join_type);
                    } else {
                        $this->join($table_join, $table_portion);
                    }
                }
            } else {
                $table_join = $join[0];
                $table_portion = $join[1];
                if (isset($join[2])) {
                    $join_type = $join[2];
                    $this->join($table_join, $table_portion, $join_type);
                } else {
                    $this->join($table_join, $table_portion);
                }
            }
        }
        if (!empty($search)) {
            $this->where($search);
        }
        if (!empty($limit)) {
            $this->limit($limit, $offset);
        }

        if (!empty($field_order)) {
            $this->db->order_by($field_order);
        }

        if (!empty($group_by)) {
            $this->group_by($group_by);
        }
        $query = $this->get($use_view);
        $this->num_rows = $query->num_rows();
        return $query->{$method}();
    }

    function list_fields()
    {
        return $this->db->list_fields($this->_table);
    }

    function field_exists($field)
    {

        return $this->db->field_exists($field, $this->_table);
    }

    function field_data()
    {
        return $this->db->field_data($this->_table);
    }

    function count_all()
    {
        return $this->db->count_all($this->_table);
    }

    function count_all_results()
    {
        return $this->db->count_all_results($this->_table);
    }
}

/**
 * End of file MY_Model.php
 * Location : ./application/core/MY_Model.php
 */