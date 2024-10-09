<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM produk WHERE id=$id");

// Jika penghapusan berhasil, redirect menggunakan JavaScript
if ($result) {
    echo "<script>window.location.href='index.php?pg=produk';</script>";
} else {
    // Handle kesalahan jika diperlukan
    echo "Error deleting record: " . mysqli_error($conn);
}

?>