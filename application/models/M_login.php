<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {
    
    public function usercheck($user, $password)
	{
        $this->db->where('nik', $user);
        $this->db->where('password', md5($password));
        $result = $this->db->get('user', 1);
        return $result;
        
    }
}
