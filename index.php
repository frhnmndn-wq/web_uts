<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk Makanan Dan Minuman</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="app-header">
            <div class="brand">
                <span class="emoji">📦</span>
                <h2>Daftar Harga dan Menu Makanan Dan Minuman</h2>
            </div>
            <a href="form.php" class="btn btn-add">+ Tambah Menu Makanan dan Minuman</a>
        </header>

        <main class="content">
            <div class="card-table-wrapper">
                <table class="table-produk">
                    <thead>
                        <tr>
                            <th>Pratinjau Foto</th>
                            <th>Nama Menu</th>
                            <th>Harga Satuan</th>
                            <th style="text-align:center;">Jumlah Stok</th>
                            <th style="text-align:center;">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menampilkan data terbaru paling atas
                        $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
                        
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="col-foto">
                                <?php 
                                    // LOGIKA PENTING UNTUK MENAMPILKAN GAMBAR
                                    $path_foto = "uploads/" . $row['foto'];
                                    
                                    // Cek apakah file benar-benar ada di folder 'uploads'
                                    if(file_exists($path_foto) && $row['foto'] != ""): 
                                ?>
                                    <img src="<?php echo $path_foto; ?>" class="thumb-produk" alt="Pratinjau <?php echo htmlspecialchars($row['nama_produk']); ?>">
                                <?php else: ?>
                                    <div class="no-image-placeholder">
                                        No<br>Image
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="col-nama">
                                <strong><?php echo htmlspecialchars($row['nama_produk']); ?></strong>
                            </td>
                            <td class="col-harga">
                                <span class="prefix-rp">Rp</span>
                                <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                            </td>
                            <td class="col-stok" style="text-align:center;">
                                <span class="badge badge-stok"><?php echo $row['stok']; ?> porsi</span>
                            </td>
                            <td class="col-aksi" style="text-align:center;">
                                <a href="form.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?php echo $row['nama_produk']; ?>?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='5' class='empty-row'>Belum ada data produk yang ditambahkan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>