<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

// Fetch all transaction data from the database
$query = "SELECT produk.Nama_Obat, order_items.quantity
          FROM order_items
          INNER JOIN produk ON order_items.product_id = produk.id
          INNER JOIN orders ON order_items.order_id = orders.id
          ORDER BY order_items.order_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <a href="add.php" class="btn btn-primary mb-3">Tambah Data Transaksi</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Obat</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Nama_Obat'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "</tr>";
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
