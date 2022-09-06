<?php

class M_auth extends CI_Model
{
 public function insertReg()
 {
  $data = [
   'email' => $this->input->post('email'),
   'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
   'level' => 'warga',
   'aktif' => 0,
   'dibuat' => time()
  ];
  $this->db->insert('user', $data);
 }

 public function insertBiodata()
 {
  $email = $this->input->post('email');
  $rowUser = $this->db->get_where('user', ['email' => $email])->row_array();
  $id_user = $rowUser['id_user'];
  $data = [
   'nama' => $this->input->post('name'),
   'nik' => $this->input->post('nik'),
   'jk' => $this->input->post('jk'),
   'tanggal_lahir' => $this->input->post('tanggal_lahir'),
   'tempat_lahir' => $this->input->post('tempat_lahir'),
   'agama' => $this->input->post('agama'),
   'pekerjaan' => $this->input->post('pekerjaan'),
   'status_kawin' => $this->input->post('sp'),
   'rt' => $this->input->post('rt'),
   'id_user' =>  $id_user
  ];
  $this->db->insert('tbl_penduduk', $data);
 }

 // login
 public function login()
 {
  $email = $this->input->post('email');
  $password = $this->input->post('password');
  return $this->db->get_where('user', ['email' => $email])->row_array();
 }
}
