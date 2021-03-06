<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pegawai extends CI_Model
{

    public function getAllPegawai()
    {
		return $this->db->select('p.*, u.nik, j.nama AS jabatan, j.gaji_default, g.gaji_pokok')
        ->from('pegawai p')
        ->join('user u', 'p.user_id = u.id', 'LEFT')
		->join('jabatan j', 'p.jabatan_id = j.id_jabatan', 'LEFT')
		->join('gaji g', 'p.gaji_id = g.id_gaji', 'LEFT')
		->group_by('p.id_pegawai')
        ->get()->result_array();
    }

    public function tambahDataPegawai()
    {
		$dataUser = [
			'nik' => $this->input->post('nik', true),
			'password' => md5($this->input->post('nik', true)),
		];
		$this->db->insert('user', $dataUser);
		$user_id = $this->db->insert_id();

        $dataPegawai = [
			'user_id' => $user_id,
            'nama' => $this->input->post('nama', true),
			'jabatan_id' => $this->input->post('jabatan_id', true),
			'mulai_kerja' => $this->input->post('mulai_kerja', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'agama' => $this->input->post('agama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email' => $this->input->post('email', true),
            'alamat' => $this->input->post('alamat', true),
        ];
        $this->db->insert('pegawai', $dataPegawai);
	
    }

    public function hapusDataPegawai($id)
    {
        $pegawai = $this->db->where('id_pegawai', $id)->get('pegawai')->row_array();
        $this->db->where('id_pegawai', $id)->delete('pegawai');
		
        $this->db->where('id', $pegawai['user_id']);
        $this->db->delete('user');
		
		$this->db->where('pegawai_id', $pegawai['id_pegawai']);
        $this->db->delete('pengajuan');
    }

    public function getPegawaiById($id)
    {
        return $this->db->select('p.*, u.nik, j.nama as jabatan')
			->from('pegawai p')
			->where('p.id_pegawai', $id)
			->join('user u', 'p.user_id = u.id', 'LEFT')
			->join('jabatan j', 'p.jabatan_id = j.id_jabatan', 'LEFT')
			->get()->row_array();
    }

    public function ubahDataPegawai()
    {
        $dataPegawai = [
            'nama' => $this->input->post('nama', true),
			'jabatan_id' => $this->input->post('jabatan_id', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'agama' => $this->input->post('agama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email' => $this->input->post('email', true),
            'alamat' => $this->input->post('alamat', true),
        ];
        $this->db->where('id_pegawai', $this->input->post('id'));
        $this->db->update('pegawai', $dataPegawai);
    }

    public function resetPass()
    {
        $data = [
            'password' => md5($this->input->post('nik', true))
        ];
        $this->db->where('nik', $this->input->post('nik', true));
        $this->db->update('user', $data);
    }

    public function ubahPassword()
    {
        $data = [
            'password' => md5($this->input->post('pb', true))
        ];
        $this->db->where('id', 1);
        $this->db->update('user', $data);
    }


    public function ketua()
    {
        return $this->db->get_where('user', ['id' => 1])->row_array();
    }
}
