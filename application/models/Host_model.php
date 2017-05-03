<?php

/**
 *  model class about host table
 *  @author yezhiqin@outlook.com
 */
class Host_model extends CI_Model {

    /**
     *  The class constructor
     */
    public function __construct() {
        $this->load->database();
    }

    public function getHosts() {
        $this->db->select('host.id as id, host.hostname as hostname, host.ip as ip, host.idc as idc, host.cpu as cpu, host.memory as memory, host.disk as disk, host.ssd as ssd, host.raid as raid, host.nic as nic, idc.name as idcName');
        $this->db->from('host');
        $this->db->join('idc', 'host.idc=idc.id');
        $this->db->order_by('host.hostname', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function addHost($hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic) {
        $data = array(
            'hostname'=>$hostname,
            'ip'=>$ip,
            'idc'=>$idc,
            'cpu'=>$cpu,
            'memory'=>$memory,
            'disk'=>$disk,
            'ssd'=>$ssd,
            'raid'=>$raid,
            'nic'=>$nic,
        );
        return $this->db->insert('host', $data);
    }

    public function addHosts($data) {
        try {
            return $this->db->insert_batch('host', $data);
        } catch(Exception $e) {
            return $e;
        }
    }

    public function updateHost($id, $hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic) {
        $data = array(
            'hostname'=>$hostname,
            'ip'=>$ip,
            'idc'=>$idc,
            'cpu'=>$cpu,
            'memory'=>$memory,
            'disk'=>$disk,
            'ssd'=>$ssd,
            'raid'=>$raid,
            'nic'=>$nic,
        );
        $this->db->where('id', $id);
        return $this->db->update('host', $data);
    }

    public function deleteHost($id) {
        $this->db->where('id', $id);
        return $this->db->delete('host');
    }
}
