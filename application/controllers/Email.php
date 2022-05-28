<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_admin')) {
            redirect('login');
        }
        $this->load->model('M_duk');
        $this->load->model('M_pegawai');
    }

    public function mail()
    {
        $id = $this->uri->segment(3);
        $data['pegawai'] = $this->M_pegawai->getPegawaiById($id);
        $data['duk'] = $this->M_duk->getDataDukById($id);

        $this->form_validation->set_rules('email', 'email', 'xss_clean|required');
        $this->form_validation->set_rules('subject', 'subject', 'xss_clean|required');
        $this->form_validation->set_rules('pesan', 'pesan', 'xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            $data['sidebar'] = "#mn1";
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/mail/mail', $data);
            $this->load->view('layouts/footer', $data);
        } else {

            $data = [
                'email' => htmlspecialchars($this->input->post('emial', true)),
                'subject' => htmlspecialchars($this->input->post('subject', true)),
                'pesan' => htmlspecialchars($this->input->post('pesan', true))
            ];

            $this->_sendEmail();

            $this->session->set_flashdata('email', 'Dikirim');
            redirect('home');
        }
    }

    private function _sendEmail()
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'disnakkeswan.riau@gmail.com',
            'smtp_pass' => 'tanyakadis',
            'smtp_port' =>  465,
            'mailtype'  => 'text',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('disnakkeswan.riau@gmail.com', 'Dinas Pertenakan dan Kesehatan Hewan Provinsi Riau');
        $this->email->to($this->input->post('email'));
        $this->email->subject($this->input->post('subject'));
        $this->email->message($this->input->post('pesan'));

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }



    public function mail1()
    {
        $id = $this->uri->segment(3);
        $data['pegawai'] = $this->M_pegawai->getPegawaiById($id);
        $data['duk'] = $this->M_duk->getDataDukById($id);

        $this->form_validation->set_rules('email', 'email', 'xss_clean|required');
        $this->form_validation->set_rules('subject', 'subject', 'xss_clean|required');
        $this->form_validation->set_rules('pesan', 'pesan', 'xss_clean|required');

        if ($this->form_validation->run() == FALSE) {
            $data['sidebar'] = "#mn1";
            $this->load->view('layouts/header/admin');
            $this->load->view('admin/mail/mail1', $data);
            $this->load->view('layouts/footer', $data);
        } else {

            $data = [
                'email' => htmlspecialchars($this->input->post('emial', true)),
                'subject' => htmlspecialchars($this->input->post('subject', true)),
                'pesan' => htmlspecialchars($this->input->post('pesan', true))
            ];

            $this->_sendEmail();

            $this->session->set_flashdata('email', 'Dikirim');
            redirect('home');
        }
    }
}
