<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jabatan extends CI_Model {
	public function getAll()
	{
		return $this->db->get('jabatan')->result_array();
	}
}
