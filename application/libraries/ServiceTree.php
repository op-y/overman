<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom library class
 *
 * This class help to process service tree.
 *
 * @author ye.zhiqin@outlook.com
 */
class ServiceTree
{
    /**
     * @member ids
     * @member services
     * @member ownedTree
     */
    public function __construct($params)
    {
        $this->ids = $params['ids'];
        $this->services = $params['services'];
        $this->ownedTree = array();
    }

    /**
     * Get service tree.
     *
     * @return array
     */
    public function getOwnedTree()
    {
        foreach ($this->ids as $id) {
            $this->getAncestry($id->serviceId);
            $this->getDescendant($id->serviceId);
        }
        return $this->ownedTree;
    }

    /**
     * Get descendant tree recursively.
     *
     * @return array
     */
    public function getSubTree()
    {
        foreach ($this->ids as $id) {
            $this->getDescendant($id->serviceId);
        }
        return $this->ownedTree;
    }

    /**
     * Get ancestry tree nodes.
     */
    public function getAncestry($id)
    {
        if (0 == $id) {
            return;
        }

        foreach ($this->services as $service) {
            if ($id == $service->id) {
                $this->addService($service);
                $this->getAncestry($service->pId);
            }
        }
    }

    /**
     * Get descendant tree nodes.
     */
    public function getDescendant($id)
    {
        foreach ($this->services as $service) {
            if ($id == $service->pId) {
                $this->addService($service);
                $this->getDescendant($service->id);
            }
        }
    }

    /**
     * Add tree node to class member ownedTree(array)
     */
    public function addService($service)
    {
        foreach ($this->ownedTree as $record) {
            if ($service->id == $record->id
                && $service->pId == $record->pId
                && $service->name == $record->name) {
                return;
            }
        }
        array_push($this->ownedTree, $service);
    }
}

