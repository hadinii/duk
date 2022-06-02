<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
    }
    
    public function index()
	{
        $this->load->view('auth/login');
    }
    
    public function auth(){
        $user =  $this->input->post('username', true);
        $password = $this->input->post('pass', true);
        $valid = $this->M_login->usercheck($user, $password);
        if($valid->num_rows()>0){
			$data = $valid->row_array();
			// var_dump($data['is_admin']);
			// die();
			$sesdata = [
				'id' => $data['id'],
				'username' => $data['nik'],
				'is_admin' => $data['is_admin'],
			];
			$this->session->set_userdata($sesdata);
			
            if($data['is_admin']){
                redirect('dashboard');
			}else{
                redirect('user');
            }
        }else{
            echo $this->session->set_flashdata('notification','Username or Password is Wrong');
            redirect('login');
        }
        
    }
    public function logout(){
        $this->session->unset_userdata('username');
		$this->session->unset_userdata('account');
		session_destroy();
		redirect('login');
    }
}
