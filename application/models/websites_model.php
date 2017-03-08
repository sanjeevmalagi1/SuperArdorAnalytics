<?php

class users_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function AddWebsite($APIKey,$OwnerID) {
            $WebsiteInfo = array(
                'APIKey' => $APIKey,
                'OwnerID' => $OwnerID
                );
            if($this->db->insert('websites', $WebsiteInfo)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function GetWebsitesOfUser($OwnerID) {
            $condition = array(
                'OwnerID' => $OwnerID
                );
            $this->db->where($condition);
            $query = $this->db->get('websites');
            return $query->result_array();
        }
}