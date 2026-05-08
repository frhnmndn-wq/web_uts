<?php 
include 'koneksi.php';
$id = ""; $nama = ""; $harga = ""; $stok = ""; $foto = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
    $data = mysqli_fetch_array($sql);
    $nama = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2><?php echo $id ? "Edit Produk" : "Tambah Produk"; ?></h2>
        <form action="simpan.php" method="POST" enctype="multipart/form-data" id="produkForm">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" id="nama" value="<?php echo $nama; ?>">
            
            <label>Harga</label>
            <input type="number" name="harga" id="harga" value="<?php echo $harga; ?>">
            
            <label>Stok</label>
            <input type="number" name="stok" id="stok" value="<?php echo $stok; ?>">
            
            <label>Foto Produk (Maks 2MB)</label>
            <input type="file" name="foto" id="foto">
            <?php if($id) echo "<p style='font-size:12px;'>*Kosongkan jika tidak ingin ganti foto</p>"; ?>

            <button type="submit" class="btn btn-add" style="width:100%; margin-top:20px;">Simpan Data</button>
            <a href="index.php" style="display:block; text-align:center; margin-top:10px; color:#777;">Kembali</a>
        </form>
    </div>

    <script>
    document.getElementById('produkForm').onsubmit = function(e) {
        let nama = document.getElementById('nama').value;
        let foto = document.getElementById('foto');
        let id = "<?php echo $id; ?>";

        if(nama == "" || document.getElementById('harga').value == "") {
            alert("Semua field wajib diisi!");
            return false;
        }
        
        if(foto.files.length > 0) {
            let fileSize = foto.files[0].size / 1024 / 1024; // MB
            let fileName = foto.files[0].name.split('.').pop().toLowerCase();
            let allowed = ['jpg', 'jpeg', 'png'];

            if(!allowed.includes(fileName)) {
                alert("Format file harus JPG, JPEG, atau PNG!");
                return false;
            }
            if(fileSize > 2) {
                alert("Ukuran file maksimal 10MB!");
                return false;
            }
        } else if (id == "") {
            alert("Foto wajib diunggah untuk data baru!");
            return false;
        }
    };
    </script>
</body>
</html>