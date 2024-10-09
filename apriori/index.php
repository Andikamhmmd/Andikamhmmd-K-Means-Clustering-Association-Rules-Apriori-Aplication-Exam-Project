<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

$result = mysqli_query($conn, "SELECT * FROM order_items INNER JOIN produk ON order_items.product_id = produk.id INNER JOIN orders ON order_items.order_id = orders.id ORDER BY order_items.order_id");

$new_array = array();
while ($transaction = mysqli_fetch_assoc($result)) {
    $new_array[$transaction['order_id']][] = $transaction['Nama_Obat'];
}

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Association\Apriori;

$associator = new Apriori();
$associator->train($new_array, []);

$aprioriTable = $associator->getRules();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Association Rules Apriori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Antecedent</th>
                                            <th>Consequent</th>
                                            <th>Support</th>
                                            <th>Confidence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($aprioriTable as $aprioriRow) : ?>
                                            <tr>
                                                <td>
                                                    <?php foreach ($aprioriRow['antecedent'] as $antecedent) : ?>
                                                        <?php echo $antecedent . " | "; ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($aprioriRow['consequent'] as $consequent) : ?>
                                                        <?php echo $consequent . " | "; ?>
                                                    <?php endforeach ?>
                                                </td>
                                                <td><?php echo round($aprioriRow['support'] * 100) . "%"; ?></td>
                                                <td><?php echo round($aprioriRow['confidence'] * 100) . "%"; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>




<?php
// Kode sebelumnya ...

// Menginisialisasi variabel untuk menyimpan aturan dengan confidence tertinggi
$highestConfidenceRules = [];

// Melakukan iterasi melalui aturan asosiasi untuk mencari confidence tertinggi
$highestConfidence = 0;
foreach ($aprioriTable as $aprioriRow) {
    if ($aprioriRow['confidence'] > $highestConfidence) {
        $highestConfidence = $aprioriRow['confidence'];
        $highestConfidenceRules = [$aprioriRow];
    } elseif ($aprioriRow['confidence'] == $highestConfidence) {
        $highestConfidenceRules[] = $aprioriRow;
    }
}

?>

<!-- Kode HTML untuk menampilkan tabel dengan aturan berconfidence tertinggi -->
<div class="content-wrapper">
    <!-- Kode HTML sebelumnya ... -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Tambahkan judul atau informasi tambahan di sini jika perlu -->
                            <h3 class="m-0">Confidence Tertinggi</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Antecedent</th>
                                        <th>Consequent</th>
                                        <th>Support</th>
                                        <th>Confidence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($highestConfidenceRules as $aprioriRow) : ?>
                                        <tr>
                                            <td>
                                                <?php foreach ($aprioriRow['antecedent'] as $antecedent) : ?>
                                                    <?php echo $antecedent . " | "; ?>
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                <?php foreach ($aprioriRow['consequent'] as $consequent) : ?>
                                                    <?php echo $consequent . " | "; ?>
                                                <?php endforeach ?>
                                            </td>
                                            <td><?php echo round($aprioriRow['support'] * 100) . "%"; ?></td>
                                            <td><?php echo round($aprioriRow['confidence'] * 100) . "%"; ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Keterangan tentang aturan asosiasi -->
            <div class="row">
    <div class="col-12">
        <div class="card bg-dark">
            <div class="card-body">
                <?php $counter = 1; ?>
                <?php foreach ($highestConfidenceRules as $aprioriRow) : ?>
                    <?php
                    $antecedent = implode(", ", $aprioriRow['antecedent']);
                    $consequent = implode(", ", $aprioriRow['consequent']);
                    ?>
                    <p class="text-white"><strong>Keterangan <?php echo $counter; ?>:</strong> Jika membeli <?php echo $antecedent; ?>, maka kemungkinan besar akan membeli <?php echo $consequent; ?>.</p>
                    <?php $counter++; ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

