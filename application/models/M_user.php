<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function dataClient()
    {
        $id = $this->session->userdata('username');
        return $this->db->get_where('duk', ['nip' => $id])->row_array();
    }

	public function getAllPegawai()
	{
		return $this->db->select('p.*, u.nik, j.nama AS jabatan, j.gaji_default, g.gaji_pokok')
        ->from('pegawai p')
        ->join('user u', 'p.user_id = u.id', 'LEFT')
		->join('jabatan j', 'p.jabatan_id = j.id_jabatan', 'LEFT')
		->join('gaji g', 'j.id_jabatan = g.jabatan_id', 'LEFT')
        ->get()->row_array();
	}

    public function getPegawaiById($id)
    {
		// $this->db->select('*, pegawai.nama as pnama, jabatan.nama as jnama');
		// $this->db->from('pegawai');
		// $this->db->join('jabatan', 'jabatan.id_jabatan = pegawai.jabatan_id');
		// $this->db->where('pegawai.user_id', $id);
		// return $this->db->get()->row_array();
		// return $this->db->get_where('pegawai', ['user_id' => $id])->row_array();
		return $this->db->select('p.*, u.nik, j.nama as jabatan')
			->from('pegawai p')
			->where('p.id_pegawai', $id)
			->join('user u', 'p.user_id = u.id', 'LEFT')
			->join('jabatan j', 'p.jabatan_id = j.id_jabatan', 'LEFT')
			->get()->row_array();
    }

    public function getAllPengajuan()
    {
        return $this->db->get('pengajuan')->result_array();
    }

    public function getPengajuanById($id)
    {
        return $this->db->get_where('pengajuan', ['id_pengajuan' => $id])->row_array();
    }




    public function dataGaji()
    {
        $nik = $this->session->userdata('username');
        $query = $this->db->query('SELECT gaji_pokok FROM gaji WHERE golongan = (SELECT golongan FROM duk WHERE nip = ' . $nik . ') AND masa_kerja = (SELECT masa_kerja_golongan FROM duk WHERE nip = ' . $nik . ' )');
        return $query->row_array();
    }

    public function ubahDataPegawai()
    {
        $dataPegawai = [
            // 'nik' => $this->input->post('nik', true),
            // 'nama' => $this->input->post('nama', true),
            'jabatan_id' => $this->input->post('jabatan_id', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'agama' => $this->input->post('agama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email' => $this->input->post('email', true),
            'alamat' => $this->input->post('alamat', true)
        ];
        $this->db->where('id_pegawai', $this->input->post('id'));
        $this->db->update('pegawai', $dataPegawai);

        $dataDuk = [
            'nip' => $this->input->post('nip', true),
            'nama' => $this->input->post('nama', true),
            'keterangan' => $this->input->post('ket', true)
        ];

        // $dataUser = [
        //     'username' => $this->input->post('nip', true),
        //     'password' => md5($this->input->post('nip', true)),
        //     'account' => 'pegawai'
        // ];
        // $this->db->where('username', $this->input->post('nip'));
        // $this->db->update('user', $dataUser);
    }

    public function ubahPasswordUser()
    {
        $data = [
            'username' => $this->session->userdata('username'),
            'password' => md5($this->input->post('pb', true))
        ];
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('user', $data);
    }
}
