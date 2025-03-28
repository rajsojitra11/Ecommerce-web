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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data to pre-fill the form
    $editQuery = "SELECT * FROM product WHERE pid = ?";
    $stmt = $conn->prepare($editQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $editResult = $stmt->get_result();
    $editData = $editResult->fetch_assoc();
    $stmt->close();
}

?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>




    <?php
    include('../include/footer.php');
    ?>