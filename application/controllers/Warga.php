<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
 public function index()
 {
  $session_user = $this->session->userdata('id_user');
  $session_level = $this->session->userdata('level');
  $query_warga = $this->M_warga->getWarga();
  $data['profiel'] = $query_warga;
  $this->load->view('headfoot/header', $data);
  $this->load->view('warga/index');
  $this->load->view('headfoot/footer');
 }

 public function profiel()
 {
  $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
  $this->form_validation->set_rules('nik', 'Nik', 'required|trim');
  $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
  $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
  $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
  $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
  if ($this->form_validation->run() == false) {
   $query_warga = $this->M_warga->getWarga();
   $data['profiel'] = $query_warga;
   $this->load->view('headfoot/header', $data);
   $this->load->view('warga/profiel', $data);
   $this->load->view('headfoot/footer');
  } else {
   //jika ada file upload
   $foto = $_FILES['foto']['name'];
   if ($foto) {
    $config['upload_path'] = './public/profiel/';
    $config['allowed_types'] = 'jpeg|jpg|png';
    $config['max_size']     = '1000';
    $this->load->library('upload', $config);
    //lakukan upload
    if ($this->upload->do_upload('foto')) {
     $data['profiel'] = $this->M_warga->getWarga();
     $foto_lama =   $data['profiel']['foto'];
     if ($foto_lama != 'user.png') {
      unlink(FCPATH . './public/profiel/' . $foto_lama);
     }
     $new_image = $this->upload->data('file_name');
     $this->M_warga->updateProfiel($new_image);
    } else {
     $this->session->set_flashdata('pesan', 'gagal');
     redirect('warga/profiel');
    }
   }
   // insert data
   $this->M_warga->updateProfiel();
   $this->session->set_flashdata('pesan', 'Diupdate');
   redirect('warga/profiel');
  }
 }

 public function rubahPassword()
 {
  $this->form_validation->set_rules('passwordlama', 'Password Lama', 'required|trim');
  $this->form_validation->set_rules('passwordbaru', 'Password Baru', 'trim|required|matches[passwordkon]|min_length[3]');
  $this->form_validation->set_rules('passwordkon', 'Konfirmasi Password', 'trim|required|matches[passwordbaru]|min_length[3]');
  if ($this->form_validation->run() == false) {
   $query_warga = $this->M_warga->getWarga();
   $data['profiel'] = $query_warga;
   $this->load->view('headfoot/header', $data);
   $this->load->view('warga/profiel', $data);
   $this->load->view('headfoot/footer');
  } else {
   // berhasil validasi
   // cek password
   $query_warga = $this->M_warga->getWarga();
   $data['profiel'] = $query_warga;
   $pw_lama = $this->input->post('passwordlama');
   $pw_baru = $this->input->post('passwordbaru');
   if (!password_verify($pw_lama, $data['profiel']['password'])) {
    $this->session->set_flashdata('pesan', 'pwsalah');
    redirect('warga/profiel');
   } else {
    // cek pw lama dan pw baru sama
    if ($pw_lama == $pw_baru) {
     $this->session->set_flashdata('pesan', 'pwsama');
     redirect('warga/profiel');
    } else {
     // pw ok
     $password_hash = password_hash($pw_baru, PASSWORD_DEFAULT);
     $this->db->set('password', $password_hash);
     $this->db->where('id_user', $this->session->userdata('id_user'));
     $this->db->update('user');
     $this->session->set_flashdata('pesan', 'Diupdate');
     redirect('warga/profiel');
    }
   }
  }
 }
}
