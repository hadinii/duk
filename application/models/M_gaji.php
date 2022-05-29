<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Gaji extends CI_Model {
    public function tambahDataGaji(){
        $data=[
            'nama' => $this->input->post('nama',true),
            'keterangan' => $this->input->post('keterangan',true),
            'gaji_default' => $this->input->post('gaji_default',true),
            'is_increment' => $this->input->post('is_increment',true) == "on",
        ];
        $this->db->insert('jabatan', $data);
		$insert_id = $this->db->insert_id();
		
		$condition = $this->input->post('condition',true);
		$masa_kerja = $this->input->post('masa_kerja',true);
		$gaji_pokok = $this->input->post('gaji_pokok',true);
		foreach($condition as $i => $row) {
			$data = [
				'jabatan_id' => $insert_id,
				'condition' => $row,
				'masa_kerja' => $masa_kerja[$i],
				'gaji_pokok' => $gaji_pokok[$i]
			];
			$this->db->insert('gaji', $data);
		}
    }

    public function getAllDataGaji(){
        $result = $this->db->get('jabatan')->result_array();
		foreach ($result as $i => $row) {
			$this->db->select('*')
				->from('gaji g')
				->join('jabatan j', 'g.jabatan_id = j.id_jabatan', 'LEFT')
				->where('g.jabatan_id', $row['id_jabatan']);
			$result[$i]['gaji'] = $this->db->get()->result_array();
		}
		return $result;
    }
    
    public function getDataGajiById($id){
        return $this->db->get_where('gaji', ['id_gaji'=>$id])->row_array();
    }

    public function updateDataGaji(){
        $data=[
            'golongan' => $this->input->post('gol',true),
            'masa_kerja' => $this->input->post('masa_kerja',true),
            'gaji_pokok' => $this->input->post('gaji_pokok',true)
        ];
        $this->db->where('id_gaji', $this->input->post('id'), true);
        $this->db->update('gaji',$data);
    }

    public function hapusGajiPegawai($id){
        $this->db->where('id_gaji', $id);
        $this->db->delete('gaji');
    }
}
