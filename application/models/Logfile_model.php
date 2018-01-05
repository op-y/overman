<?php

/**
 *  A Model class: operate file table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Logfile_model extends CI_Model
{

    /**
     *  Load database: file
     */
    public function __construct()
    {
        $this->load->database('file');
    }

    /**
     * SQL:
     *    SELECT COUNT(*)
     *    FROM file
     *    WHERE shopid LIKE '%($searchValue)%'
     *    OR deviceid LIKE '%($searchValue)%'
     *    OR applicationname LIKE '%($searchValue)%'
     *    OR timestamp LIKE '%($searchValue)%'
     *    OR filename LIKE '%($searchValue)%'
     *
     * @return integer
     */
    public function getLogfilesTotal($searchValue='')
    {
        $this->db->select('id, shopid, deviceid, applicationname, timestamp, filename, storage, fileinfo');
        $this->db->from('file');

        $conditions = explode(",", $searchValue);
        if (count($conditions) == 2) {
            $this->db->like('shopid', $conditions[0]);
            $this->db->like('timestamp', $conditions[1]);
            return $this->db->count_all_results();
        }
        
        if ($searchValue != '') {
            $this->db->like('shopid', $searchValue);
            $this->db->or_like('deviceid', $searchValue);
            $this->db->or_like('applicationname', $searchValue);
            $this->db->or_like('timestamp', $searchValue);
            $this->db->or_like('filename', $searchValue);
            return $this->db->count_all_results();
        }

        return $this->db->count_all_results();
    }

    /**
     * SQL:
     *    SELECT id, shopid, deviceid, applicationname,
     *    timestamp, filename, storage, fileinfo
     *    FROM file
     *    WHERE shopid LIKE '%($searchValue)%'
     *    OR deviceid LIKE '%($searchValue)%'
     *    OR applicationname LIKE '%($searchValue)%'
     *    OR timestamp LIKE '%($searchValue)%'
     *    OR filename LIKE '%($searchValue)%'
     *    ORDER BY id DESC
     *    LIMIT $limit OFFSET $start
     *
     * @return object array
     */
    public function getLogfiles($start, $limit, $searchValue='')
    {
        $this->db->select('id, shopid, deviceid, applicationname, timestamp, filename, storage, fileinfo');
        $this->db->from('file');

        $conditions = explode(",", $searchValue);
        if (count($conditions) == 2) {
            $this->db->like('shopid', $conditions[0]);
            $this->db->like('timestamp', $conditions[1]);

            $this->db->order_by('id', 'DESC');
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result();
        }
        
        if ($searchValue != '') {
            $this->db->like('shopid', $searchValue);
            $this->db->or_like('deviceid', $searchValue);
            $this->db->or_like('applicationname', $searchValue);
            $this->db->or_like('timestamp', $searchValue);
            $this->db->or_like('filename', $searchValue);

            $this->db->order_by('id', 'DESC');
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result();
        }

        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
}

