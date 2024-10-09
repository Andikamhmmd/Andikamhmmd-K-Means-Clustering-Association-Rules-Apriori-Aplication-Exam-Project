<?php 
// Sertakan functions.php
include_once("functions.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Transaksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="index.php">Kembali</a>
                            <br /><br />
                            
                            <?php if (isset($arrProducts) && count($arrProducts) > 0) : ?>
                                <table border="1">
                                    <tr>
                                        <td>Nama_Obat</td>
                                        <td>Quantity</td>
                                    </tr>
                                    <?php foreach ($arrProducts as $arrProduct) : ?>
                                        <tr>
                                            <td><?php echo $arrProduct['productName'] ?></td>
                                            <td><?php echo $arrProduct['quantity'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>

                            <form action="add.php" method="post" name="form1">
                                <table width="25%" border="0">
                                    <tr>
                                        <td>Product</td>
                                        <td>
                                            <select name="produk" id="produk">
                                                <?php 
                                                // Fetch all products data from $resultProduct
                                                while ($produk = mysqli_fetch_array($resultProduct)) : 
                                                ?>
                                                    <option value="<?php echo $produk['id'] ?>">
                                                        <?php echo $produk['Nama_Obat'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td><input type="number" name="quantity"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="Submit" value="Tambah"></td>
                                        <?php if (isset($arrProducts) && count($arrProducts) > 0) : ?>
                                            <td><input type="submit" name="Reset" value="Reset"></td>
                                            <td><input type="submit" name="Save" value="Save"></td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
