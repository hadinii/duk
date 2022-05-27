<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Duk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in_admin') !== TRUE) {
			redirect('login');
		}
		$this->load->model('M_duk');
		$this->load->model('M_pegawai');
	}

	public function index()
	{
		$data['duk'] = $this->M_duk->getAllDataDuk();
		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/admin');
		$this->load->view('admin/duk/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function data_duk($id)
	{
		$data['pangkat'] = [
			'Pembina Utama', 'Pembina Utama Madya', 'Pembina Utama Muda', 'Pembina Tingkat I', 'Pembina',
			'Penata Tingkat I', 'Penata', 'Penata Muda Tingkat I', 'Penata Muda',
			'Pengatur Tingkat I', 'Pengatur', 'Pengatur Muda Tingkat I', 'Pengatur Muda',
			'Juru Tingkat I', 'Juru', 'Juru Muda Tingkat I', 'Juru Muda'
		];
		$data['pendidikan'] = [
			'Doktor', 'Magister', 'Sarjana', 'Diploma IV', 'Diploma III', 'Diploma II', 'Diploma I', 'SMA', 'SMP'
		];
		$data['gol'] = [
			'IV/e', 'IV/d', 'IV/c', 'IV/b', 'IV/a',
			'III/d', 'III/c', 'III/b', 'III/a',
			'II/d', 'II/c', 'II/b', 'II/a',
			'I/d', 'I/c', 'I/b', 'I/a'
		];
		$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'required|xss_clean');
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|xss_clean');
		$this->form_validation->set_rules('golongan', 'Golongan', 'required|xss_clean');
		$this->form_validation->set_rules('tmt_pangkat', 'TMT Pangkat', 'required|xss_clean');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|xss_clean');
		$this->form_validation->set_rules('tmt_jabatan', 'TMT Jabatan', 'required|xss_clean');
		$this->form_validation->set_rules('mkgt', 'Masa Kerja Golongan (Tahun)', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('naik_pangkat', 'Naik Pangkat Yad', 'required|xss_clean');
		$this->form_validation->set_rules('naik_gaji', 'Naik Gaji Yad', 'required|xss_clean');
		$this->form_validation->set_rules('ket', 'Keterangan', 'xss_clean');
		$data['pegawai'] = $this->M_pegawai->getPegawaiById($id);
		$data['duk'] = $this->M_duk->getDataDukById($id);
		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn4";
			$this->load->view('layouts/header/admin');
			$this->load->view('admin/duk/show', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_duk->updateDataDuk();
			$this->session->set_flashdata('duk', 'Diperbarui');
			redirect('duk');
		}
	}
}
