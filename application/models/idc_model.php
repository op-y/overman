<?php

/**
 *  model class about idc table
 *  @author ye.zhiqin@outlook.com
 */
class Idc_model extends CI_Model {

    /**
     *  The class constructor
     */
    public function __construct() {
        $this->load->database();
    }

    public function getIdcs() {
        $this->db->select('name, address, administrator, tel');
        $this->db->from('idc');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

}
