<?php

class Users_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function AddUser($email,$password) {
            $UserInfo = array(
                'Email' => $email,
                'Password' => md5($password)
                );
            if($this->db->insert('users', $UserInfo)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function LogIn($email,$password) {
            $condition = array(
                'Email' => $email,
                'Password' => md5($password)
                );
            $this->db->where($condition);
            $query = $this->db->get('users');
            return $query->row_array();
        }
        
        public function ChangeEmail($id,$oldEmail,$newEmail) {
            $condition = array(
                'ID' => $id,
                'Email' => $oldEmail
                );
            $this->db->where($condition);
            $this->db->set('Email', $newEmail);
            return $this->db->update('users');
        }
        
        public function ChangePassword($id,$Email,$oldPassword,$newPassword) {
            $condition = array(
                'ID' => $id,
                'Email' => $Email,
                'Password' => md5($oldPassword)
                );
            $this->db->where($condition);
            $this->db->set('Password', md5($newPassword));
            return $this->db->update('users');
        }
}