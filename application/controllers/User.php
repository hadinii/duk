<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_admin')) {
			redirect('login');
		}
		$this->load->model('M_user');
		$this->load->helper('nominal');
		$this->load->library('upload');

		$this->load->helper(['url', 'form']);
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['gaji'] = [];
		// $this->M_user->dataGaji();
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$data['sidebar'] = "#mn1";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function data()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$data['gol_darah'] = ['-', 'A', 'B', 'AB', 'O'];
		$data['jk'] = ['Laki-laki', 'Perempuan'];
		$data['agama'] = ['Islam', 'Protestan', 'Katholik', 'Hindu', 'Budha'];

		$this->form_validation->set_rules('nik', 'NIK', 'required|xss_clean|numeric|max_length[18]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|xss_clean');
		// $this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'required|xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('ket', 'Keterangan', 'xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn2";
			$this->load->view('layouts/header/user', $data);
			$this->load->view('user/pegawai/show', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_user->ubahDataPegawai();
			$this->session->set_flashdata('pegawai', 'Diubah');
			redirect('user/data');
		}
	}

	public function setting_user()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['gaji'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		$this->form_validation->set_rules('pb', 'Password Baru', 'required|xss_clean');
		$this->form_validation->set_rules('kpb', 'Konfirmasi Password', 'required|xss_clean|matches[pb]');
		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn3";
			$this->load->view('layouts/header/user', $data);
			$this->load->view('auth/setting/user', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_user->ubahPasswordUser();
			$this->session->set_flashdata('pegawai', 'Diubah');
			redirect('user/setting_user');
		}
	}

	public function pengajuan_user()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		// $data['pengajuan'] = $this->M_user->dataPengajuanUser($id);

		$data['pengajuan'] = $this->M_user->getAllPengajuan();

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function pengajuan_reguler()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/reguler', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_reguler()
	{

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
			$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
			$this->form_validation->set_rules('tanggal', 'Golongan', 'required|xss_clean');
			$this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required|xss_clean');
			$this->form_validation->set_rules('sk_cpns', 'SK CPNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_pns', 'SK PNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_terakhir', 'SK Terakhir', 'required|xss_clean');
			$this->form_validation->set_rules('skp', 'Sasaran Kinerja Pegawai 1', 'required|xss_clean');
			$this->form_validation->set_rules('skp2', 'Sasaran Kinerja Pegawai 2', 'required|xss_clean');
			$this->form_validation->set_rules('ijazah_terakhir', 'Ijazah Terakhir dan Transkip Nilai', 'required|xss_clean');
			$this->form_validation->set_rules('sk_jterakhir', 'SK Jabatan', 'required|xss_clean');

			if ($_FILES['sk_cpns']['name']) {

				$config['upload_path']   = './assets/berkas/sk_cpns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_cpns')) {
					$sk_cpns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_pns']['name']) {
				$config['upload_path']   = './assets/berkas/sk_pns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_pns')) {
					$sk_pns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_terakhir']['name']) {

				$config['upload_path']   = './assets/berkas/sk_terakhir/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_terakhir')) {
					$sk_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp']['name']) {
				$config['upload_path']   = './assets/berkas/skp/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp')) {
					$skp = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp2']['name']) {
				$config['upload_path']   = './assets/berkas/skp2/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp2')) {
					$skp2 = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['ijazah_terakhir']['name']) {
				$config['upload_path']   = './assets/berkas/ijazah/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('ijazah_terakhir')) {
					$ijazah_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_jterakhir']['name']) {
				$config['upload_path']   = './assets/berkas/sk_jabatan/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_jterakhir')) {
					$sk_jterakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'tanggal' => $this->input->post('tanggal'),
				'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
				'sk_cpns' => $sk_cpns,
				'sk_pns' => $sk_pns,
				'sk_terakhir' => $sk_terakhir,
				'skp' => $skp,
				'skp2' => $skp2,
				'ijazah_terakhir' => $ijazah_terakhir,
				'sk_jterakhir' => $sk_jterakhir
			];
			//insert data into database table.  
			$this->db->insert('pengajuan', $data);
			$this->session->set_flashdata('reguler', 'Dikirim');
			redirect("User/pengajuan_reguler");
		}
	}


	public function pengajuan_fungsional()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/fungsional', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_fungsional()
	{

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
			$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
			$this->form_validation->set_rules('tanggal', 'Golongan', 'required|xss_clean');
			$this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required|xss_clean');
			$this->form_validation->set_rules('sk_cpns', 'SK CPNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_pns', 'SK PNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_terakhir', 'SK Terakhir', 'required|xss_clean');
			$this->form_validation->set_rules('skp', 'Sasaran Kinerja Pegawai 1', 'required|xss_clean');
			$this->form_validation->set_rules('skp2', 'Sasaran Kinerja Pegawai 2', 'required|xss_clean');
			$this->form_validation->set_rules('sk_jf', 'SK Jabatan Fungsional', 'required|xss_clean');
			$this->form_validation->set_rules('pak', 'PAK', 'required|xss_clean');
			$this->form_validation->set_rules('ijazah_terakhir', 'Ijazah Terakhir dan Transkip Nilai', 'required|xss_clean');


			if ($_FILES['sk_cpns']['name']) {

				$config['upload_path']   = './assets/berkas/sk_cpns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_cpns')) {
					$sk_cpns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_pns']['name']) {
				$config['upload_path']   = './assets/berkas/sk_pns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_pns')) {
					$sk_pns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_terakhir']['name']) {

				$config['upload_path']   = './assets/berkas/sk_terakhir/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_terakhir')) {
					$sk_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp']['name']) {
				$config['upload_path']   = './assets/berkas/skp/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp')) {
					$skp = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp2']['name']) {
				$config['upload_path']   = './assets/berkas/skp2/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp2')) {
					$skp2 = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_jf']['name']) {

				$config['upload_path']   = './assets/berkas/sk_jabatan_fungsional/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_jf')) {
					$sk_jf = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['pak']['name']) {
				$config['upload_path']   = './assets/berkas/pak/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('pak')) {
					$pak = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['ijazah_terakhir']['name']) {
				$config['upload_path']   = './assets/berkas/ijazah/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('ijazah_terakhir')) {
					$ijazah_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'tanggal' => $this->input->post('tanggal'),
				'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
				'sk_cpns' => $sk_cpns,
				'sk_pns' => $sk_pns,
				'sk_terakhir' => $sk_terakhir,
				'skp' => $skp,
				'skp2' => $skp2,
				'sk_jf' => $sk_jf,
				'pak' => $pak,
				'ijazah_terakhir' => $ijazah_terakhir
			];
			//insert data into database table.  
			$this->db->insert('pengajuan', $data);
			$this->session->set_flashdata('fungsional', 'Dikirim');
			redirect("User/pengajuan_fungsional");
		}
	}


	public function pengajuan_structural()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/structural', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_structural()
	{

		if (isset($_POST['submit'])) {

			$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
			$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
			$this->form_validation->set_rules('tanggal', 'Golongan', 'required|xss_clean');
			$this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required|xss_clean');
			$this->form_validation->set_rules('sk_cpns', 'SK CPNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_pns', 'SK PNS', 'required|xss_clean');
			$this->form_validation->set_rules('sk_terakhir', 'SK Terakhir', 'required|xss_clean');
			$this->form_validation->set_rules('sk_p', 'SK Pelantikan', 'required|xss_clean');
			$this->form_validation->set_rules('skp', 'Sasaran Kinerja Pegawai 1', 'required|xss_clean');
			$this->form_validation->set_rules('skp2', 'Sasaran Kinerja Pegawai 2', 'required|xss_clean');
			$this->form_validation->set_rules('ijazah_terakhir', 'Ijazah Terakhir dan Transkip Nilai', 'required|xss_clean');
			$this->form_validation->set_rules('sk_js', 'SK Jabatan Fungsional', 'required|xss_clean');
			
			if ($_FILES['sk_cpns']['name']) {

				$config['upload_path']   = './assets/berkas/sk_cpns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_cpns')) {
					$sk_cpns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_pns']['name']) {
				$config['upload_path']   = './assets/berkas/sk_pns/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_pns')) {
					$sk_pns = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_terakhir']['name']) {

				$config['upload_path']   = './assets/berkas/sk_terakhir/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_terakhir')) {
					$sk_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}


			if ($_FILES['sk_p']['name']) {
				$config['upload_path']   = './assets/berkas/sk_pelantikan/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_p')) {
					$sk_p = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp']['name']) {
				$config['upload_path']   = './assets/berkas/skp/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp')) {
					$skp = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['skp2']['name']) {
				$config['upload_path']   = './assets/berkas/skp2/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('skp2')) {
					$skp2 = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['ijazah_terakhir']['name']) {
				$config['upload_path']   = './assets/berkas/ijazah/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('ijazah_terakhir')) {
					$ijazah_terakhir = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sk_js']['name']) {
				$config['upload_path']   = './assets/berkas/sk_jabatan_structural/';
				$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
				$config['max_size']      = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sk_js')) {
					$sk_js = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			
			$data = [
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'tanggal' => $this->input->post('tanggal'),
				'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
				'sk_cpns' => $sk_cpns,
				'sk_pns' => $sk_pns,
				'sk_terakhir' => $sk_terakhir,
				'sk_p' => $sk_p,
				'skp' => $skp,
				'skp2' => $skp2,
				'ijazah_terakhir' => $ijazah_terakhir,
				'sk_js' => $sk_js
			];
			//insert data into database table.  
			$this->db->insert('pengajuan', $data);
			$this->session->set_flashdata('structural', 'Dikirim');
			redirect("User/pengajuan_structural");
		}
	}

	public function pengajuan_gaji()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('username');
		$data['client'] = [];
		$data['pegawai'] = $this->M_user->getPegawaiById($id);

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/gaji', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_gaji()
	{

		$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('tanggal', 'Golongan', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required|xss_clean');
		$this->form_validation->set_rules('sk_terakhir', 'SK Terakhir', 'required|xss_clean');
		$this->form_validation->set_rules('sk_kgb', 'SK Kenaikan Gaji Berkala', 'required|xss_clean');

		if ($_FILES['sk_terakhir']['name']) {

			$config['upload_path']   = './assets/berkas/sk_terakhir/';
			$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
			$config['max_size']      = 2000;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('sk_terakhir')) {
				$sk_terakhir = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if ($_FILES['sk_kgb']['name']) {
			$config['upload_path']   = './assets/berkas/sk_kgb/';
			$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
			$config['max_size']      = 2000;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('sk_kgb')) {
				$sk_kgb = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama' => $this->input->post('nama'),
			'nip' => $this->input->post('nip'),
			'tanggal' => $this->input->post('tanggal'),
			'jenis_pengajuan' => $this->input->post('jenis_pengajuan'),
			'sk_terakhir' => $sk_terakhir,
			'sk_kgb' => $sk_kgb
		];
		//insert data into database table.  
		$this->db->insert('pengajuan', $data);
		$this->session->set_flashdata('gaji', 'Dikirim');
		redirect("User/pengajuan_gaji");
	}
}
