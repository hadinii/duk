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
		$data['sidebar'] = '#mn1';
		$data['pegawai'] = $this->M_user->getPegawaiByUserId($id);
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function data()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiByUserId($id);
		$data['gol_darah'] = ['-', 'A', 'B', 'AB', 'O'];
		$data['jk'] = ['Laki-laki', 'Perempuan'];
		$data['agama'] = ['Islam', 'Protestan', 'Katholik', 'Hindu', 'Budha'];

		// $this->form_validation->set_rules('nik', 'NIK', 'required|xss_clean|numeric|max_length[18]');
		// $this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
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
			$data['sidebar'] = '#mn2';
			$data['jabatan'] = $this->M_jabatan->index();
			$this->load->view('layouts/header/user', $data);
			$this->load->view('user/pegawai/show', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_user->ubahDataPegawai();
			$this->session->set_flashdata('notification', [
				'status' => 'Berhasil mengubah data pegawai'
			]);
			redirect('user/data');
		}
	}

	public function setting_user()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiByUserId($id);

		$this->form_validation->set_rules('pb', 'Password Baru', 'required|xss_clean');
		$this->form_validation->set_rules('kpb', 'Konfirmasi Password', 'required|xss_clean|matches[pb]');
		if ($this->form_validation->run() == FALSE) {
			$data['sidebar'] = '#mn3';
			$this->load->view('layouts/header/user', $data);
			$this->load->view('auth/setting/user', $data);
			$this->load->view('layouts/footer', $data);
		} else {
			$this->M_user->ubahPasswordUser();
			$this->session->set_flashdata('notification', [
				'status' => 'success',
				'message' => 'Password berhasil diubah'
			]);
			redirect('user/setting_user');
		}
	}

	public function pengajuan_user()
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiByUserId($id);
		$data['pengajuan'] = $this->M_user->getAllPengajuanById($data['pegawai']['id_pegawai']);

		$data['sidebar'] = '#mn4';
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/index', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function pengajuan_gaji($id_pengajuan)
	{
		$id = $this->session->userdata('id');
		$data['pegawai'] = $this->M_user->getPegawaiByUserId($id);
		$data['pengajuan'] = $this->M_user->getPengajuanById($id_pengajuan);
		$data['sidebar'] = '#mn4';
		$this->load->view('layouts/header/user', $data);
		$this->load->view('user/pengajuan/gaji', $data);
		$this->load->view('layouts/footer', $data);
	}

	public function insert_gaji($id_pengajuan)
	{
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

		if (!is_dir('assets/pengajuan/'.$id_pengajuan)) {
			mkdir('assets/pengajuan/' . $id_pengajuan, 0700, TRUE);
		}
		if (isset($_FILES['spjtm']) && $_FILES['spjtm']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Surat Pernyataan Tanggung Jawab Mutlak (SPJTM)-'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('spjtm')) {
				$spjtm = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['spmk']) && $_FILES['spmk']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Surat Perintah Mulai Kerja (SPMK)'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('spmk')) {
				$spmk = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['spk']) && $_FILES['spk']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Surat Perintah Kerja (SPK)'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('spk')) {
				$spk = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['sppjl']) && $_FILES['sppjl']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Surat Penunjukan Penyedia Jasa Lainnya'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('sppjl')) {
				$sppjl = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['bahpl']) && $_FILES['bahpl']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Berita Acara Hasil Pengadaan Langsung'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('bahpl')) {
				$bahpl = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['baktnb']) && $_FILES['baktnb']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Berita Acara Klarifikasi Teknis Dan Negosiasi Biaya'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('baktnb')) {
				$baktnb = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['lampiran_ba']) && $_FILES['lampiran_ba']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Lampiran Berita Acara'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('lampiran_ba')) {
				$lampiran_ba = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['baedp']) && $_FILES['baedp']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Berita Acara Evaluasi Dokumen Penawaran (BAEDP)'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('baedp')) {
				$baedp = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['sdp']) && $_FILES['sdp']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Staff Development Program (SDP)'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('sdp')) {
				$sdp = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['undangan']) && $_FILES['undangan']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Undangan'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('undangan')) {
				$undangan = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['ijazah']) && $_FILES['ijazah']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Ijazah'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('ijazah')) {
				$ijazah = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['cv']) && $_FILES['cv']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Curriculum Vitae (CV)'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('cv')) {
				$cv = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['transkrip']) && $_FILES['transkrip']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Transkrip'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('transkrip')) {
				$transkrip = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		if (isset($_FILES['sertifikat_keahlian']) && $_FILES['sertifikat_keahlian']['name']) {
			$config['upload_path']   = './assets/pengajuan/'.$id_pengajuan;
			$config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
			$config['max_size']      = 2000;
			$config['file_name']     = 'Sertifikat Keahlian'.time();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('sertifikat_keahlian')) {
				$sertifikat_keahlian = $this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'spjtm' => $spjtm ?? '',
			'spmk' => $spmk ?? '',
			'spk' => $spk ?? '',
			'sppjl' => $sppjl ?? '',
			'bahpl' => $bahpl ?? '',
			'baktnb' => $baktnb ?? '',
			'lampiran_ba' => $lampiran_ba ?? '',
			'baedp' => $baedp ?? '',
			'sdp' => $sdp ?? '',
			'undangan' => $undangan ?? '',
			'ijazah' => $ijazah ?? '',
			'cv' => $cv ?? '',
			'transkrip' => $transkrip ?? '',
			'sertifikat_keahlian' => $sertifikat_keahlian ?? '',
		];
		// var_dump($data);
		// die();
		//update data into database table. 
		$this->db->where('id_pengajuan', $id_pengajuan);
		$this->db->update('pengajuan', array_filter($data));
		$this->session->set_flashdata('notification', [
			'status' => 'success',
			'message' => 'Berhasil mengupload berkas'
		]);
		redirect('User/pengajuan_user');
	}
}
