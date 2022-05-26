<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Gaji extends CI_Model {
    public function tambahDataGaji(){
        $data=[
            'golongan' => $this->input->post('gol',true),
            'masa_kerja' => $this->input->post('masa_kerja',true),
            'gaji_pokok' => $this->input->post('gaji_pokok',true)
        ];
        $this->db->insert('gaji', $data);
        
    }

    public function getAllDataGaji(){
        $this->db->order_by('gaji_pokok', 'ASC');
        return $this->db->get('gaji')->result_array();
    }
    
    public function getDataGajiById($id){
        return $this->db->get_where('gaji', ['id_gaji'=>$id])->row_array();
    }

    public function updateDataGaji(){
        $data=[
            'golongan' => $this->input->post('gol',true),
            'masa_kerja' => $this->input->post('masa_kerja',true),
            'gaji_pokok' => $this->input->post('gaji_pokok',true)
        ];
        $this->db->where('id_gaji', $this->input->post('id'), true);
        $this->db->update('gaji',$data);
    }

    public function hapusGajiPegawai($id){
        $this->db->where('id_gaji', $id);
        $this->db->delete('gaji');
    }
}