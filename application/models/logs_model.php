<?php

class logs_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
         public function Addlog($key,$url) {
            $logInfo = array(
                'APIKey' => $key,
                'URL' => $url
                );
            if($this->db->insert('logs', $logInfo)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function GetAllLogs($key,$ip,$URL,$Country) {
            $condition = array(
                'APIKey' => $key
             );
            if($ip){
                $condition['IP'] = $ip;
            }
            if($URL){
                $condition['URL'] = $URL;
            }
            if($Country){
                $condition['Country'] = $Country;
            }
            $this->db->where($condition);
            $query = $this->db->get('logs');
            return $query->result_array();
        }
        
        public function GetLogsOfURL($key,$url) {
            $condition = array(
                'APIKey' => $key,
                'URL' => $url
                );
            $this->db->where($condition);
            $query = $this->db->get('logs');
            return $query->result_array();
        }
        
        public function GetStatusOfControl($ID) {
            $this->db->where('ID', $ID);
            $query = $this->db->get('controls');
            return $query->row_array();
        }
        
        public function TurnOnControl($ID) {
            $UpdateControl = array(
                'Value' => 1
            );
            
            $condition = array(
                'ID' => $ID
            );
            $this->db->where($condition);
            if($this->db->update('controls', $UpdateControl)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function TurnOffControl($ID) {
            $UpdateControl = array(
                'Value' => NULL
            );
            
            $condition = array(
                'ID' => $ID
            );
            $this->db->where($condition);
            if($this->db->update('controls', $UpdateControl)){
                return TRUE;
            }
            return FALSE;
        }
        
       
        
        public function EditControl($ID,$name) {
            $UpdateControl = array(
                'Name' => $name
            );
            
            $condition = array(
                'ID' => $ID
            );
            $this->db->where($condition);
            if($this->db->update('controls', $UpdateControl)){
                return TRUE;
            }
            return FALSE;
        }
        
        public function RemoveControl($ID) {
            $condition = array(
                'ID' => $ID
            );
            $this->db->where($condition);
            if($this->db->delete('controls')){
                return TRUE;
            }
            return FALSE;
        }
}