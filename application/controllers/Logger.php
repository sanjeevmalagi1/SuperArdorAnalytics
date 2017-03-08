<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logger extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('logs_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
        public function Addlog()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $key = $_POST['key'];
                $url = $_POST['url'];
                echo json_encode($this->logs_model->Addlog($key,$url));
            }
            
	}
        
	public function GetLogs()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $key = $_POST['key'];
                $ip = $_POST['IP'];
                $URL = $_POST['URL'];
                $Country = $_POST['Country'];
                echo json_encode($this->logs_model->GetAllLogs($key,$ip,$URL,$Country));   
            }
	}
        
        public function TurnOffControl($ID)
	{
            echo json_encode($this->controls_model->TurnOffControl($ID));
	}
        
        public function EditControl()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $ID = $_POST['ID'];
                $name = $_POST['Name'];
                $type = $_POST['Type'];
                echo json_encode($this->controls_model->EditControl($ID,$name,$type));
            }
	}
        
        public function RemoveControl()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $ID = $_POST['ID'];
                echo json_encode($this->controls_model->RemoveControl($ID));
            }
	}
}
