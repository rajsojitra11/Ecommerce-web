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

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM product WHERE pid = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting product: " . $conn->error . "');</script>";
    }
    $stmt->close();
}

$dataQuery = "SELECT * FROM product";
$dataResult = mysqli_query($conn, $dataQuery);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Manage Product</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Details</th>
                        <th>Product Price</th>
                        <th>Product Img</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($dataResult) > 0) {
                        while ($row = mysqli_fetch_assoc($dataResult)) {
                            echo "<tr>
                            <td>{$row['productname']}</td>
                            <td>{$row['productdetails']}</td>
                            <td>{$row['productprice']}</td>
                            <td><img src='{$row['productimg']}' alt='{$row['productname']}' style='width: 100px; height: 50px;'></td>
                            <td><a href='uproduct.php?id={$row["pid"]}' class='btn btn-primary'>UPDATE</a></td>
                            <td><a href='manageproduct.php?delete_id={$row["pid"]}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\");'>DELETE</a></td>
                          </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
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