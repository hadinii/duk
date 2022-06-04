<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_admin')) {
			redirect('login');
		}
		$this->load->model('M_pegawai');
		$this->load->model('M_jabatan');
		$this->load->helper('masa_kerja');
	}
	public function index()
	{
		$data['sidebar'] = "#mn2";
		$data['pegawai'] = $this->M_pegawai->getAllPegawai();
		$this->load->view('layouts/header/admin');
		$this->load->view('admin/pegawai/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|xss_clean|numeric|exact_length[16]|is_unique[user.nik]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('mulai_kerja', 'Mulai Kerja', 'xss_clean');
		$this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn2";
			$data['jabatan'] = $this->M_jabatan->index();
			$this->load->view('layouts/header/admin');
			$this->load->view('admin/pegawai/create', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_pegawai->tambahDataPegawai();
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil menambah data pegawai'
			]);
			redirect('pegawai');
		}
	}

	public function detailPegawai($id)
	{
		$data['pegawai'] = $this->M_pegawai->getPegawaiById($id);
		$data['gol_darah'] = ['-', 'A', 'B', 'AB', 'O'];
		$data['jk'] = ['Laki-laki', 'Perempuan'];
		$data['agama'] = ['Islam', 'Protestan', 'Katholik', 'Hindu', 'Budha'];

		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn2";
			$data['jabatan'] = $this->M_jabatan->index();
			$this->load->view('layouts/header/admin');
			$this->load->view('admin/pegawai/show', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_pegawai->ubahDataPegawai();
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil mengubah data pegawai'
			]);
			redirect('pegawai');
		}
	}

	public function hapusPegawai($id)
	{
		$this->M_pegawai->hapusDataPegawai($id);
		$this->session->set_flashdata('notification', [
			'status' => 'success',
			'message' => 'Berhasil menghapus data pegawai'
		]);
		redirect('pegawai');
	}

	public function resetPassword()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|xss_clean|numeric');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notification', [
				'status' => 'danger',
				'message' => 'Gagal mereset password'
			]);
			redirect('pegawai');
		} else {
			$this->M_pegawai->resetPass();
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil mereset password'
			]);
			redirect('pegawai');
		}
	}

	public function setting()
	{
		$data['ketua'] = $this->M_pegawai->ketua();
		$this->form_validation->set_rules('pb', 'Password Baru', 'required|xss_clean');
		$this->form_validation->set_rules('kpb', 'Konfirmasi Password', 'required|xss_clean|matches[pb]');
		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn5";
			$this->load->view('layouts/header/admin');
			$this->load->view('auth/setting/admin', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_pegawai->ubahPassword();
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Password berhasil diubah!'
			]);
			redirect('setting');
		}
	}
}
