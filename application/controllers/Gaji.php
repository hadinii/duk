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
        $this->load->model('M_gaji');
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

    public function tambah()
    {
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
        $this->form_validation->set_rules('gaji_default', 'Gaji Default', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('is_increment', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
			$data['scripts'] = ['jabatan-create.js'];
            $data['sidebar'] = "#mn3";
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/gaji/create', $data);
            $this->load->view('layouts/footer', $data);
        } else {
			$this->M_gaji->tambahDataGaji();
            $this->session->set_flashdata('gaji', 'Ditambah');
            redirect('gaji');
        }
    }

    public function detailDataGaji($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'xss_clean');
        $this->form_validation->set_rules('gaji_default', 'Gaji Default', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('is_increment', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn3";
			$data['gaji'] = $this->M_gaji->getDataGajiById($id);
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/gaji/edit', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $this->M_gaji->updateDataGaji();
            $this->session->set_flashdata('gaji', 'Diperbarui');
            redirect('gaji');
        }
    }

    public function hapusDataGaji($id)
    {
        $this->M_gaji->hapusGajiPegawai($id);
        $this->session->set_flashdata('gaji', 'Dihapus');
        redirect('gaji');
    }
}
