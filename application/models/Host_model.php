<?php

/**
 *  A Model class: operate host, idc tables.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Host_model extends CI_Model
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
     *    SELECT
     *    host.id as id, host.hostname as hostname, host.ip as ip,
     *    host.idc as idc, host.cpu as cpu, host.memory as memory,
     *    host.disk as disk, host.ssd as ssd, host.raid as raid,
     *    host.nic as nic, host.os as os, host.kernel as kernel,
     *    host.rack as rack, idc.name as idcName
     *    FROM host
     *    JOIN idc ON host.idc=idc.id
     *    ORDER BY host.hostname ASC
     *
     * @return object array
     */
    public function getHosts()
    {
        $this->db->select('host.id as id, host.hostname as hostname, host.ip as ip, host.idc as idc, host.cpu as cpu, host.memory as memory, host.disk as disk, host.ssd as ssd, host.raid as raid, host.nic as nic, host.os as os, host.kernel as kernel, host.rack as rack, idc.name as idcName');
        $this->db->from('host');
        $this->db->join('idc', 'host.idc=idc.id');
        $this->db->order_by('host.hostname', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO
     *    host(hostname, ip, idc, cpu, memory, disk, ssd, raid, nic,
     *    os, kernel, rack) VALUES($hostname, $ip, $idc, $cpu,
     *    $memory, $disk, $ssd, $raid, $nic, $os, $kernel, $rack)
     *
     * @return integer
     */
    public function addHost($hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic, $os, $kernel, $rack)
    {
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
            'os'=>$os,
            'kernel'=>$kernel,
            'rack'=>$rack,
        );
        return $this->db->insert('host', $data);
    }

    /**
     * SQL:
     *    INSERT INTO
     *    host(hostname, ip, idc, cpu, memory, disk, ssd, raid, nic,
     *    os, kernel, rack) VALUES(...)
     *
     * @return integer
     */
    public function addHosts($data)
    {
        try {
            return $this->db->insert_batch('host', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * SQL:
     *    UPDATE host
     *    SET hostname=$hostname, ip=$ip, idc=$idc,
     *    cpu=$cpu, memory=$memory, disk=$disk,
     *    ssd=$ssd, raid=$raid, nic=$nic,
     *    os=$os, kernel=$kernel, rack=$rack
     *    WHERE id=$id
     *
     * @return integer
     */
    public function updateHost($id, $hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic, $os, $kernel, $rack)
    {
        $data = array(
            'hostname'=>$hostname,
            'ip'=>$ip,
            'idc'=>$idc,
            'cpu'=>$cpu,
            'memory'=>$cpu,
            'disk'=>$disk,
            'ssd'=>$ssd,
            'raid'=>$raid,
            'nic'=>$nic,
            'os'=>$os,
            'kernel'=>$kernel,
            'rack'=>$rack,
        );
        $this->db->where('id', $id);
        return $this->db->update('host', $data);
    }

    /**
     * SQL:
     *    DELETE FROM host
     *    WHERE id=$id
     *
     * @return integer
     */
    public function deleteHost($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('host');
    }
}

