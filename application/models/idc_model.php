<?php

/**
 *  model class about idc table
 *  @author yezhiqin@outlook.com
 */
class Idc_model extends CI_Model {

    /**
     *  The class constructor
     */
    public function __construct() {
        $this->load->database();
    }

    public function getIdcs() {
        $this->db->select('id, name, address, administrator, tel');
        $this->db->from('idc');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function addIdc($name, $address, $administrator, $tel) {
        $data = array(
            'name'=>$name,
            'address'=>$address,
            'administrator'=>$administrator,
            'tel'=>$tel,
        );
        return $this->db->insert('idc', $data);
    }

    public function updateIdc($id, $name, $address, $administrator, $tel) {
        $data = array(
            'name' => $name,
            'address' => $address,
            'administrator' => $administrator,
            'tel' => $tel,
        );
        $this->db->where('id', $id);
        return $this->db->update('idc', $data);
    }

    public function deleteIdc($id) {
        $this->db->where('id', $id);
        return $this->db->delete('idc');
    }

}
