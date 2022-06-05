<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Gaji extends CI_Model {

    public function store($id_jabatan){
		$data = [
			'jabatan_id' => $id_jabatan,
			'condition' => $this->input->post('condition',true),
			'masa_kerja' => $this->input->post('masa_kerja',true),
			'gaji_pokok' => $this->input->post('gaji_pokok',true)
		];
		$id_gaji = $this->input->post('id_gaji',true);
		if($id_gaji){
			$this->db->where('id_gaji', $id_gaji);
			$this->db->update('gaji',$data);
		}else{
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

	public function getGajiById($id)
	{
		return $this->db->get_where('gaji', ['id_gaji' => $id])->row_array();
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
    }

    public function delete($id){
        $gaji = $this->db->get_where('gaji', ['id_gaji' => $id])->row_array();
		$this->db->where('id_gaji', $id);
        $this->db->delete('gaji');

		// update all pegawai where gaji_id = deleted
		$pegawai = $this->db->select('id_pegawai')
					->from('pegawai')
					->where('gaji_id', $gaji['id_gaji'])
					->get()->result_array();
		foreach($pegawai as $row) {
			$data = [
				'gaji_id' => null
			];
			$this->db->where('id_pegawai', $row['id_pegawai']);
			$this->db->update('pegawai', $data);
		}
		return $gaji['jabatan_id'];
    }

	public function getNaikGaji()
	{
		$result = $this->db->select("p.*, u.nik, j.nama as jabatan, j.is_increment, 
		YEAR(NOW()) - YEAR(`p`.`mulai_kerja`) - (DATE_FORMAT(NOW(), '%m%d') < DATE_FORMAT(`p`.`mulai_kerja`, '%m%d')) as masa_kerja, 
		concat('[', group_concat(JSON_OBJECT('id_gaji', g.id_gaji, 'condition', g.condition, 'masa_kerja', g.masa_kerja, 'gaji_pokok', g.gaji_pokok) order by g.id_gaji separator ','), ']') as gaji,
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
				continue;
			}
			$result[$i]['pengajuan'] = $this->db->get_where('pengajuan', ['pegawai_id' => $row['id_pegawai'], 'gaji_id' => $result[$i]['jenjang']['id_gaji']])->row_array();
		}
		return $result;
	}
}
