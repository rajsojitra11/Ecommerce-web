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

<style>
    .col-md-6 {
        margin-left: 320px;
        margin-top: -30px;
    }

    @media (max-width: 1200px) {
        .col-md-6 {
            margin-left: 200px;
        }
    }

    @media (max-width: 992px) {
        .col-md-6 {
            margin-left: 100px;
        }
    }

    @media (max-width: 768px) {
        .col-md-6 {
            margin-left: 20px;
        }
    }

    @media (max-width: 576px) {
        .col-md-6 {
            margin-left: 0;
        }
    }
</style>

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

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> Product Details</h3>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['pid']); ?>">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" placeholder="Enter product name" value="<?php echo htmlspecialchars($editData["productname"]); ?>" name="pname" required>
                    </div>
                    <div class="form-group">
                        <label for="productDetails">Product Details</label>
                        <input type="text" class="form-control" id="productDetails" placeholder="Enter Product details" value="<?php echo htmlspecialchars($editData["productdetails"]); ?>" name="pdetails" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Product Price</label>
                        <input type="text" class="form-control" id="productPrice" placeholder="Enter Product price" value="<?php echo htmlspecialchars($editData["productprice"]); ?>" name="pprice" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Photo</label><br>
                        <?php if (!empty($editData['productimg'])): ?>
                            <img src="<?php echo htmlspecialchars($editData['productimg']); ?>" style="width: 100px; height: 50px;" alt="Product Image">
                        <?php endif; ?>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="productImage" name="productimg">
                                <label class="custom-file-label" for="productImage">Select file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="addp">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('../include/footer.php');

if (isset($_POST['addp'])) {
    $productId = $_POST['id'];
    $productName = $_POST['pname'];
    $productDetails = $_POST['pdetails'];
    $productPrice = $_POST['pprice'];

    // Handle file upload
    $targetDir = "./pimg/";
    $uploadOk = 1;
    $targetFile = $targetDir . basename($_FILES["productimg"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is an image
    if (!empty($_FILES["productimg"]["name"])) {
        $check = getimagesize($_FILES["productimg"]["tmp_name"]);
        if ($check === false) {
            echo "<script>alert('File is not an image.')</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
            $uploadOk = 0;
        }

        // Attempt to upload the file
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["productimg"]["tmp_name"], $targetFile)) {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                $uploadOk = 0;
            }
        }
    } else {
        // If no file is uploaded, keep the old image path
        $targetFile = $editData['productimg'];
    }

    // Prepare SQL statement to update product
    if ($uploadOk == 1) {
        $sql = "UPDATE product SET productname = ?, productdetails = ?, productprice = ?, productimg = ? WHERE pid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $productName, $productDetails, $productPrice, $targetFile, $productId);
        if ($stmt->execute()) {
            echo "<script>window.location.href='manageproduct.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
}
?>