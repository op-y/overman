<?php

/**
 *  A Model class: operate tbl_data_shop_info, tbl_mis_shop_ownership tables.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Ab_model extends CI_Model
{

    /**
     *  Load database: mis
     */
    public function __construct()
    {
        $this->load->database('mis');
    }

    /**
     * SQL:
     *    SELECT groupID, groupName FROM tbl_data_shop_info WHERE groupID IN ($groupIDs)
     *
     * @return object array
     */
    public function getGroups($groupIDs)
    {
        $this->db->select('groupID, groupName');
        $this->db->distinct();
        $this->db->from('tbl_data_shop_info');
        $this->db->where_in('groupID', $groupIDs);
        $this->db->order_by('groupID', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT t1.groupID, t1.groupName, t2.ownerOrgID, t2.ownerOrgName,
     *    t2.supportOperativeEmpID, t2.supportOperativeEmpName, t2.supportSalesEmpID,
     *    t2.supportSalesEmpName, t2.supportServiceEmpID, t2.supportServiceEmpName
     *    FROM tbl_data_shop_info t1 LEFT JOIN tbl_mis_shop_ownership t2
     *    ON t1.groupID=t2.groupID
     *    WHERE t1.groupID=$groupID
     *    GROUP BY t2.groupID
     *
     * @return object
     */
    public function getGroup($groupID)
    {
        $this->db->select('t1.groupID, t1.groupName, t2.ownerOrgID, t2.ownerOrgName, t2.supportOperativeEmpID, t2.supportOperativeEmpName, t2.supportSalesEmpID, t2.supportSalesEmpName, t2.supportServiceEmpID, t2.supportServiceEmpName');
        $this->db->from('tbl_data_shop_info t1');
        $this->db->join('tbl_mis_shop_ownership t2', 't1.groupID=t2.groupID', 'left');
        $this->db->where('t1.groupID', $groupID);
        $this->db->group_by('t2.groupID');
        $query = $this->db->get();
        return $query->row();
    }
}

