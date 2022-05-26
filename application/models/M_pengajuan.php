<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengajuan extends CI_Model
{

    public function getAllPengajuan()
    {
        return $this->db->get('pengajuan')->result_array();
    }

    public function hapusPengajuan($id)
    {
        $this->db->where('id_pengajuan', $id);
        $this->db->delete('pengajuan');
    }

    public function getPengajuanById($id)
    {
        return $this->db->get_where('pengajuan', ['id_pengajuan' => $id])->row_array();
    }
}
