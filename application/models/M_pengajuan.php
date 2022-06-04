<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengajuan extends CI_Model
{

    public function getAllPengajuan($status = null)
    {
        $this->db->select('p.*, pw.nama, u.nik')
			->from('pengajuan p')
			->join('pegawai pw', 'p.pegawai_id = pw.id_pegawai', 'LEFT')
			->join('user u', 'pw.user_id = u.id', 'LEFT');
		if(!is_null($status))
		{
			$this->db->where('is_accepted',$status);
		}
		return $this->db->get()->result_array();
    }

	public function getPengajuanByPegawaiGaji($id_pegawai, $id_gaji)
	{
		return $this->db->get_where('pengajuan', ['pegawai_id' => $id_pegawai, 'gaji_id' => $id_gaji])->row_array();
	}

	public function createPengajuan()
	{
		$data = [
			'pegawai_id' => $this->input->post('id_pegawai', true),
			'gaji_id' => $this->input->post('id_gaji', true),
			'created_at' => date('Y-m-d')
		];
		$this->db->insert('pengajuan', $data);

		$id_pengajuan = $this->db->insert_id();

		$pengajuan = $this->db->select('p.*, pw.email')
			->from('pengajuan p')
			->join('pegawai pw', 'p.pegawai_id = pw.id_pegawai', 'LEFT')
			->where('p.id_pengajuan', $id_pengajuan)
			->get()
			->row_array();

		return $pengajuan;
	}

	public function accept($id)
	{
		$data = [
			'is_accepted' => 1
		];
		$this->db->where('id_pengajuan', $id);
		$this->db->update('pengajuan', $data);
		
		$data = [
			'gaji_id' => $this->input->post('id_gaji')
		];
		$this->db->where('id_pegawai', $this->input->post('id_pegawai'));
		$this->db->update('pegawai', $data);

	}

    public function hapusPengajuan($id)
    {
        $this->db->where('id_pengajuan', $id);
        $this->db->delete('pengajuan');
    }

    public function getPengajuanById($id)
    {
        return $this->db->select('p.*, pw.id_pegawai, pw.nama, u.nik, j.nama as jabatan')
		->from('pengajuan p')
		->join('pegawai pw', 'p.pegawai_id = pw.id_pegawai', 'LEFT')
		->join('user u', 'pw.user_id = u.id', 'LEFT')
		->join('jabatan j', 'pw.jabatan_id = j.id_jabatan', 'LEFT')
		->where('id_pengajuan', $id)
		->get()->row_array();
    }
}
