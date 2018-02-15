<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**

 * Class Article_model

 * created by : Vanderwyk Siahaan <vanderwyk.siahaan@cbn.or.id>

 * date : 04 March 2014

 */
class Slider_model extends MY_Model {

    function __construct() {

        parent::__construct();

        $this->set_table('slider');

        $this->arr_id = '';
    }

    /**

     * function add_data

     * to add data to mitra table

     * @author vanderwyk.siahaan

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

}

/**

 * End of file mitra_model.php

 * Location: ./application/models/mitra_model.php

 */