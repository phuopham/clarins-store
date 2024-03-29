<?php


// Validate session
session_start();
if (!isset($_SESSION['username'])) :
    header('location:index.php');
endif;
$username = $_SESSION['username'];
// validate session end

// logout start
if (isset($_GET['logout'])) {
    session_unset();
    header('location:index.php');
}
// logout end
// fetch data
require_once('../dbconnect.php');
$sql = sprintf("select username, email, phone, type from users where username = '%s'", $username);
$result = $conn->query($sql);
$elm = $result->fetch_array(MYSQLI_ASSOC);
//fetch data end
//test privilege
if (!in_array($elm["type"], $priv)) {
    header("location:main.php?denied");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clarins</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../lib/summernote/summernote-bs4.css">
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="./index.php" class="nav-link"><i class="fa fa-home"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Guide</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link d-none d-md-inline-block" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="setpw.php" role="button">
                        <p>Change password</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="header.php?logout" role="button">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="main.php" class="brand-link">
                <img src="../img/skin-care.png" alt="AdminLTE Logo" class="brand-image img-rounded elevation-3 bg-white" style="opacity: .8">
                <span class="brand-text font-weight-bold"><span style="color:aqua">C</span>larins - Admin page</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../img/skin-care.png" class="img-circle elevation-2 bg-warning" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="main.php" class="d-block"><?php echo ($_SESSION["username"]) ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="stockroom.php" class="nav-link">
                                <p>Stockroom</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="orders.php" class="nav-link">
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">
                                <p>Note from customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="comment.php" class="nav-link">
                                <p>Comments</p>
                            </a>
                        </li>
                        <?php
                        if ($elm["type"] == '2') :
                        ?>
                            <li class="nav-item">
                                <a href="users.php" class="nav-link">
                                    <p>Manage users</p>
                                </a>
                            </li>
                        <?php
                        endif;
                        if ($elm["type"] == '1' || $elm["type"] == '2') :
                        ?>
                            <li class="nav-item">
                                <a href="products.php" class="nav-link">
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="catalogs.php" class="nav-link">
                                    <p>Catalogs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="brands.php" class="nav-link">
                                    <p>Brands</p>
                                </a>
                            </li>
                        <?php
                        endif;
                        ?>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?php
        if (isset($_GET["denied"])) : ?>
            <div class="main-header">
                <div class="alert alert-danger alert-dismissible mb-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Access denied!
                </div>
            </div>
        <?php
        endif;
        ?>