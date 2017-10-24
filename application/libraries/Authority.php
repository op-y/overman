<?php if(!defined('BASEPATH')) exit('No direct script asscess allowed'); 

/**
 * Custom library class
 *
 * This class help to checking authority.
 *
 * @author ye.zhiqin@outlook.com
 */
class Authority
{ 
    /**
     * @member username
     * @member serviceId
     * @member privilegeId
     * @member ids
     *
     * Get CI object: ci
     *
     * Load model: user
     * Load model: service
     */
    public function  __construct($params)
    {
        $this->username    = $params['username'];
        $this->serviceId   = $params['serviceId'];
        $this->privilegeId = $params['privilegeId'];

        $this->ids = array();

        $this->ci = & get_instance(); 
        $this->ci->load->model('user_model', 'user');
        $this->ci->load->model('service_model', 'service');
    } 

    /**
     * Checking authority.
     *
     * @return true/false
     */
    public function hasAuthority()
    {
        $services = $this->ci->service->getTreeServices();
        $this->getIds($services, $this->serviceId);
        $privileges = $this->ci->user->getAuthority4Service($this->username, $this->ids);

        foreach ($privileges as $privilege) {
            if ($privilege->privilegeId == $this->privilegeId) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get service ids.
     *
     * @param services
     * @param id
     */
    public function getIds($services, $id)
    {
        if (0 == $id) {
            return;
        }

        foreach ($services as $service) {
            if ($id == $service->id) {
                $this->addId($id);
                $this->getIds($services, $service->pId);
            }
        }
    }

    /**
     * Add id to class memeber ids(array), excluding duplicated ids.
     *
     * @param newId
     */
    public function addId($newId)
    {
        foreach ($this->ids as $id) {
            if ($id == $newId) {
                return;
            }
        }
        array_push($this->ids, $newId);
    }
}

