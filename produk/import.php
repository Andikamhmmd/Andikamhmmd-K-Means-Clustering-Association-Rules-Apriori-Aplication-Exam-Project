<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

// Function to insert data into the MySQL database
function insertData($conn, $nama_Obat, $harga)
{
    // Do not include the 'id' column in the INSERT statement
    $sql = "INSERT INTO produk (Nama_Obat, Harga) VALUES ('$nama_Obat', '$harga')";
    $result = $conn->query($sql);

    if (!$result) {
        error_log("Insert query failed: " . mysqli_error($conn));
        die("Insert query failed: " . mysqli_error($conn));
    }
}

// Check if form is submitted for product import
if (isset($_POST['submit'])) {
    // Path to the uploaded CSV file
    $csvFilePath = $_FILES['file']['tmp_name'];

    // Open the CSV file
    if (($handle = fopen($csvFilePath, "r")) !== false) {
        // Read each row of data from the CSV file
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Call the function to insert data into the database
            insertData($conn, $data[0], $data[1]);
        }
        fclose($handle); // Close the CSV file after reading
    } else {
        error_log("Failed to open CSV file: $csvFilePath");
    }

    // Close the database connection
    $conn->close();

    // Redirect to the product page after successfully importing data
    header("Location: index.php");
    exit(); // Important to ensure no other output after header() is executed
}
?>
