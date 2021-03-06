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
            $this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil menambahkan data gaji'
			]);
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
            $this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil menambahkan data gaji'
			]);
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
			$data['scripts'] = ['jabatan-show.js'];
			$data['gaji'] = $this->M_jabatan->show($id_jabatan);
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/gaji/edit', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $this->M_jabatan->update($id_jabatan);
            $this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Berhasil mengubah data gaji'
			]);
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
			$pengajuan = $this->M_pengajuan->createPengajuan();	
			$this->_sendMail($pengajuan['email']);
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Email pengurusan kenaikan gaji telah terkirim'
			]);
			redirect('pengajuan');
		}
	}

    public function destroy($id)
    {
        $id_jabatan = $this->M_gaji->delete($id);
        $this->session->set_flashdata('notification', [
			'status' => $id_jabatan ? 'success' : 'danger',
			'message' => $id_jabatan ? 'Berhasil menghapus data gaji' : 'Tidak dapat menghapus gaji tersebut'
		]);
        redirect($id_jabatan ? 'gaji/'.$id_jabatan : 'gaji');
    }

    public function destroyJabatan($id)
    {
        $status = $this->M_jabatan->delete($id);
        $this->session->set_flashdata('notification', [
			'status' => $status ? 'success' : 'danger',
			'message' => $status ? 'Berhasil menghapus data jabatan' : 'Tidak dapat menghapus jabatan tersebut'
		]);
        redirect('gaji');
    }

	public function _sendMail($email)
	{
		var_dump($email);
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => 'hidayatyusril694@gmail.com',
			'smtp_pass' => 'horqvmuftrswhlfz',
			'smtp_port' =>  587,
			'smtp_crypto' => 'tls',
			'mailtype'  => 'text',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->from('disnakkeswan.riau@gmail.com', 'Dinas Pertenakan dan Kesehatan Hewan Provinsi Riau');
		$this->email->to($email);
		$this->email->subject('Kenaikan Gaji');
		$this->email->message('Segera Urus Kenaikan Gaji!
		*Upload file di sistem DUK');

		if (!$this->email->send()) {
			echo $this->email->print_debugger();
			die;
		}
	}
}
