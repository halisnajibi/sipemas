<main id="main" class="main">
 <div class="pagetitle">
  <h1>Profile</h1>
  <nav>
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Profile</li>
   </ol>
  </nav>
 </div>
 <section class="section profile">
  <div class="row">
   <div class="col-xl-4">
    <div class="card">
     <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
      <img src="<?= base_url('public/profiel/' . $profiel['foto']) ?>" alt="Profile" class="rounded-circle">
      <h2><?= ucwords($profiel['nama'])  ?></h2>
      <h3><?= ucfirst($profiel['level'])  ?></h3>
     </div>
     <div class="flash-data-profiel" data-pesan="<?= $this->session->flashdata('pesan') ?>"></div>
    </div>
   </div>
   <div class="col-xl-8">
    <div class="card">
     <div class="card-body pt-3">
      <ul class="nav nav-tabs nav-tabs-bordered">
       <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Saya</button></li>
       <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button></li>
       <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button></li>
      </ul>
      <div class="tab-content pt-2">
       <div class="tab-pane fade show active profile-overview" id="profile-overview">
        <h5 class="card-title">Profile Saya</h5>
        <div class="row">
         <div class="col-lg-3 col-md-4 label ">Nama</div>
         <div class="col-lg-9 col-md-8"><?= $profiel['nama'] ?></div>
        </div>
        <div class="row">
         <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
         <div class="col-lg-9 col-md-8"><?= $profiel['tanggal_lahir'] ?></div>
        </div>
        <div class="row">
         <div class="col-lg-3 col-md-4 label">Tempat Lahir</div>
         <div class="col-lg-9 col-md-8"><?= $profiel['tempat_lahir'] ?></div>
        </div>
        <div class="row">
         <div class="col-lg-3 col-md-4 label">Alamat</div>
         <div class="col-lg-9 col-md-8"><?= $profiel['alamat'] ?></div>
        </div>
       </div>
       <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
        <form method="post" enctype="multipart/form-data">
         <input type="hidden" name="id_user" value="<?= $profiel['id_user'] ?>">
         <div class="row mb-3">
          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
          <div class="col-md-8 col-lg-9">
           <input name="nama" type="text" class="form-control" id="fullName" value="<?= $profiel['nama'] ?>">
           <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="row mb-3">
          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
          <div class="col-md-8 col-lg-9">
           <input name="tanggal_lahir" type="date" class="form-control" id="fullName" value="<?= $profiel['tanggal_lahir'] ?>">
           <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="row mb-3">
          <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir</label>
          <div class="col-md-8 col-lg-9">
           <input name="tempat_lahir" type="text" class="form-control" id="fullName" value="<?= $profiel['tempat_lahir'] ?>">
           <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="row mb-3">
          <label for="about" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
          <div class="col-md-8 col-lg-9"><textarea name="alamat" class="form-control" id="about" style="height: 100px"><?= $profiel['alamat'] ?></textarea></div>
         </div>
         <div class="row mb-3">
          <label for="about" class="col-md-4 col-lg-3 col-form-label">Foto</label>
          <div class="col-md-8 col-lg-9">
           <input class="form-control" type="file" id="formFile" name="foto">
           <small class="text-danger pl-3" style="font-size: 12px;">*</small><br>
           <small class="text-danger pl-3" style="font-size: 12px;">PNG,JPG,JPEG</small><br>
           <small class="text-danger pl-3" style="font-size: 12px;">1 MB</small>
          </div>
         </div>

         <div class="text-center"> <button type="submit" class="btn btn-primary">Simpan</button></div>
        </form>
       </div>
       <div class="tab-pane fade pt-3" id="profile-change-password">
        <form method="POST" action="<?= base_url('admin/rubahPassword') ?>">
         <div class="row mb-3">
          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Email</label>
          <div class="col-md-8 col-lg-9"> <input name="email" type="text" class="form-control" id="currentPassword" value="<?= $profiel['email'] ?>" readonly>

          </div>
         </div>
         <div class="row mb-3">
          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
          <div class="col-md-8 col-lg-9"> <input name="passwordlama" type="password" class="form-control" id="currentPassword">
           <?= form_error('passwordlama', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="row mb-3">
          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
          <div class="col-md-8 col-lg-9"> <input name="passwordbaru" type="password" class="form-control" id="newPassword">
           <?= form_error('passwordbaru', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="row mb-3">
          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password</label>
          <div class="col-md-8 col-lg-9"> <input name="passwordkon" type="password" class="form-control" id="renewPassword">
           <?= form_error('passwordkon', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
         </div>
         <div class="text-center"> <button type="submit" class="btn btn-primary">Simpan</button></div>
        </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
</main>