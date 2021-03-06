<style>
  /* table {
    table-layout: fixed;
    word-wrap: break-word;
  } */

  th,
  td {
    text-align: center;
  }
</style>
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <!-- column -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-md-10 col-8 align-self-center" style="margin-bottom: 10px;">
              <h4 class="card-title">Data Lowongan</h4>
            </div>
            <div class="col-md-2 col-4 align-self-right">
              <a href="/perusahaan/lowongan/tambah" class="btn btn-primary text-white mt-4" style="display: inline;">Tambah Data</a>
            </div>
          </div>
          <div class="table-responsive">
            <table id="tables" class="table user-table">
              <thead>
                <tr>
                  <th class="border-top-0">No</th>
                  <th class="border-top-0">Nama Lowongan</th>
                  <th class="border-top-0" style="width: 50%">Deskripsi Lowongan</th>
                  <th class="border-top-0">Gambar</th>
                  <th class="border-top-0">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($lowongan as $key => $hasil) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $hasil['nama_lowongan'] ?></td>
                    <td><?= $hasil['deskripsi_lowongan'] ?></td>
                    <td><img src="/lowongan/<?= $hasil['gambar'] ?>" class="rounded mx-auto d-block" width="200" height="200" /></td>
                    <td>
                      <a href="/perusahaan/lowongan/ubah/<?= $hasil['id_lowongan'] ?>" class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                      <a href="/perusahaan/lowongan/delete/<?= $hasil['id_lowongan'] ?>" class="btn btn-danger tombol-hapus"><i class="mdi mdi-delete"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/template/auth/js/jquery-3.2.1.min.js"></script>
<script src="/template/sweetalert/sweetalert2.all.min.js"></script>
<!--Sweet Alert Message-->
<script>
  $('.tombol-hapus').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Data Lowongan akan Dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
      }
    })
  })
</script>