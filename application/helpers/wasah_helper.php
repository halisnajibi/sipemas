<?php
function cek_login()
{
 $ci = get_instance();
 $id_user = $ci->session->userdata('id_user');
 //cek login atau belum
 if (!$ci->session->userdata('id_user')) {
  redirect('auth');
 }
}
