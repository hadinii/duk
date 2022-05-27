<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in_admin') !== TRUE) {
            redirect('login');
        }
        $this->load->model('M_gaji');
        $this->load->helper('nominal');
        $this->load->helper('text');
    }
    public function index()
    {
        $data['gaji'] = $this->M_gaji->getAllDataGaji();
        $data['sidebar'] = "#mn3";
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/gaji/index', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function tambah()
    {
        $data['gol'] = [
            'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e',
            'III/a', 'III/b', 'III/c', 'III/d',
            'II/a', 'II/b', 'II/c', 'II/d',
            'I/a', 'I/b', 'I/c', 'I/d'
        ];
        $this->form_validation->set_rules('gol', 'Golongan', 'required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'required|xss_clean');
        $this->form_validation->set_rules('gaji_pokok', 'Golongan', 'required|xss_clean|numeric');

        if ($this->form_validation->run() == FALSE) {
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
        $data['gol'] = [
            'IV/e', 'IV/d', 'IV/c', 'IV/b', 'IV/a',
            'III/d', 'III/c', 'III/b', 'III/a',
            'II/d', 'II/c', 'II/b', 'II/a',
            'I/d', 'I/c', 'I/b', 'I/a'
        ];
        $this->form_validation->set_rules('gol', 'Golongan', 'required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'required|xss_clean');
        $this->form_validation->set_rules('gaji_pokok', 'Golongan', 'required|xss_clean|numeric');
        $data['gaji'] = $this->M_gaji->getDataGajiById($id);
        if ($this->form_validation->run() == FALSE) {
            $data['sidebar'] = "#mn3";
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
