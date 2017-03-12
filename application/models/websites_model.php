<?php

class websites_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function AddWebsite($OwnerID,$Name) {
            $APIKey = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999).$OwnerID)), 0, 30), 6));
            $WebsiteInfo = array(
                'OwnerID' => $OwnerID,
                'APIKey' => $APIKey,
                'Name' => $Name
                );
            
            $this->db->insert('websites', $WebsiteInfo);
            return $APIKey;
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