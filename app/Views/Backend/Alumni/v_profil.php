<div class="container-fluid">
  <!-- Row -->
  <div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="card-body profile-card">
          <center> <img src="/alumni/<?= $alumni['foto'] ?>" class="rounded-circle" width="200" height="200" />
            <h4 class="card-title m-t-10"> <?= $alumni['nama'] ?> </h4>
            <div class="row text-center justify-content-center">
              <div class="col-8">
                <p class="link">
                  <i class="mdi mdi-account-card-details" aria-hidden="true"></i>
                  <span><?= $alumni['nim'] ?></span>
                </p>
              </div>
            </div>
          </center>
        </div>
      </div>
    </div>
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal form-material" action="/backend/alumni/profil/update/<?= $alumni['id_alumni'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-md-12 mb-0">Nama</label>
              <div class="col-md-12">
                <input type="text" placeholder="Nama" class="form-control pl-0 form-control-line" name="nama" value="<?= $alumni['nama'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Foto</label>
              <div class="col-md-12">
                <input type="file" name="foto" class="form-control pl-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Ubah Profil</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Column -->
  </div>
</div>
<script src="/template/sweetalert/sweetalert2.all.min.js"></script>
<!--Sweet Alert Message-->
<?php if (session()->get('pesan') == 'success') : ?>
  <script>
    Swal.fire({
      title: 'Sukses',
      text: 'Data Berhasil Dirubah',
      icon: 'success'
    })
  </script>
<?php endif; ?>