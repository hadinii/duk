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
				->where('g.jabatan_id', $row['id_jabatan']);
			$result[$i]['gaji'] = $this->db->get()->result_array();
		}
		return $result;
    }
    
    public function getDataGajiById($id){
		$result = $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
		$this->db->select('*')
			->from('gaji g')
			->where('g.jabatan_id', $id);
		$result['gaji'] = $this->db->get()->result_array();
		return $result;
    }

    public function updateDataGaji(){
        $data=[
            'nama' => $this->input->post('nama',true),
            'keterangan' => $this->input->post('keterangan',true),
            'gaji_default' => $this->input->post('gaji_default',true),
            'is_increment' => $this->input->post('is_increment',true) == "on",
        ];
        $this->db->where('id_jabatan', $this->input->post('id_jabatan' ,true));
        $this->db->update('jabatan',$data);

		$id_gaji = $this->input->post('id_gaji',true);
		$condition = $this->input->post('condition',true);
		$masa_kerja = $this->input->post('masa_kerja',true);
		$gaji_pokok = $this->input->post('gaji_pokok',true);
		foreach($id_gaji as $i => $row) {
			$data = [
				'jabatan_id' => $this->input->post('id_jabatan'),
				'condition' => $condition[$i],
				'masa_kerja' => $masa_kerja[$i],
				'gaji_pokok' => $gaji_pokok[$i]
			];
			$this->db->where('id_gaji', $row);
			$this->db->update('gaji',$data);
		}
		// TO DO: Delete unupdated gaji, create new gaji
		// if gaji deleted, update pegawai where gaji_id = deleted_id
    }

    public function hapusGajiPegawai($id){
        $this->db->where('id_gaji', $id);
        $this->db->delete('gaji');
    }

	public function getNaikGaji()
	{
		$result = $this->db->select("p.*, u.nik, j.nama as jabatan, j.is_increment, 
		YEAR(NOW()) - YEAR(`p`.`mulai_kerja`) - (DATE_FORMAT(NOW(), '%m%d') < DATE_FORMAT(`p`.`mulai_kerja`, '%m%d')) as masa_kerja, 
		concat('[', group_concat(JSON_OBJECT('condition', g.condition, 'masa_kerja', g.masa_kerja, 'gaji_pokok', g.gaji_pokok) order by g.id_gaji separator ','), ']') as gaji,
		CASE WHEN p.gaji_id IS NULL THEN j.gaji_default ELSE (SELECT gaji_pokok FROM gaji WHERE id_gaji = p.gaji_id) END as gaji_pokok")
			->from('pegawai p')
			->where('j.is_increment', 1)
			->join('user u', 'p.user_id = u.id', 'LEFT')
			->join('jabatan j', 'p.jabatan_id = j.id_jabatan', 'LEFT')
			->join('gaji g', 'p.jabatan_id = g.jabatan_id', 'LEFT')
			->group_by('p.id_pegawai')
			->get()->result_array();
		foreach($result as $i => $row){
			$result[$i]['gaji'] = json_decode($row['gaji'], TRUE);
			$naik_gaji = false;
			foreach($result[$i]['gaji'] as $gaji){
				if (version_compare($row['masa_kerja'], $gaji['masa_kerja'], "{$gaji['condition']}=") && ($gaji['gaji_pokok'] > $row['gaji_pokok'])){
					$result[$i]['jenjang'] = $gaji;
					$naik_gaji = true;
					break;
				}
			}
			if(!$naik_gaji){
				unset($result[$i]);
			}
		}
		return $result;
	}
}
