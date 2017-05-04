<?php

/**
 *  model class about event table
 *  @author ye.zhiqin@outlook.com
 */
class Event_model extends CI_Model {

    /**
     *  The class constructor
     */
    public function __construct() {
        $this->load->database();
    }

    public function getEvents() {
        // we may limit the result in a certain period
        $this->db->select('id, title, url, class, start, end');
        $this->db->from('event');
        $query = $this->db->get();
        return $query->result();
    }

    public function addEvent($title, $url, $kind, $start, $end) {
        $data = array(
            'title'=>$title,
            'url'=>$url,
            'class'=>$kind,
            'start'=>$start,
            'end'=>$end,
        );
        return $this->db->insert('event', $data);
    }
}
