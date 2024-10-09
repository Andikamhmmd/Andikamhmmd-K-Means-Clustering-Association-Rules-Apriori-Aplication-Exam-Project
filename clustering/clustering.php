<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");
$query = $conn->query("SELECT Nama_Obat, Harga, Jumlah_Terjual FROM produk");

// Masukkan hasil query ke dalam array
$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [$row['Nama_Obat'], $row['Harga'], $row['Jumlah_Terjual']];
}

// Inisialisasi centroid awal
$centroids_initial = array_slice($data, 0, 3); // Ambil tiga titik data pertama

// Implementasi algoritma k-means secara manual
$clusters_history = []; // Menyimpan history klaster pada setiap iterasi
$centroids_history = []; // Menyimpan history centroid pada setiap iterasi
$centroids = $centroids_initial;
$max_iterations = 10; // Misalnya, kita lakukan maksimal 10 iterasi

// Inisialisasi variabel untuk menyimpan total jumlah data untuk setiap kategori klaster
$total_paling_laku = 0;
$total_laku = 0;
$total_tidak_laku = 0;

for ($iter = 0; $iter < $max_iterations; $iter++) {
    $clusters = [];
    foreach ($data as $point) {
        // Hitung jarak ke setiap centroid
        $distances = [];
        foreach ($centroids as $centroid) {
            // Hitung jarak berdasarkan harga dan jumlah terjual
            $distance = sqrt(pow(($point[1] - $centroid[1]), 2) + pow(($point[2] - $centroid[2]), 2));
            $distances[] = $distance;
        }
        // Tentukan klaster dengan jarak terdekat
        $cluster = array_search(min($distances), $distances);
        $clusters[] = $cluster;
    }
    $clusters_history[] = $clusters;
    $centroids_history[] = $centroids;

    // Perbarui centroid
    $new_centroids = [];
    foreach ($centroids as $idx => $centroid) {
        $cluster_points = array_filter($data, function ($point, $cluster_idx) use ($clusters, $idx) {
            return $clusters[$cluster_idx] === $idx;
        }, ARRAY_FILTER_USE_BOTH);
        $cluster_points = array_values($cluster_points); // Reset index array
        if (!empty($cluster_points)) {
            $new_centroid = [
                $centroid[0], // Nama obat tidak berubah
                array_sum(array_column($cluster_points, 1)) / count($cluster_points), // Rata-rata harga
                array_sum(array_column($cluster_points, 2)) / count($cluster_points) // Rata-rata jumlah terjual
            ];
            $new_centroids[] = $new_centroid;

            // Update total jumlah data untuk setiap kategori klaster
            switch ($idx) {
                case 0:
                    $total_paling_laku += count($cluster_points);
                    break;
                case 1:
                    $total_tidak_laku += count($cluster_points);
                    break;
                case 2:
                    $total_laku += count($cluster_points);
                    break;
            }
        } else {
            // Jika tidak ada data dalam klaster, tetap gunakan centroid yang lama
            $new_centroids[] = $centroid;
        }
    }
    // Cek apakah centroid sudah konvergen
    if ($new_centroids === $centroids) {
        break;
    }
    $centroids = $new_centroids;
}

// Menyimpan data klaster terakhir
$clusters_final = $clusters_history[count($clusters_history) - 1];

// Menentukan jumlah cluster terakhir
$num_clusters = count(array_unique($clusters_final));

// Inisialisasi variabel untuk menyimpan total jumlah data untuk setiap kategori klaster
$total_klaster = array_fill(0, $num_clusters, 0);

// Iterasi melalui data dan hitung jumlah data untuk setiap kategori klaster
foreach ($clusters_final as $cluster) {
    $total_klaster[$cluster]++;
}

// Tampilkan centroid pada setiap iterasi
foreach ($centroids_history as $iter => $centroids_iter) {
    echo "<h3>Iterasi " . ($iter + 1) . "</h3>";
    echo "<table>";
    echo "<thead><tr><th>Centroid</th><th>Harga</th><th>Jumlah Terjual</th></tr></thead>";
    echo "<tbody>";
    foreach ($centroids_iter as $idx => $centroid) {
        echo "<tr><td>" . ($idx + 1) . "</td><td>" . $centroid[1] . "</td><td>" . $centroid[2] . "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// Tambahkan kolom 'Cluster' ke dalam array data
for ($i = 0; $i < count($data); $i++) {
    $data[$i][] = $clusters_final[$i];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dengan Klaster</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data dengan Klaster</h2>

        <h3>Centroid Terakhir:</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Centroid</th>
                    <th>Harga</th>
                    <th>Jumlah Terjual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($centroids as $idx => $centroid): ?>
                <tr>
                    <td><?php echo $idx + 1; ?></td>
                    <td><?php echo $centroid[1]; ?></td>
                    <td><?php echo $centroid[2]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tabel Keterangan -->
        <h3>Keterangan Klaster:</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Cluster</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td>Paling Laku</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Tidak Laku</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Laku</td>
                </tr>
            </tbody>
        </table>

        <h3>Hasil Cluster:</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Jumlah Terjual</th>
                    <th>Cluster</th> <!-- Kolom Cluster ditambahkan -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td> <!-- Menampilkan Cluster -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tabel Jumlah Data -->
        <h3>Hasil:</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Keterangan</th>
                    <th>Jumlah Data</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < $num_clusters; $i++): ?>
                    <tr>
                        <td>Cluster <?php echo $i; ?></td>
                        <td><?php echo $total_klaster[$i]; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
