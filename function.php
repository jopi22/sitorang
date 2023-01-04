<?php 
session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sitorang");


//menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi', '$stock')");

    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'gagal bro';
        header('location:index.php');
    }
    
}


//menerima barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select*from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya', '$keterangan', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya' ");

    if ($addtomasuk&&$updatestockmasuk) {
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
    
}


//menerima barang keluar
if (isset($_POST['barangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select*from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya', '$penerima', '$qty')");
    $updatestockkeluar = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya' ");

    if ($addtokeluar&&$updatestockkeluar) {
        header('location:keluar.php');
    } else {
        echo 'gagal';
        header('location:keluar.php');
    }
    
}


//update stock barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang ='$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
    
}


//hapus stock barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang ='$idb'");
    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
    
}

?>