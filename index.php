<?php 
require 'function.php';
require 'cek.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sitorang-Beranda</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">SITORANG</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <h5 class="navbar-brand">Sistem Informasi Stock Barang</h5>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" target="_blank"
                            href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=sitorang">
                            Database
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Stock Barang</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="card-body">

                        <?php
                        $ambildatastock = mysqli_query($conn, "select*from stock where stock < 1");

                        while($fetch=mysqli_fetch_array($ambildatastock)){
                            $barang = $fetch['namabarang'];
                        ?>

                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Perhatian!</strong> Stock <?=$barang;?> Telah Habis Bro
                        </div>

                        <?php
                        }
                        ?>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Aksi</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select*from stock");
                                            $i = 1;
                                            while ($data=mysqli_fetch_array($ambilsemuadatastock)) {                                                
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $stock = $data['stock'];
                                                $idb = $data['idbarang'];
                                            
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$deskripsi;?></td>
                                            <td><?=$stock;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#edit<?=$idb;?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#hapus<?=$idb;?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal -->
                                        <div class="modal" id="edit<?=$idb;?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form method="post">
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <input type="text" name="namabarang"
                                                                value="<?=$namabarang;?>" class="form-control"
                                                                required><br>
                                                            <input type="text" name="deskripsi" value="<?=$deskripsi;?>"
                                                                class="form-control" required><br>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                                            <button class="btn btn-success" type="submit"
                                                                name="updatebarang">Submit</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                            </div>

                            <!-- The Modal -->
                            <div class="modal" id="hapus<?=$idb;?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Hapus Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form method="post">
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                            <h4>Apakah anda ingin menghapus barang ini?</h4>
                                            </div>
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button class="btn btn-success" type="submit"
                                                    name="hapusbarang">Submit</button>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                                            }
                                        ?>
                        </tbody>
                        </table>
                        <br>
                        <a href="export.php" class="btn btn-info">Export PDF</a>
                        <br>
                    </div>
                </div>
        </div>
    </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Ponsianus Jopi | Project PHP NATIVE | 2022</div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required><br>
                    <input type="file" name="file" class="form-control"><br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control" required><br>
                    <input type="number" name="stock" placeholder="Stock" class="form-control" required><br>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" name="addnewbarang">Submit</button>
            </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

    </div>
</div>
</div>



</html>