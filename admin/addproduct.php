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
<style>
    .col-md-6 {
        margin-left: 320px;
        /* Default margin */
    }

    @media (max-width: 1200px) {
        .col-md-6 {
            margin-left: 200px;
            /* Smaller screens */
        }
    }

    @media (max-width: 992px) {
        .col-md-6 {
            margin-left: 100px;
            /* Even smaller screens */
        }
    }

    @media (max-width: 768px) {
        .col-md-6 {
            margin-left: 20px;
            /* Mobile screens */
        }
    }

    @media (max-width: 576px) {
        .col-md-6 {
            margin-left: 0;
            /* Full width on very small screens */
        }
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Enter Product Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="addproduct.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail0">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail0" placeholder="Enter product name" name="pname" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Details</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Product details" name="pdetails" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Enter Product price" name="pprice" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Product Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="productimg" required>
                                <label for="exampleInputFile" class="custom-file-label" name="productimg">Select file</label>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="addp">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->



    </div>


</div>




<?php
include('../include/footer.php');

if (isset($_POST['addp'])) {
    // Database connection should be established here (not shown)

    $productName = $_POST['pname'];
    $productDetails = $_POST['pdetails'];
    $productPrice = $_POST['pprice'];

    $targetDir = "./pimg/";
    $targetFile = $targetDir . basename($_FILES["productimg"]["name"]);
    $uploadOk = 1;

    // Check if the file is an image
    $check = getimagesize($_FILES["productimg"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($targetFile)) {
    //     echo "<script>alert('Sorry, file already exists.')</script>";
    //     $uploadOk = 0;
    // }

    // Check file size
    if ($_FILES["productimg"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    // Attempt to upload the file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["productimg"]["tmp_name"], $targetFile)) {
            // Prepare and bind
            $sql = "INSERT INTO product (productname, productdetails, productprice, productimg) VALUES (?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssis", $productName, $productDetails, $productPrice, $targetFile);

                // Execute and check for errors
                if ($stmt->execute()) {
                    echo "<script>alert('New product added successfully.')</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }

    // Close the connection
    $conn->close();
}
?>