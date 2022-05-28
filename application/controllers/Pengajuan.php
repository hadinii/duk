<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_admin')) {
            redirect('login');
        }
        $this->load->model('M_duk');
        $this->load->model('M_pegawai');
        $this->load->model('M_pengajuan');
    }

    public function index()
    {
        $data['sidebar'] = "#mn6";
        $data['pengajuan'] = $this->M_pengajuan->getAllPengajuan();
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/pengajuan/index', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function hapusDataPengajuan($id)
    {
        $this->M_pengajuan->hapusPengajuan($id);
        $this->session->set_flashdata('pengajuan', 'Dihapus');
        redirect('pengajuan');
    }

    public function detailpengajuan($id)
    {
        $data['pengajuan'] = $this->M_pengajuan->getPengajuanById($id);
        $data['sidebar'] = "#mn6";
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/pengajuan/show', $data);
        $this->load->view('layouts/footer', $data);
    }
}
