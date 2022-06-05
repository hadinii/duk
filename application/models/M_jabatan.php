<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jabatan extends CI_Model {

	public function index()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function show($id){
		$result = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
		$this->db->select('*')
			->from('gaji g')
			->where('g.jabatan_id', $id);
		$result['gaji'] = $this->db->get()->result_array();
		return $result;
    }

	public function store()
	{
		$data=[
            'nama' => $this->input->post('jabatan',true),
            'keterangan' => $this->input->post('keterangan',true),
            'gaji_default' => $this->input->post('gaji_default',true),
            'is_increment' => $this->input->post('is_increment',true) == "on",
        ];
        $this->db->insert('jabatan', $data);

		$id = $this->db->insert_id();
		return $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
	}
	
	public function update($id)
	{
		$data=[
			'nama' => $this->input->post('jabatan',true),
			'keterangan' => $this->input->post('keterangan',true),
			'gaji_default' => $this->input->post('gaji_default',true),
			'is_increment' => $this->input->post('is_increment',true) == "on",
		];
		$this->db->where('id_jabatan', $id);
		$this->db->update('jabatan', $data);

		if(!$data['is_increment']){
			// delete all gaji where jabatan_id = $id
		}
	}

	public function delete($id)
	{
		$jabatan = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
		$pegawai = $this->db->get_where('pegawai', ['jabatan_id' => $id])->result_array();
		$gaji = $this->db->get_where('gaji', ['jabatan_id' => $id])->result_array();
		if(!count($pegawai) || !count($gaji)){
			$this->db->where('id_jabatan', $id)->delete('jabatan');
			return true;
		}
		return false;
	}
}
