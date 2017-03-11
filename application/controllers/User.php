<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
        public function __construct()
        {
                parent::__construct();
                $this->load->model('users_model');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
                header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        }
	
        public function AddUser()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['Email'];
                $password = $_POST['Password'];
                echo json_encode($this->users_model->AddUser($email,$password));
            }
            
	}
        
	public function LogIn()
	{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['Email'];
                $password = $_POST['Password'];
                echo json_encode($this->users_model->LogIn($email,$password));   
            }
	}
}
