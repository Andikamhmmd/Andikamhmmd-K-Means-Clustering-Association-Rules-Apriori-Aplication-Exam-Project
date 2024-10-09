<?php
// functions.php

// Include database connection
include_once(__DIR__ . "/../conn.php");

// Fetch all product data from the database
$resultProduct = mysqli_query($conn, "SELECT * FROM `produk`");

// Retrieve the latest order ID or initialize it if not set
$orderId = isset($_COOKIE['orderId']) ? (int)$_COOKIE['orderId'] : 0;
// Initialize an empty array for storing selected products
$arrProducts = isset($_COOKIE['arrProducts']) ? unserialize($_COOKIE['arrProducts']) : [];

// If no order ID is set, retrieve the latest one from the database
if ($orderId == 0) {
    $resultId = mysqli_query($conn, "SELECT orders.id FROM `orders` ORDER BY id DESC LIMIT 1");
    $orderId = (int)mysqli_fetch_array($resultId)['id'] + 1;
}

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Logic for handling form submission
    if (isset($_POST['Submit'])) {
        // Process form data
        $productId = (int)$_POST['produk'];
        $quantity = (int)$_POST['quantity'];

        // Fetch product name based on selected product ID
        $productName = '';
        $resultProductName = mysqli_query($conn, "SELECT Nama_Obat FROM `produk` WHERE id = $productId");
        $productData = mysqli_fetch_assoc($resultProductName);
        if ($productData) {
            $productName = $productData['Nama_Obat'];
        }

        // Add the selected product and quantity to the array of products
        $arrProducts[] = ['productId' => $productId, 'quantity' => $quantity, 'productName' => $productName];

        // Store the updated order ID and array of products in cookies
        setcookie('orderId', $orderId, time() + 60);
        setcookie('arrProducts', serialize($arrProducts), time() + 60);

        // Set a flag to indicate successful submission
        $submitted = true;
    }

    // Logic for handling Reset button
    if (isset($_POST['Reset'])) {
        // Reset the array of products
        $arrProducts = [];
        // Clear the 'arrProducts' cookie
        setcookie('arrProducts', serialize($arrProducts), time() + 60);

        // Set a flag to indicate successful submission
        $reset = true;
    }
}

// Logic for handling Save button (moved outside the POST check)
if (isset($_POST['Save'])) {
    $arrProducts = [];
        setcookie('arrProducts', serialize($arrProducts), time() + 60);
    // Loop melalui array produk dan menyimpannya ke dalam database
    foreach ($arrProducts as $localProduct) {
        $productId = $localProduct['productId'];
        $quantity = $localProduct['quantity'];

        $resultOrderId = mysqli_query($conn, "INSERT INTO `orders`() VALUES ()");

        // Masukkan data produk ke dalam tabel 'order_items'
        $result = mysqli_query($conn, "INSERT INTO order_items(order_id, product_id, quantity) VALUES ('$orderId','$productId','$quantity')");
        
    }
    echo "Transaction added successfully. <a href='index.php'>View Product</a>";
        $arrProducts = [];
        $orderId = 0;
        setcookie('orderId', $orderId, time() + 60);
        setcookie('arrProducts', serialize($arrProducts), time() + 60);

    
    
}
?>
