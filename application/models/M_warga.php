<?php

class M_warga extends CI_Model
{
 public function getWarga()
 {
  $this->db->select('*');
  $this->db->from('user');
  $this->db->join('tbl_penduduk', 'tbl_penduduk.id_user = user.id_user');
  $query = $this->db->get()->row_array();
  return $query;
 }


 public function updateProfiel($foto = null)
 {
  $id = $this->input->post('id_user');
  $data = [
   'nik' => $this->input->post('nik'),
   'nama' => $this->input->post('nama'),
   'jk' => $this->input->post('jk'),
   'tanggal_lahir' => $this->input->post('tanggal_lahir'),
   'tempat_lahir' => $this->input->post('tempat_lahir'),
   'agama' => $this->input->post('agama'),
   'pekerjaan' => $this->input->post('pekerjaan'),
   'status_kawin' => $this->input->post('status_kawin'),
   'rt' => $this->input->post('rt'),
   'alamat' => $this->input->post('alamat')
  ];
  $this->db->where('id_user', $id);
  $this->db->update('tbl_penduduk', $data);
  if ($foto != null) {
   $data = [
    'nik' => $this->input->post('nik'),
    'nama' => $this->input->post('nama'),
    'jk' => $this->input->post('jk'),
    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
    'tempat_lahir' => $this->input->post('tempat_lahir'),
    'agama' => $this->input->post('agama'),
    'pekerjaan' => $this->input->post('pekerjaan'),
    'status_kawin' => $this->input->post('status_kawin'),
    'rt' => $this->input->post('rt'),
    'alamat' => $this->input->post('alamat'),
    'foto' => $foto
   ];
   $this->db->where('id_user', $id);
   $this->db->update('tbl_penduduk', $data);
  }
 }
}
