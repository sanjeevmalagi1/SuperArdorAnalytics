<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Queries extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('controls_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }

	
	public function GetAllControls()
	{
            echo json_encode($this->controls_model->GetControls());
	}
        
        public function GetStatusOfControl($ID)
        {
            echo json_encode($this->controls_model->GetStatusOfControl($ID));
        }
}

