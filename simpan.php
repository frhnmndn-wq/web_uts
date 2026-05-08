<?php
include 'koneksi.php'; // Baris ini wajib ada di paling atas

$id     = $_POST['id'];
$nama   = $_POST['nama_produk'];
$harga  = $_POST['harga'];
$stok   = $_POST['stok'];
$foto   = $_FILES['foto']['name'];

// Folder tujuan upload
$target_folder = "uploads/";

if ($foto != "") {
    $ekstensi_boleh = array('png', 'jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    
    // Memberi nama unik agar tidak bentrok
    $nama_baru = time() . '-' . $foto;

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
        // PROSES PEMINDAHAN FILE KE FOLDER UPLOADS
        move_uploaded_file($file_tmp, $target_folder . $nama_baru);
        
        if ($id == "") {
            // Jika ID kosong = Tambah Data Baru
            $query = "INSERT INTO produk (nama_produk, harga, stok, foto) VALUES ('$nama', '$harga', '$stok', '$nama_baru')";
        } else {
            // Jika ID ada = Edit Data Lama
            $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', foto='$nama_baru' WHERE id='$id'";
        }
    }
} else {
    // Jika tidak ada foto baru yang diunggah saat Edit
    $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
}
$result = mysqli_query($conn, $query);
if($result) {
    echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>