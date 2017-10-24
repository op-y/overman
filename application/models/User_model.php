<?php

/**
 *  A Model class: operate user table.
 *
 *  @author ye.zhiqin@outlook.com
 */
class User_model extends CI_Model
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
     *    SELECT COUNT(*)
     *    FROM user
     *    WHERE username=$username
     *    AND password=$ciphertext
     *
     * @return integer
     */
    public function identify($username, $ciphertext)
    {
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $ciphertext);
        return $this->db->count_all_results();
    }

    /**
     * SQL:
     *    SELECT id, username, tel, email, status
     *    FROM user
     *
     * @return object array
     */
    public function getUsers()
    {
        $this->db->select('id, username, tel, email, status');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT id, username, tel, email, status
     *    FROM user
     *    WHERE username=$username
     *
     * @return object
     */
    public function getUserByName($username)
    {
        $this->db->select('id, username, tel, email');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * SQL:
     *    SELECT id, username
     *    FROM user
     *
     * @return object array
     */
    public function getUserOpts()
    {
        $this->db->select('id, username');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT id, name
     *    FROM service
     *
     * @return object array
     */
    public function getServiceOpts()
    {
        $this->db->select('id, name');
        $this->db->from('service');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT id, rolename
     *    FROM role
     *
     * @return object array
     */
    public function getRoleOpts() {
        $this->db->select('id, rolename');
        $this->db->from('role');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    INSERT INTO user(username, tel, email, status, avater, password)
     *    VALUES($username, $tel, $email, $status, $avater, $password)
     *
     * @return integer
     */
    public function addUser($username, $tel, $email, $status, $avatar, $password)
    {
        $data = array(
            'username'=>$username,
            'tel'=>$tel,
            'email'=>$email,
            'status'=>$status,
            'avatar'=>$avatar,
            'password'=>$password,
        );
        return $this->db->insert('user', $data);
    }

    /**
     * SQL:
     *    SELECT user.id AS userId
     *    FROM user
     *    WHERE user.username=$username
     *
     * @return object
     */
    public function getUserId($username)
    {
        $this->db->select('user.id as userId');
        $this->db->from('user');
        $this->db->where('user.username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * SQL:
     *    INSERT INTO user...
     *
     * @return integer
     */
    public function addAuth($data)
    {
        return $this->db->insert_batch('user_service_role', $data);
    }

    /**
     * SQL:
     *    SELECT user_service_role.service_id as serviceId
     *    FROM user
     *    JOIN user_service_role ON user.id=user_service_role.user_id
     *    WHERE user.username=$username
     *
     * @return object array
     */
    public function getAuthorizedServiceId($username)
    {
        $this->db->select('user_service_role.service_id as serviceId');
        $this->db->from('user');
        $this->db->join('user_service_role','user.id=user_service_role.user_id');
        $this->db->where('user.username', $username);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    SELECT user_service_role.service_id as serviceId,
     *    role_privilege.privilege_id as privilegeId
     *    FROM user
     *    JOIN user_service_role ON user.id=user_service_role.user_id
     *    JOIN role_privilege ON user_service_role.role_id=role_privilege.role_id
     *    WHERE user.username=$username
     *    AND user_service_role.service_id IN ($ids)
     *
     * @return object array
     */
    public function getAuthority4Service($username, $ids)
    {
        $this->db->select('user_service_role.service_id as serviceId, role_privilege.privilege_id as privilegeId');
        $this->db->from('user');
        $this->db->join('user_service_role','user.id=user_service_role.user_id');
        $this->db->join('role_privilege','user_service_role.role_id=role_privilege.role_id');
        $this->db->where('user.username', $username);
        $this->db->where_in('user_service_role.service_id', $ids);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * SQL:
     *    UPDATE user
     *    SET tel=$tel, email=$email
     *    WHERE username=$username
     *
     * @return integer
     */
    public function updateProfile($username, $tel, $email)
    {
        $this->db->set('tel', $tel);
        $this->db->set('email', $email);
        $this->db->where('username', $username);
        $this->db->update('user');
        return $this->db->affected_rows();
    }

    /**
     * SQL:
     *    UPDATE user
     *    SET password=$newPassword
     *    WHERE username=$username
     *    AND password=$oldPassword
     *
     * @return integer
     */
    public function updatePassword($username, $oldPassword, $newPassword) {
        $this->db->set('password', $newPassword);
        $this->db->where('username', $username);
        $this->db->where('password', $oldPassword);
        $this->db->update('user');
        return $this->db->affected_rows();
    }

    /**
     * SQL:
     *    SELECT service.name as serviceName, role.rolename as roleName
     *    FROM user
     *    JOIN user_service_role ON user.id=user_service_role.user_id
     *    JOIN role ON user_service_role.role_id=role.id
     *    JOIN service ON user_service_role.service_id=service.id
     *    WHERE user.username=$username
     *
     * @return object array
     */
    public function getMineAuth($username)
    {
        $this->db->select('service.name as serviceName, role.rolename as roleName');
        $this->db->from('user');
        $this->db->join('user_service_role','user.id=user_service_role.user_id');
        $this->db->join('role','user_service_role.role_id=role.id');
        $this->db->join('service','user_service_role.service_id=service.id');
        $this->db->where('user.username', $username);
        $query = $this->db->get();
        return $query->result();
    }
}

