<?php
require_once("dbconnect.php");
// all product in catalog
if (isset($_GET["catalog"])) {
    $sql = "SELECT * FROM products where catalogID =" . $_GET["catalog"];
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    header("location:index.php");
}

// get all brandID related
$sql = "SELECT brandID FROM products where catalogID =" . $_GET["catalog"] . " GROUP BY brandID ";
$result = $conn->query($sql);
$brands = $result->fetch_all(MYSQLI_ASSOC);
output($brands);


//header
include("header.php");
?>

<div>
    <img src="img/bg2.jpg" style="background-repeat: no-repeat;position: fixed;width: -webkit-fill-available; max-height: -webkit-fill-available;margin-top: -8%; height:200%;z-index:-1; ">
    <div style="background-color:rgb(0,0,0,0.6);">
        <!-- Products Start -->
        <div class="container-fluid py-5 px-0">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <h1 class="section-title position-relative text-center mb-5 text-white">All products</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <ul class="list-inline mb-4 pb-2" id="portfolio-flters">
                            <li class="btn btn-sm btn-outline-primary m-1 active" data-filter="*">All</li>
                            <?php
                            foreach($brands as $id => $brand){
                                echo('<li class="btn btn-sm btn-outline-primary m-1 active" data-filter="*">All</li>')
                            } ?>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".first">Cleanser</li>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".second">Lipstick</li>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".third">Perfume</li>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".fourth">Powder</li>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".fifth">Eyeliner</li>
                            <li class="btn btn-sm btn-outline-primary m-1" data-filter=".sixth">Remover</li>
                        </ul>
                    </div>
                </div>
                <div class="row portfolio-container">
                    <?php foreach ($products as $id => $product) {

                        echo ('<div class="col-lg-3 col-md-6 mb-4 pb-2 portfolio-item second">');
                        echo ('<div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">');
                        echo ('<div class="bg-primary mt-n5 py-3" style="width: 80px;">');
                        echo ('<h4 class="font-weight-bold text-white mb-0">$' . $product["price"] . '</h4>');
                        echo ("</div>");
                        echo ('<div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">');
                        echo ('<img class="rounded-circle w-100 h-100" src="' . $product['pic1'] . '" style="object-fit: cover;">');
                        echo ('</div>');
                        echo ('<h5 class="font-weight-bold mb-4">' . $product["name"] . '</h5>');
                        echo ('<a href="detail.php?prod=' . $product["productID"] . '" style="z-index: 30;" class="btn btn-sm btn-secondary">Order Now</a>');
                        echo ('</div>');
                        echo ('</div>');
                    } ?>

                </div>
            </div>
        </div>

        <!-- Products Start -->
    </div>
</div>

<?php
include("footer.php");
?>