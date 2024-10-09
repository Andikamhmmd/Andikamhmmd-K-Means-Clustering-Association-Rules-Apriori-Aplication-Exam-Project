<?php
// Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_POST['id'];

    $Nama_Obat=$_POST['Nama_Obat'];
    $Harga=$_POST['Harga'];

    // update user data
    $result = mysqli_query($conn, "UPDATE produk SET Nama_Obat='$Nama_Obat',Harga='$Harga' WHERE id=$id");

    // Check if the update was successful
    if($result) {
        echo "<script>window.location.href='index.php?pg=produk';</script>";
        exit; // Pastikan untuk keluar setelah redirect
    } else {
        echo "Update failed.";
    }
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");

while($produk = mysqli_fetch_array($result))
{
    $Nama_Obat = $produk['Nama_Obat'];
    $Harga = $produk['Harga'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Obat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">K-Means Clustering</li>
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
                        <a href="index.php?pg=produk">Kembali</a>
    <br/><br/>

    <form name="update_produk" method="post" action="index.php?pg=edit">
        <table border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="Nama_Obat" value=<?php echo $Nama_Obat;?>></td>
            </tr>
            <tr> 
                <td>Harga</td>
                <td><input type="number" name="Harga" value=<?php echo $Harga;?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
                            <div class="card-tools">
                                
                                
                            </div>
                        </div>
                    </div>

                        <!-- ... -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

