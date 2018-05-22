<?php

/**
 *  A Model class: operate service table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Service_model extends CI_Model
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
     *    SELECT service.id as id, service.pid as pId, service.name as name
     *    FROM service
     *    ORDER BY service.name ASC
     *
     * @return object array
     */
    public function getTreeServices()
    {
        $this->db->select('service.id as id, service.pid as pId, service.name as name');
        $this->db->from('service');
        $this->db->order_by('service.name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT service.id as id, service.pid as pId, service.name as name
     *    FROM service
     *    WHERE service.pid=$pid
     *    ORDER BY service.name ASC
     *
     * @return object array
     */
    public function getTreeNode($pid)
    {
        $this->db->select('service.id as id, service.pid as pId, service.name as name');
        $this->db->from('service');
        $this->db->where('service.pid', $pid);
        $this->db->order_by('service.name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT service.id as id, service.name as name, service.kind as kind
     *    FROM service
     *    WHERE service.pid=$id
     *    ORDER BY service.id ASC
     *
     * @return object array
     */
    public function getSubServices($id)
    {
        $this->db->select('service.id as id, service.name as name, service.kind as kind');
        $this->db->from('service');
        $this->db->where('service.pid', $id);
        $this->db->order_by('service.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO service(pid, name, kind)
     *    VALUES($pid, $name, $kind)
     *
     * @return integer
     */
    public function addService($pid, $name, $kind)
    {
        $data = array(
            'pid'=>$pid,
            'name'=>$name,
            'kind'=>$kind,
        );
        return $this->db->insert('service', $data);
    }

    /**
     * SQL:
     *    UPDATE service
     *    SET name=$name
     *    WHERE id=$id
     *
     * @return integer
     */
    public function updateService($id, $name)
    {
        $this->db->set('name', $name);
        $this->db->where('id', $id);
        return $this->db->update('service');
    }

    /**
     * SQL:
     *    DELETE FROM service
     *    WHERE id=$id
     *
     * @return integer
     */
    public function deleteService($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('service');
    }

    /**
     * SQL:
     *    SELECT ...
     *    FROM service_deployment
     *    WHERE service_deployment.service_id=$id
     *
     * @return object
     */
    public function getDeploymentByService($id)
    {
        $this->db->select('service_deployment.id as id, service_deployment.service_id as serviceId, service_deployment.namespace as namespace, service_deployment.idc as idc, service_deployment.gray_enabled as grayEnabled, service_deployment.jenkins_job_name as jenkinsJobName, service_deployment.jenkins_repo_url as jenkinsRepoURL, service_deployment.jenkins_repo_branch as jenkinsRepoBranch, service_deployment.jenkins_maven_param as jenkinsMavenParam, service_deployment.jenkins_jar_path as jenkinsJarPath, service_deployment.jenkins_run_param as jenkinsRunParam, service_deployment.image_repo_url as imageRepoURL, service_deployment.k8s_service_name as k8sServiceName, service_deployment.k8s_service_port as k8sServicePort, service_deployment.status as status');
        $this->db->from('service_deployment');
        $this->db->where('service_deployment.service_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * SQL:
     *    INSERT INTO service_deployment(...) VALUES(...)
     *
     *    UPDATE service_deployment SET...
     *
     * @return integer
     */
    public function configDeployment(
        $id, 
        $serviceId, 
        $namespace, 
        $idc, 
        $gray, 
        $jenkinsJobName, 
        $jenkinsRepoURL, 
        $jenkinsRepoBranch, 
        $jenkinsMavenParam, 
        $jenkinsJarPath, 
        $jenkinsRunParam, 
        $imageRepoURL, 
        $k8sServiceName,
        $k8sServicePort, 
        $status)
    {
        $data = array(
            'id'=>$id,
            'service_id'=>$serviceId,
            'namespace'=>$namespace,
            'idc'=>$idc,
            'gray_enabled'=>$gray,
            'jenkins_job_name'=>$jenkinsJobName,
            'jenkins_repo_url'=>$jenkinsRepoURL,
            'jenkins_repo_branch'=>$jenkinsRepoBranch,
            'jenkins_maven_param'=>$jenkinsMavenParam,
            'jenkins_jar_path'=>$jenkinsJarPath,
            'jenkins_run_param'=>$jenkinsRunParam,
            'image_repo_url'=>$imageRepoURL,
            'k8s_service_name'=>$k8sServiceName,
            'k8s_service_port'=>$k8sServicePort,
            'status'=>$status,
        );
        return $this->db->replace('service_deployment', $data);
    }

    /**
     * SQL:
     *    SELECT ...
     *    FROM service_deployment_log
     *    JOIN user ON service_deployment_log.user_id=user.id
     *    WHERE service_deployment_log.service_id=$serviceId
     *    ORDER BY service_deployment_log.id DESC
     *
     * @return object array
     */
    public function getHistoryByService($serviceId)
    {
        $this->db->select('service_deployment_log.id as id, service_deployment_log.timestamp as timestamp, service_deployment_log.user_id as userId, service_deployment_log.service_id as serviceId, service_deployment_log.version as version, service_deployment_log.duration as duration, service_deployment_log.status as status, user.username as username');
        $this->db->from('service_deployment_log');
        $this->db->join('user', 'service_deployment_log.user_id=user.id');
        $this->db->where('service_deployment_log.service_id', $serviceId);
        $this->db->order_by('service_deployment_log.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO service_deployment_log(...)
     *    VALUES(...)
     *
     * @return integer
     */
    public function addDeployLog($timestamp, $userId, $serviceId, $imageTag, $duration, $status)
    {
        $data = array(
            'timestamp'=>$timestamp,
            'user_id'=>$userId,
            'service_id'=>$serviceId,
            'version'=>$imageTag,
            'duration'=>$duration,
            'status'=>$status,
        );
        return $this->db->insert('service_deployment_log', $data);
    }
}

