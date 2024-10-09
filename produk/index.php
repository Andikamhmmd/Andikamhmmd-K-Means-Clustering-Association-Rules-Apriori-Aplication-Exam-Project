<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

// Melakukan query
$result = mysqli_query($conn, 'SELECT * FROM produk');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <a href="index.php?pg=add" class="btn btn-primary mb-3">Tambah Data Obat</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Jumlah Terjual</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($produk = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $produk['Nama_Obat'] . "</td>";
                    echo "<td>" . $produk['Harga'] . "</td>";
                    echo "<td>" . $produk['Jumlah_Terjual'] . "</td>";
                    echo "<td><a href='index.php?pg=edit&id={$produk['id']}' class='btn btn-sm btn-warning'>Edit</a> | <a href='index.php?pg=delete&id={$produk['id']}' class='btn btn-sm btn-danger'>Delete</a></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
