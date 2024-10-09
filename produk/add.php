<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Obat</h1>
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
                        <a href="index.php?pg=produk">Kembali</a>
    <br/><br/>
    
<html>
    <body>
    <form action="index.php?pg=add" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Nama Obat</td>
                <td><input type="text" name="Nama_Obat"></td>
            </tr>
            <tr> 
                <td>Harga</td>
                <td><input type="number" name="Harga"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $Nama_Obat = $_POST['Nama_Obat'];
        $Harga = (int)$_POST['Harga'];

        // Membuat koneksi ke database
include_once(__DIR__ . "/../conn.php");

        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO produk (Nama_Obat,Harga) VALUES('$Nama_Obat','$Harga')");

        // Show message when user added
        echo "User added successfully. <a href='index.php?pg=produk'>View Product</a>";
    }
    ?>
        
    </body>
</html>


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
