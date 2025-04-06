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

$sql = "SELECT COUNT(*) AS pending_count FROM `orders` WHERE `pyment_staus` = 'Pending'";


$result = $conn->query($sql);


if ($result) {

  $row = $result->fetch_assoc();


  $pendingCount = $row['pending_count'];
}

$sq = "SELECT COUNT(*) AS completed_count FROM `orders` WHERE `pyment_staus` = 'completed'";

$res = $conn->query($sq);

if ($res) {

  $ro = $res->fetch_assoc();


  $completedCount = $ro['completed_count'];
}


$totalOrdersSql = "SELECT COUNT(*) AS total_count FROM `orders`";


$totalResult = $conn->query($totalOrdersSql);

if ($totalResult) {

  $totalRow = $totalResult->fetch_assoc();


  $totalOrders = $totalRow['total_count'];
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Orders</span>
              <span class="info-box-number">&nbsp;&nbsp;&nbsp;<?= $totalOrders ?></span> <!-- Updated variable here -->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pending Orders</span>
              <span class="info-box-number">&nbsp;&nbsp;&nbsp;<?= $pendingCount; ?></span> <!-- Updated variable here -->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Completed Orders</span>
              <span class="info-box-number">&nbsp;&nbsp;&nbsp;<?= $completedCount; ?></span> <!-- Use the correct variable here -->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div><!--/. container-fluid -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../include/footer.php');
?>