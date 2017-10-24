<?php

/**
 *  A Model class: operate duty table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Duty_model extends CI_Model
{

    /**
     *  Load database: default
     */
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * SQL:
     *    SELECT team, duty_date, op
     *    FROM duty
     *    WHERE duty_date>=$monday
     *    AND duty_date<=$sunday
     *
     * @return array
     */
    public function getWeekDuty($monday, $sunday)
    {
        $this->db->select('team, duty_date, op');
        $this->db->from('duty');
        $this->db->where('duty_date >=',$monday);
        $this->db->where('duty_date <=',$sunday);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * SQL:
     *    SELECT * FROM duty
     *    WHERE team=$team
     *    AND duty_date=$duty_date
     *
     *    INSERT INTO duty(team, duty_date, op)
     *    VALUES($team, $duty_date, $op)
     *
     *    UPDATE duty
     *    SET op=$op
     *    WHERE team=$team
     *    AND duty_date=$duty_date
     *
     * @return integer
     */
    public function changeDuty($team, $duty_date, $op)
    {
        $this->db->where('team',$team);
        $this->db->where('duty_date',$duty_date);
        $num = $this->db->get('duty')->num_rows();
        if (0 == $num) {
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

