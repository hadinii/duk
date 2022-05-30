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

        $this->load->model('M_gaji');
    }
    public function index()
    {
        $data['tot_p'] = $this->db->count_all_results('pengajuan');
        $data['naiK_gaji'] = $this->M_gaji->getNaikGaji();
        $data['sidebar'] = "#mn1";
        $this->load->view('layouts/header/admin');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/footer', $data);
    }
}
