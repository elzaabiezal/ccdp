<?php

interface BuatKodeBuku
{
    public function buatKode();
}

class BuatKodeBukuUrut implements BuatKodeBuku
{
    public function buatKode()
    {
        $carikode = mysqli_query($koneksi,"SELECT id_buku FROM tb_buku order by id_buku desc");
        $datakode = mysqli_fetch_array($carikode);
        $kode = $datakode['id_buku'];
        $urut = substr($kode, 1, 3);
        $tambah = (int) $urut + 1;

        if (strlen($tambah) == 1){
            $format = "B"."00".$tambah;
        }else if (strlen($tambah) == 2){
            $format = "B"."0".$tambah;
        }else (strlen($tambah) == 3){
            $format = "B".$tambah;
        }

        return $format;
    }
}

class BuatKodeBukuRandom implements BuatKodeBuku
{
    public function buatKode()
    {
        $format = 'B'.rand(100, 999);
        return $format;
    }
}

$kodeBuku = new BuatKodeBukuUrut();
$id_buku = $kodeBuku->buatKode();

?>

<section class="content-header">
  <ol class="breadcrumb">
    <li>
      <a href="index.php">
        <i class="fa fa-home"></i>
        <b>Si Perpustakaan</b>
      </a>
    </li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Buku</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label>ID Buku</label>
              <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $id_buku; ?>"
               readonly/>
            </div>

            <div class="form-group">
              <label>Judul Buku</label>
              <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku">
            </div>

            <div class="form-group">
              <label>Pengarang</label>
              <input type="text" name="pengarang" id="pengarang" class="form-control" placeholder="Nama Pengarang">
            </div>

            <div class="form-group">
              <label>Penerbit</label>
              <input type="text" name="penerbit" id="penerbiit" class="form-control" placeholder="Penerbit">
            </div>

            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="number" name="th_terbit" id="th_terbit" class="form-control" placeholder="Tahun Terbit">
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=MyApp/data_buku" class="btn btn-warning">Batal</a>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>