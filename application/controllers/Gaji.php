<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_admin')) {
            redirect('login');
        }
        $this->load->model('M_pegawai');
        $this->load->model('M_jabatan');
        $this->load->model('M_gaji');
        $this->load->model('M_pengajuan');
        $this->load->helper('nominal');
        $this->load->helper('text');
    }
    public function index()
    {
        $data['jabatan'] = $this->M_gaji->getAllDataGaji();
        $data['sidebar'] = "#mn3";
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/gaji/index', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
        $this->form_validation->set_rules('gaji_default', 'Gaji Default', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('is_increment', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['sidebar'] = "#mn3";
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/gaji/create', $data);
            $this->load->view('layouts/footer', $data);
        } else {
			$jabatan = $this->M_jabatan->store();
			// var_dump($jabatan);
			// die();
            $this->session->set_flashdata('notification', 'Ditambah');
            redirect($jabatan['is_increment'] ? 'gaji/'.$jabatan['id_jabatan'] : 'gaji');
        }
    }

	public function store($id_jabatan)
	{
		$this->form_validation->set_rules('condition', 'Kondisi', 'required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required|xss_clean|numeric');
		if ($this->form_validation->run()) {
			$this->M_gaji->store($id_jabatan);
            $this->session->set_flashdata('notification', 'Berhasil menambah data gaji');
            redirect('gaji/'.$id_jabatan);
        }
	}

    public function show($id_jabatan)
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
        $this->form_validation->set_rules('gaji_default', 'Gaji Default', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('is_increment', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn3";
			$data['scripts'] = ['jabatan-edit.js'];
			$data['gaji'] = $this->M_jabatan->show($id_jabatan);
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/gaji/edit', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $this->M_jabatan->update($id_jabatan);
            $this->session->set_flashdata('notification', 'Diperbarui');
            redirect('gaji/'.$id_jabatan);
        }
    }
	
	public function naikGaji($id_pegawai, $id_gaji)
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$data['sidebar'] = "#mn1";
			$data['pegawai'] = $this->M_pegawai->getPegawaiById($id_pegawai);
			$data['gaji'] = $this->M_gaji->getGajiById($id_gaji);
			$data['pengajuan'] = $this->M_pengajuan->getPengajuanByPegawaiGaji($id_pegawai, $id_gaji);
			if($data['pengajuan']){
				redirect('pengajuan/'.$data['pengajuan']['id_pengajuan']);
			}else{
				$this->load->view('layouts/header/admin');
				$this->load->view('admin/pengajuan/create', $data);
				$this->load->view('layouts/footer', $data);
			}
		} else {
			$this->M_pengajuan->createPengajuan();
			$this->session->set_flashdata('notification', 'Berhasil membuat pengajuan!');
			redirect("pengajuan/{$id_pegawai}/{$id_gaji}");
		}
	}

    public function destroy($id)
    {
        $id_jabatan = $this->M_gaji->delete($id);
        $this->session->set_flashdata('notification', 'Berhasil menghapus data gaji');
        redirect('gaji/'.$id_jabatan);
    }
}
