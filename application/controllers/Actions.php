<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('controls_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
	public function TurnOnControl($ID)
	{
            echo json_encode($this->controls_model->TurnOnControl($ID));
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
        
        public function AddControl()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name = $_POST['Name'];
                echo json_encode($this->controls_model->AddControl($name));
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
