<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:../userlogin.php');
    exit;
}
include('../include/header.php');
include('../include/navbar.php');
include('../include/sidebar.php');
include('../config/conn.php');

?>
<?php
$dataQuery = "SELECT * FROM messages";
$dataResult = mysqli_query($conn, $dataQuery);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">See Message</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">See Message</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($dataResult) > 0) {
                        while ($row = mysqli_fetch_assoc($dataResult)) {
                            echo "<tr>
                            <td>{$row['email']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['message']}</td>
                           
                          </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div><br>

</div>




<?php
include('../include/footer.php');
?>