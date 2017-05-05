<?php

/**
 *  model class about duty table
 *  @author ye.zhiqin@outlook.com
 */
class Duty_model extends CI_Model {

    /**
     *  The class constructor
     */
    public function __construct() {
        $this->load->database();
    }

    public function getWeekDuty($monday, $sunday) {
        $this->db->select('team, duty_date, op');
        $this->db->from('duty');
        $this->db->where('duty_date >=',$monday);
        $this->db->where('duty_date <=',$sunday);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function changeDuty($team, $duty_date, $op) {
        $this->db->where('team',$team);
        $this->db->where('duty_date',$duty_date);
        $num = $this->db->get('duty')->num_rows();
        if(0 == $num) {
            $data = array(
                'team'=>$team,
                'duty_date'=>$duty_date,
                'op'=>$op,
            );
            return $this->db->insert('duty', $data);
        } else {
            $this->db->set('op', $op);
            $this->db->where('team',$team);
            $this->db->where('duty_date',$duty_date);
            return $this->db->update('duty');
        }
    }
}
