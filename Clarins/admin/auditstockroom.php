<?php
$priv = [1, 2];
require_once("../dbconnect.php");

// get good data

$sql = "SELECT * from stockroom ORDER BY create_by desc limit 100";
$result = $conn->query($sql);
$goodstocks = $result->fetch_all(MYSQLI_ASSOC);

// count products
$sql = "SELECT productID, SUM(quantity) from stockroom GROUP BY productID";
$result = $conn->query($sql);
$countproducts = $result->fetch_all(MYSQLI_ASSOC);
// header
include("header.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Audit Stockroom</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="stockroom.php">Stockroom</a></li>
                        <li class="breadcrumb-item active">Audit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>(Last 100 update)</p>
                </div>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-wrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Username</th>
                                        <th>Stock time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($goodstocks as $id => $good) {
                                        if (!empty($good["username"])) :
                                            echo ('<tr>');
                                            echo ("<td>" . ($id + 1) . "</td>");
                                            $result = $conn->query("SELECT name from products where productID ='" . $good["productID"] . "'");
                                            echo ("<td>" . $result->fetch_column() . "</td>");
                                            echo ("<td>" . $good["quantity"] . "</td>");
                                            echo ("<td>" . $good["username"] . "</td>");
                                            echo ("<td>" . $good["create_by"] . "</td>");
                                            echo ("</tr>");
                                        endif;
                                    };
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<?php
//footer
include("footer.php");
?>