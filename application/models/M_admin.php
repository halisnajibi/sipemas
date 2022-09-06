<?php
class M_admin extends CI_Model
{
 public function getAdmin()
 {
  return $this->db->get('tbl_admin')->row_array();
 }

 public function updateProfiel($foto = null)
 {
  $id = $this->input->post('id_user');
  $data = [
   'nama' => $this->input->post('nama'),
   'tanggal_lahir' => $this->input->post('tanggal_lahir'),
   'tempat_lahir' => $this->input->post('tempat_lahir'),
   'alamat' => $this->input->post('alamat')
  ];
  $this->db->where('id_user', $id);
  $this->db->update('tbl_admin', $data);
  if ($foto != null) {
   $data = [
    'nama' => $this->input->post('nama'),
    'tanggal_lahir' => $this->input->post('tanggal_lahir'),
    'tempat_lahir' => $this->input->post('tempat_lahir'),
    'alamat' => $this->input->post('alamat'),
    'foto' => $foto
   ];
   $this->db->where('id_user', $id);
   $this->db->update('tbl_admin', $data);
  }
 }
}
