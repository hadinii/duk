<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_admin')) {
            redirect('login');
        }

        $this->load->model('M_duk');
    }
    public function index()
    {
        // $data['tot_pgw'] = $this->db->count_all_results('pegawai');
        // $data['tot_usr'] = $this->M_duk->getAllAdmin();
        $data['tot_p'] = $this->db->count_all_results('pengajuan');
        $data['duk'] = [];
        $data['sidebar'] = "#mn1";
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/footer', $data);
    }
}
