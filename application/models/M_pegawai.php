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
		->join('gaji g', 'j.id_jabatan = g.jabatan_id', 'LEFT')
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

        $this->db->where('id', $pegawai->user_id);
        $this->db->delete('user');

		
	
        // $this->db->where('nip', $nip);
        // $this->db->delete('sk');
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

        // $dataUser = [
        //     'username' => $this->input->post('nip', true),
        //     'password' => md5($this->input->post('nip', true)),
        //     'account' => 'pegawai'
        // ];
        // $this->db->where('username', $this->input->post('nip1'));
        // $this->db->update('user', $dataUser);
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
            'username' => 'admin',
            'password' => md5($this->input->post('pb', true))
        ];
        $this->db->where('id', 1);
        $this->db->update('user', $data);
    }


    public function ketua()
    {
        return $this->db->get_where('admin', ['id_admin' => 1])->row_array();
    }

    public function resetKetua()
    {
        $data = [
            'nama' => $this->input->post('namaK', true),
            'nip' => $this->input->post('nipK', true)
        ];
        $this->db->where('id_admin', 1);
        $this->db->update('admin', $data);
    }
}
