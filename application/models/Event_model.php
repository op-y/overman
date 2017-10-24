<?php

/**
 *  A Model class: operate event table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Event_model extends CI_Model
{

    /**
     * Load database: default
     */
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * SQL:
     *    SELECT id, title, url, class, start, end
     *    FROM event
     *
     * @return array
     */
    public function getEvents()
    {
        $this->db->select('id, title, url, class, start, end');
        $this->db->from('event');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO event(title, url, class, start, end)
     *    VALUES($title, $url, $kind, $start, $end)
     *
     * @return integer
     */
    public function addEvent($title, $url, $kind, $start, $end)
    {
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

