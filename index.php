<?php

include 'connection.php';
include "function.php";

if (isset($_GET['delete']))
{
  deleteSiswa($_GET);
  header('Location: index.php');
}

if (isset($_POST['simpan']))
{
  inputData($_POST);
  header('Location: index.php');
}

if (isset($_POST['search']))
{


    $filter=$db->quote($_POST['search']);

    $name=$_POST['search'];

    $search=$db->prepare("select * from siswa where id_siswa=? or nama_siswa=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,PDO::PARAM_STR);
    $search->bindValue(3,$name,PDO::PARAM_STR);
    $search->bindValue(4,$name,PDO::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll();

    $row = $search->rowCount();

} else {
  $data = $db->query('select * from siswa');

  $tampil_data = $data->fetchAll();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <title>tes minggu ke 7</title>
</head>
<body>

<h2 class="text-center"><i>DAFTAR SISWA</i></h2>

<div class="container">
    <div class="row">
        <div class="col">

            <!-- Allert Massage -->
            <?php if(isset($row)):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p class="lead "><?php echo $row;?> Data Ditemukan !</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <form class="form-inline" action="index.php" method="POST">
                <div class="form-group mx-sm-3 mb-2 mt-3">
                    <input type="text" class="form-control" name="search" placeholder="nama,sekolah/motivasi">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
      </div>
</div>

  <div class="container">
    <div class="row">
      <div class="col-12">
      <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id_siswa</th>
          <th scope="col">Nama</th>
          <th scope="col">Sekolah</th>
          <th scope="col">Motivasi</th>
          <th scope="col">Menu</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach ($data_daftar as $key): ?>
        <tr>
          <td><?php echo $key['id_siswa'];?></td>
          <td><?php echo $key['nama_siswa'];?></td>
          <td><?php echo $key['sekolah'];?></td>
          <td><?php echo $key['motivasi'];?></td>
          <td><a class="btn btn-danger" data-toggle="modal" data-target="#nama_siswa"><i class="fas fa-user-minus"></i></a>  <a class="btn btn-primary" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>"><i class="fas fa-user-edit"></i></a></td>
        </tr>
          <?php endforeach; ?>
      </tbody>
      </table>
      </div>
    </div>
  </div>

<!-- pop up delete -->

<div class="modal" id="nama_siswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Pemberitahuan!!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini???</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger"><a href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?>">Hapus Data</a></button>1
      </div>
    </div>
  </div>
</div>

<!-- from input daftar -->

<div class="container">
    <h3 class="text-center"><i>TAMBAH DATA SISWA</i></h3>
    <div class="row">
        <div class="col-12">
        <form action="input.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Sekolah</label>
                    <input type="text" name="sekolah" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Motivasi</label>
                    <input type="text" name="motivasi" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">simpan</button>
            </form>
        </div>
    </div>
</div>


<!-- end from input daftar -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
</body>
</html>