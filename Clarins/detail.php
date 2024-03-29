<?php
// fetch product
require_once("dbconnect.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") :
    if (!isset($_GET['prod'])) :
        header("location:products.php");
    endif;
    $sql = "SELECT * from products where productID = '" . $_GET['prod'] . "';";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    $pricedc = $product["price"] - ($product["price"] * ($product["discount"] / 100));

    // fetch catalog
    $sql =  "SELECT name, category, description from catalogs where catalogID ='" . $product["catalogID"] . "';";
    $result = $conn->query($sql);
    $catalog = $result->fetch_assoc();

    // fetch brand
    $sql =  "SELECT name, description from brands where brandID ='" . $product["brandID"] . "';";
    $result = $conn->query($sql);
    $brand = $result->fetch_assoc();

    //fetch message
    $sql = "SELECT name, message, visible from comments where productID = '" . $product["productID"] . "' AND visible = 0";
    $result = $conn->query($sql);
    $comments = $result->fetch_all(MYSQLI_ASSOC);

    //check out of stock
    $sql = "SELECT SUM(quantity) as quantity from stockroom where productID = '" . $product["productID"] . "'";
    $result = $conn->query($sql);
    $quantity = $result->fetch_column();

else :
    header("location:products.php");
endif;

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    if (!isset($_POST['productID']) || empty($_POST['productID'])) {
        header("location:products.php?error");
        die();
    }
    $sql = "SELECT * from products where productID = '" . $_POST['productID'] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header("location:products.php?error");
        die();
    }
    $product = $result->fetch_assoc();
    $id = $product['productID'];
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        header("location:detail.php?prod=" . $id . "&error");
        die();
    }
    $name = $_POST['name'];
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        header("location:detail.php?prod=" . $id . "&error");
        die();
    }
    $email = $_POST['email'];
    if (!isset($_POST['message']) || empty($_POST['message'])) {
        header("location:detail.php?prod=" . $id . "&error");
        die();
    }
    $message = $_POST['message'];
    $sql = "INSERT INTO comments (name,email,message,productID) VALUES('$name','$email','$message','$id')";
    $conn->query($sql);
    header("location: detail.php?prod=" . $id . "&postsuccess");
endif;

$categoriesname = [null, "Hair", "Makeup", "Perfumes", "Face", "Body", "Suncream"];

// header
$page = "product";
include('header.php');

?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-5">
            <div class=" px-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img id="product-img" class="position-absolute w-100 h-100" src="<?php echo ($product["pic1"]) ?>" style="object-fit: cover; max-width:370px;min-height:480px;">
                </div>
            </div>
            <div class="d-flex">
                <div class="small-img-col col-3">
                    <img src="<?php echo ($product["pic1"]) ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col col-3">
                    <img src="<?php echo ($product["pic2"]) ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col col-3">
                    <img src="<?php echo ($product["pic3"]) ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col col-3">
                    <img src="<?php echo ($product["pic4"]) ?>" width="100%" class="small-img">
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <p class="text-uppercase">HOME / PRODUCTS / <?php echo ($categoriesname[$catalog["category"]] . " / " . $catalog["name"]); ?></p>
            <h1 class="text-uppercase"><?php echo ($product["name"]) ?></h1>
            <h4>$<?php echo ($pricedc); ?></h4>
            <div>
                <p style="height:150px;"> <?php echo ($product["sell_quantity"] > 0 ? ("Total sell: " . $quantity) : ""); ?></p>
            </div>
            <form action="cartcookie.php" id="addtocart" method="get">
                <input type="number" hidden name="product" value="<?php echo ($product["productID"]); ?>">
                <input class="form-control ml-4" type="number" name="quantity" value="1" min="1" max="<?php echo ($quantity) ?>" style="max-width: 100px; text-align: center;">
                <div>
                    <?php
                    if (!empty($quantity) && (int)$quantity > 0) {
                        echo ('<button class="btn btn-secondary py-3 px-5 mt-2" name="add">Add To Cart</button>');
                    } else {
                        echo ('<button type="button" class="btn btn-secondary py-3 px-5 mt-2" disabled>Out of stock</button>');
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-11">
            <h3>Product description</h3>
            <p>
                <?php echo ($product["description"]) ?>
            </p>
            <h3>Brand description</h3>
            <p>
                <?php echo ($catalog["description"]) ?>
            </p>
            <h3>Catalog description</h3>
            <p>
                <?php echo ($catalog["description"]) ?>
            </p>
        </div>
    </div>
</div>
<div class="container border rounded pb-5" style=" background:lavenderblush;">
    <div class="row justify-content-center pt-5">
        <div class="col-lg-6">
            <h1 class=" position-relative mb-3">Comments</h1>
        </div>
    </div>
    <?php foreach ($comments as $id => $comment) :
    ?>
        <div class="mb-3 row">
            <div class="col-md-1"></div>
            <div class="col-md-1 d-none d-md-block text-right">
                <img src="img/skin-care.png" class="img-fluid rounded">
            </div>
            <div class="col-md-9 border rounded" style=" background: lightgray;">
                <div>
                    <h5><?php echo ($comment['name']) ?></h5>
                </div>
                <div>
                    <p><?php echo ($comment['message']) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 p-2">
                <div class="contact-form rounded p-sm-3">
                    <form name="sentFeedback" id="commentForm" method="POST">
                        <input class="d-none" type="number" name="productID" value="<?php echo ($product["productID"]) ?>">
                        <div class="form-row">
                            <div class="col-sm-4 control-group">
                                <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-sm-8 control-group">
                                <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control p-4" id="message" name="message" placeholder="Comment" required="required"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendFeedbackButton">Send Feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var ProductImg = document.getElementById("product-img");
    var SmallImg = document.getElementsByClassName("small-img");

    SmallImg[0].onclick = function() {
        ProductImg.src = SmallImg[0].src;
    }
    SmallImg[1].onclick = function() {
        ProductImg.src = SmallImg[1].src;
    }
    SmallImg[2].onclick = function() {
        ProductImg.src = SmallImg[2].src;
    }
    SmallImg[3].onclick = function() {
        ProductImg.src = SmallImg[3].src;
    }

    // alert
    const sabootstrap = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
        },
        buttonsStyling: false
    })
    <?php
    if (isset($_GET["error"])) :
        echo ("sabootstrap.fire('Please check your input','Fields cannot leave blank','error')");
    endif;
    if (isset($_GET["postsuccess"])) :
        echo ("sabootstrap.fire('Thank you!','We appreciate what you have done!','success')");
    endif;
    if (isset($_GET["success"])) :
        echo ("sabootstrap.fire('Product is added to cart','Go to cart and checkout once you done!','success')");
    endif;
    ?>
</script>

<?php
echo ('<div class="bg-secondary">');
include("bestsells.php");
echo ('</div>');
include('footer.php');
?>