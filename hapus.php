<?php
include 'koneksi.php';

$id = $_GET['id'];

// 1. Ambil nama file foto dari database sebelum datanya dihapus
$cari_foto = mysqli_query($conn, "SELECT foto FROM produk WHERE id='$id'");
$data = mysqli_fetch_array($cari_foto);
$nama_foto = $data['foto'];

// 2. Hapus file fisik di folder uploads
if (file_exists("uploads/" . $nama_foto)) {
    unlink("uploads/" . $nama_foto);
}

// 3. Hapus data di database
$query = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

if($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location='index.php';</script>";
}
?>