<?php

/**
 *  A Model class: operate idc table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Idc_model extends CI_Model
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
     *    SELECT id, name, code, address, administrator, tel
     *    FROM idc
     *    ORDER BY name ASC
     *
     * @return object array
     */
    public function getIdcs()
    {
        $this->db->select('id, name, code, address, administrator, tel');
        $this->db->from('idc');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO idc(name, code, address, administrator, tel)
     *    VALUES($name, $code, $address, $administrator, $tel)
     *
     * @return integer
     */
    public function addIdc($name, $code, $address, $administrator, $tel)
    {
        $data = array(
            'name'=>$name,
            'code'=>$code,
            'address'=>$address,
            'administrator'=>$administrator,
            'tel'=>$tel,
        );
        return $this->db->insert('idc', $data);
    }

    /**
     * SQL:
     *    INSERT INTO idc(name, code, address, administrator, tel)
     *    VALUES(...)
     *
     * @return integer
     */
    public function addIdcs($data)
    {
        try {
            return $this->db->insert_batch('idc', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * SQL:
     *    UPDATE idc
     *    SET name=$name, code=$code, address=$address, administrator=$administrator, tel=$tel
     *    WHERE id=$id
     *
     * @return integer
     */
    public function updateIdc($id, $name, $code, $address, $administrator, $tel) {
        $data = array(
            'name' => $name,
            'code' => $code,
            'address' => $address,
            'administrator' => $administrator,
            'tel' => $tel,
        );
        $this->db->where('id', $id);
        return $this->db->update('idc', $data);
    }

    /**
     * SQL:
     *    DELETE FROM idc
     *    WHERE id=$id
     *
     * @return integer
     */
    public function deleteIdc($id) {
        $this->db->where('id', $id);
        return $this->db->delete('idc');
    }
}

