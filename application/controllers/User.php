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
		$this->load->model('M_jabatan');
		$this->load->model('M_pengajuan');
		$this->load->helper('nominal');
		$this->load->helper('masa_kerja');
		$this->load->library('upload');

		$this->load->helper(['url', 'form']);
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$data['sidebar'] = "#mn1";
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function data()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$data['gol_darah'] = ['-', 'A', 'B', 'AB', 'O'];
		$data['jk'] = ['Laki-laki', 'Perempuan'];
		$data['agama'] = ['Islam', 'Protestan', 'Katholik', 'Hindu', 'Budha'];

		// $this->form_validation->set_rules('nik', 'NIK', 'required|xss_clean|numeric|max_length[18]');
		// $this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|xss_clean');
		// $this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'required|xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		// $this->form_validation->set_rules('ket', 'Keterangan', 'xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = "#mn2";
			$data['jabatan'] = $this->M_jabatan->index();
			$this->load->view('layouts/header/user', $data);
			$this->load->view('user/pegawai/show', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_user->ubahDataPegawai();
			$this->session->set_flashdata('notification', 'Diubah');
			redirect('user/data');
		}
	}

	public function setting_user()
	{
		$id = $this->session->userdata('id');
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
			$this->session->set_flashdata('notification', 'Diubah');
			redirect('user/setting_user');
		}
	}

	public function pengajuan_user()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$data['pengajuan'] = $this->M_user->getPengajuanById($id);

		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function pengajuan_gaji()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiById($id);
		$data['sidebar'] = "#mn4";
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/gaji', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_gaji()
	{
		$id = $this->session->userdata('id');
		$pegawai =$this->M_user->getPegawaiById($id);
		$is_accepted = $this->M_user->getStatsPengajuanByPegawai($pegawai['id_pegawai']);
		$pengajuan = $this->M_user->getAllPengajuanById($pegawai['id_pegawai']);

		$this->form_validation->set_rules('spjtm', 'Surat Pernyataan Tanggung Jawab Mutlak', 'required|xss_clean');
		$this->form_validation->set_rules('spmk', 'Surat Perintah Mulai Kerja', 'required|xss_clean');
		$this->form_validation->set_rules('spk', 'Surat Perintah Kerja', 'required|xss_clean');
		$this->form_validation->set_rules('sppjl', 'Surat Penunjukan Penyedia Jasa Lainnya', 'required|xss_clean');
		$this->form_validation->set_rules('bahpl', 'Berita Acara Hasil Pengadaan Langsung', 'required|xss_clean');
		$this->form_validation->set_rules('baktnb', 'Berita Acara Klarifikasi Teknis Dan Negosiasi Biaya', 'required|xss_clean');
		$this->form_validation->set_rules('lampiran_ba ', 'Lampiran Berita Acara', 'required|xss_clean');
		$this->form_validation->set_rules('baedp', 'Berita Acara Evaluasi Dokumen Penawaran', 'required|xss_clean');
		$this->form_validation->set_rules('sdp', 'Staff Development Program', 'required|xss_clean');
		$this->form_validation->set_rules('undangan', 'Undangan', 'required|xss_clean');
		$this->form_validation->set_rules('ijazah', 'Ijazah', 'required|xss_clean');
		$this->form_validation->set_rules('cv', 'cv', 'required|xss_clean');
		$this->form_validation->set_rules('transkrip', 'Transkrip', 'required|xss_clean');
		$this->form_validation->set_rules('sertifikat_keahlian', 'Sertifikat Keahlian', 'required|xss_clean');

		if(is_null($is_accepted) || $is_accepted === 1) {
			if ($_FILES['spjtm']['name'] != "") {

				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Surat Pernyataan Tanggung Jawab Mutlak (SPJTM)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('spjtm')) {
					$spjtm = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['spmk']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Surat Perintah Mulai Kerja (SPMK)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('spmk')) {
					$spmk = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['spk']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Surat Perintah Kerja (SPK)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('spk')) {
					$spk = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sppjl']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Surat Penunjukan Penyedia Jasa Lainnya";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sppjl')) {
					$sppjl = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['bahpl']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Berita Acara Hasil Pengadaan Langsung";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('bahpl')) {
					$bahpl = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['baktnb']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Berita Acara Klarifikasi Teknis Dan Negosiasi Biaya";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('baktnb')) {
					$baktnb = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['lampiran_ba']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Lampiran Berita Acara";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('lampiran_ba')) {
					$lampiran_ba = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['baedp']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Berita Acara Evaluasi Dokumen Penawaran (BAEDP)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('baedp')) {
					$baedp = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sdp']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Staff Development Program (SDP)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sdp')) {
					$sdp = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['undangan']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Undangan";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('undangan')) {
					$undangan = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['ijazah']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Ijazah";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('ijazah')) {
					$ijazah = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['cv']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Curriculum Vitae (CV)";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('cv')) {
					$cv = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['transkrip']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Transkrip";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('transkrip')) {
					$transkrip = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			if ($_FILES['sertifikat_keahlian']['name'] != "") {
				$config['upload_path']   = './assets/pengajuan/';
				$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
				$config['max_size']      = 2000;
				$config['file_name']     = "Sertifikat Keahlian";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('sertifikat_keahlian')) {
					$sertifikat_keahlian = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'pegawai_id' => $id,
				'spjtm' => $spjtm,
				'spmk' => $spmk,
				'spk' => $spk,
				'sppjl' => $sppjl,
				'bahpl' => $bahpl,
				'baktnb' => $baktnb,
				'lampiran_ba' => $lampiran_ba,
				'baedp' => $baedp,
				'sdp' => $sdp,
				'undangan' => $undangan,
				'ijazah' => $ijazah,
				'cv' => $cv,
				'transkrip' => $transkrip,
				'sertifikat_keahlian' => $sertifikat_keahlian,
				'created_at' => date('y-m-d')
			];
			//insert data into database table. 
			$this->db->insert('pengajuan', $data);
			$this->session->set_flashdata('notification', 'Berhasil');
			redirect("User/pengajuan_user");

			// $data_pengajuan = $this->M_user->getPengajuanById($id);
			// // if ($data_pengajuan['nik'] == $data['nik']) {
			// // }			
		}else{
			$this->session->set_flashdata('notification', 'Sudah Diajukan ');
			redirect("User/pengajuan_user");
		} 
	}
}
