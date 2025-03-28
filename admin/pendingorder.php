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
<link rel="stylesheet" href="../admin/admincss/sty.css">
<link rel="stylesheet" href="../userside/css/admin_style.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pending order</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="orders">

        <!-- <h1 class="heading">placed orders</h1> -->
        <div class="raj">
            <div class="box-container">

                <?php
                $select_orders = $conn->query("SELECT * FROM `orders`");

                if ($select_orders->num_rows > 0) {
                    while ($fetch_orders = $select_orders->fetch_assoc()) {
                ?>
                        <div class="box">
                            <p> Placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                            <p> Name : <span> <?= $fetch_orders['name']; ?></span> </p>
                            <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
                            <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
                            <p> Total Products : <span><?= $fetch_orders['total_product']; ?></span> </p>
                            <p> Total Price : <span>Rs. <?= $fetch_orders['total_price']; ?>/-</span> </p>
                            <p> Payment Method : <span><?= $fetch_orders['method']; ?></span> </p>
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?= $fetch_orders['oid']; ?>">
                                <select name="payment_status" class="select">
                                    <option selected disabled><?= $fetch_orders['pyment_staus']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <div class="flex-btn">
                                    <input type="submit" value="update" class="option-btn" name="update_payment">
                                    <a href="placed_orders.php?delete=<?= $fetch_orders['oid']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no orders placed yet!</p>';
                }
                ?>

            </div>

    </section>
</div>
</div>


<script src="../userside/js/admin_script.js"></script>

<?php
include('../include/footer.php');
?>
<?php
$dataQuery = "SELECT * FROM regdetails WHERE usertype='Admin'";
$dataResult = mysqli_query($conn, $dataQuery);
$row = mysqli_fetch_assoc($dataResult);
?>

<?php
if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    $update_payment = $conn->prepare("UPDATE `orders` SET pyment_staus = ? WHERE oid = ?");
    $update_payment->execute([$payment_status, $order_id]);
    $message[] = 'payment status updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE oid = ?");
    $delete_order->execute([$delete_id]);
    header('location:pendingorder.php');
}

?>