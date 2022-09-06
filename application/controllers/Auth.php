<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
 public function index()
 {
  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'required|trim');
  if ($this->form_validation->run() == false) {
   $this->load->view('auth/index');
  } else {
   // berhasil validasi
   // lakukan login
   $this->_login();
  }
 }

 private function _login()
 {
  $password = $this->input->post('password');
  $query = $this->M_auth->login();
  if ($query  != null) {
   // jika user aktif
   if ($query['aktif'] == 1) {
    // cek password
    if (password_verify($password, $query['password'])) {
     // berhasil login
     // siapkan session
     $data = [
      'email' => $query['email'],
      'level' => $query['panah']
     ];
     $this->session->set_userdata($data);
     // lakukan redirect
     if ($query['level'] == 'admin') {
      redirect('admin');
     } else if ($query['level'] == 'kepdes') {
      redirect('kepdes');
     } else if ($query['level'] == 'sekdes') {
      redirect('sekdes');
     } else if ($query['level'] == 'rt') {
      redirect('rt');
     } else if ($query['level'] == 'warga') {
      redirect('warga');
     }
    } else {
     // password salah
     $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal login!password salah!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
     redirect('auth');
    }
   } else {
    // akun tidak aktif
    $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal login!akun belum aktif!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect('auth');
   }
  } else {
   // email tidak terdaftar
   $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal login!email tidak terdaftar!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
   redirect('auth');
  }
 }

 public function registrasi()
 {
  $email = $this->input->post('email');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
  $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|matches[password]');
  if ($this->form_validation->run() == false) {
   $this->load->view('auth/registrasi');
  } else {
   // berhasil validasi
   $this->M_auth->insertReg();
   // siapkan token untuk dikirim ke email
   $token = base64_encode(random_bytes(32));
   $user_token = [
    'email' => $email,
    'token' => $token,
    'dibuat' => time()
   ];
   $this->db->insert('user_token', $user_token);
   // kirim email
   $this->_kirimEmail(
    $token,
    'verify'
   );
   $dataSes = [
    'email' => $email
   ];
   $this->session->set_userdata($dataSes);
   $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show " role="alert"> <i class="bi bi-check-circle me-1"></i> Berhasil membikin akun !! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
   redirect('auth/biodata');
  }
 }


 private function _kirimEmail($token, $type)
 {

  // EMAIL GATEWAY // 
  $config = [
   'mailtype'  => 'html',
   'charset'   => 'utf-8',
   'protocol'  => 'smtp',
   'smtp_host' => 'smtp.gmail.com',
   'smtp_user' => 'wasahhulu2022@gmail.com',  // Email gmail 
   'smtp_pass'   => 'joqrfdovyusizeou',  // Password gmail 
   'smtp_crypto' => 'ssl',
   'smtp_port'   => 465,
   'crlf'    => "\r\n",
   'newline' => "\r\n"
  ];


  // Load library email dan konfigurasinya 
  $this->load->library('email', $config);

  // Email dan nama pengirim 
  $this->email->from('wasahhulu2022@gmail.com', 'Admin Website');

  // Email penerima 
  $this->email->to($this->input->post('email')); // Ganti dengan email tujuan 
  //cek type kegunaan
  if ($type == 'verify') {
   // Subject email 
   $this->email->subject('Verifikasi Email');
   // Isi email 
   $this->email->message('Silahkan klik link dibawah ini untuk mengaktifkan akun anda : <a href= "' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktif</a>');
  } else if ($type == 'forgot') {
   // Subject email 
   $this->email->subject('reset password');
   // Isi email 
   $this->email->message('Clik this link to reset  you password : <a href= "' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
  }
  // Tampilkan pesan sukses atau error 
  if ($this->email->send()) {
   // echo 'Sukses! email berhasil dikirim.';
  } else {
   // echo 'Error! email tidak dapat dikirim.';
  }

  // END EMAIL GATEWAY //
 }



 public function verify()
 {
  $email = $this->input->get('email');
  $token = $this->input->get('token');

  //validasi email
  $user = $this->db->get_where('user', ['email' => $email])->row_array();
  if ($user) {
   $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
   if ($user_token) {
    //cek waktu validasi account
    if (time() - $user_token['dibuat'] < (60 * 60 * 24)) {
     $this->db->set('aktif', 1);
     $this->db->where('email', $email);
     $this->db->update('user');
     $this->db->delete('user_token', ['email' => $email]);
     $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> ' . $email . ' sudah aktif ! silahkan login. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
     redirect('auth');
    } else {
     $this->db->delete('user_token', ['email' => $email]);
     $this->db->delete('user', ['email' => $email]);
     $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal aktivasi!token expired!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
     redirect('auth');
    }
   } else {
    $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal aktivasi!token salah!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect('auth');
   }
  } else {
   $this->session->set_flashdata('pesan', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
 <i class="bi bi-exclamation-octagon me-1"></i>
Gagal aktivasi!email salah!! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
   redirect('auth');
  }
 }





 public function biodata()
 {
  $this->form_validation->set_rules('name', 'Nama', 'trim|required');
  $this->form_validation->set_rules('nik', 'Nik', 'trim|required|is_unique[tbl_penduduk.nik]');
  $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
  $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
  $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
  if ($this->form_validation->run() == false) {
   $this->load->view('auth/biodata');
  } else {
   // berhasil validasi
   $this->M_auth->insertBiodata();
   $this->session->set_flashdata('flash', 'berhasil');
   redirect('auth');
  }
 }
}
