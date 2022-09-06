<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

 // cek login
 public function __construct()
 {
  parent::__construct();
  cek_login();
 }


 public function index()
 {
  $session_user = $this->session->userdata('id_user');
  $session_level = $this->session->userdata('level');
  $query_admin = $this->M_admin->getAdmin();
  $data['level'] = $session_level;
  $data['profiel'] = $query_admin;
  $this->load->view('headfoot/header', $data);
  $this->load->view('admin/index', $data);
  $this->load->view('headfoot/footer');
 }

 public function profiel()
 {
  $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
  $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
  $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
  $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
  if ($this->form_validation->run() == false) {
   $session_user = $this->session->userdata('id_user');
   $session_level = $this->session->userdata('level');
   $query_admin = $this->M_admin->getAdmin();
   $data['level'] = $session_level;
   $data['profiel'] = $query_admin;
   $this->load->view('headfoot/header', $data);
   $this->load->view('admin/profiel', $data);
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
     $session_user = $this->session->userdata('id_user');
     $session_level = $this->session->userdata('level');
     $data['profiel'] = $this->M_admin->getAdmin();
     $foto_lama =   $data['profiel']['foto'];
     if ($foto_lama != 'user.png') {
      unlink(FCPATH . './public/profiel/' . $foto_lama);
     }
     $new_image = $this->upload->data('file_name');
     $this->M_admin->updateProfiel($new_image);
    } else {
     $this->session->set_flashdata('pesan', 'gagal');
     redirect('admin/profiel');
    }
   }
   // insert data
   $this->M_admin->updateProfiel();
   $this->session->set_flashdata('pesan', 'Diupdate');
   redirect('admin/profiel');
  }
 }

 public function rubahPassword()
 {
  $this->form_validation->set_rules('passwordlama','Password Lama','required|trim|')
 }
}
