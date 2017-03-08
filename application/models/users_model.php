<?php

class users_model extends CI_Model {

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
}