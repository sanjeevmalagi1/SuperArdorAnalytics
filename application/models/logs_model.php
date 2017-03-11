<?php

class logs_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }
        
        public function Addlog($key,$url,$ip,$lat,$lng,$country,$address) {
            $logInfo = array(
                'APIKey' => $key,
                'URL' => $url,
                'IP' => $ip,
                'Lat' => $lat,
                'Lng' => $lng,
                'Country' => $country,
                'Address' => $address
                );
            
            $this->db->insert('logs', $logInfo);
            $insert_id = $this->db->insert_id();

            return  $insert_id;
        }
        
        public function LogTenSeconds($id) {
            
            $this->db->set('Time', '10');
            $this->db->where('ID', $id);
            return $this->db->update('logs');
            
        }
        
        public function LogThirtySeconds($id) {
            
            $this->db->set('Time', '30');
            $this->db->where('ID', $id);
            return $this->db->update('logs');
        }
        
        public function LogThreeMins($id) {
            
            $this->db->set('Time', '180');
            $this->db->where('ID', $id);
            return $this->db->update('logs');
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