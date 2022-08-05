<?php
    include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CLARINS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Clarins" name="keywords">
    <meta content="Clarins" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body style="background: #eb689145;">
    <div class="container mt-5 mb-5 pt-5 pb-5">
        <div class="row">
            <div class="col-5">
                <div class=" px-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img id="product-img" class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover; max-width:370px;min-height:480px;">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="small-img-col col-3" >
                        <img src="img/about.jpg" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col col-3">
                        <img src="img/aboutus.jpg" width="100%" class="small-img" >
                    </div>
                    <div class="small-img-col col-3">
                        <img src="img/order.jpg" width="100%" class="small-img" >
                    </div>
                    <div class="small-img-col col-3">
                        <img src="img/product-2.jpg" width="100%" class="small-img" > 
                    </div>
                </div>
            </div>

            <div class="col-7">
                <p>HOME / PRODUCTS</p>
                <h1>NAME PRODUCT</h1>
                <h4>$9.00</h4>
                <div>
                    <p style="height:150px;">I started using this a month ago, and I have seen great results.
                            I love the texture of the serum and I love the fact that its very smooth and light.</p>
                </div>
                <form method="post">
                <input type="number" name="quantity" value="1" min="0" style="max-width: 100px; text-align: center;">
                <div><button class="btn btn-secondary py-3 px-5 mt-2" name="cart">Add To Cart</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="container border rounded" style="padding-bottom:50px; background:lavenderblush; padding-top:20px; ">
        <div class="row justify-content-center pt-5">
            <div class="col-lg-6">
                <h1 class=" position-relative mb-5">Comments</h1>
            </div>
        </div>
        <div class="mb-5 row">
            <div class="col-md-2 text-right">
                <img style="max-width:40%;" src="img/testimonial-1.jpg" class="rounded-circle">
            </div>
            <div class="col-md-10 border rounded" style=" background: lightgray; max-width:70%;">
                <div>
                    <h5>Ngan</h5>
                </div>
                <div>
                    <p>I love the texture of the serum and I love the fact that its very smooth and light.</p>
                </div>
            </div>
        </div>
        <div class="mb-5 row">
            <div class="col-md-2 text-right">
                <img style="max-width:40%;" src="img/testimonial-1.jpg" class="rounded-circle">
            </div>
            <div class="col-md-10 border rounded" style=" background: lightgray; max-width:70%;">
                <div>
                    <h5>Hieu</h5>
                </div>
                <div>
                    <p>I love the texture of the serum and I love the fact that its very smooth and light.</p>
                </div>
            </div>
        </div>
        <div class="mb-5 row">
            <div class="col-md-2 text-right">
                <img style="max-width:40%;" src="img/testimonial-1.jpg" class="rounded-circle">
            </div>
            <div class="col-md-10 border rounded" style=" background: lightgray; max-width:70%;">
                <div>
                    <h5>Phuong</h5>
                </div>
                <div>
                    <p>I love the texture of the serum and I love the fact that its very smooth and light.</p>
                </div>
            </div>
        </div>
        <div class="mb-5 row">
            <div class="col-md-2 text-right">
                <img style="max-width:40%;" src="img/testimonial-1.jpg" class="rounded-circle">
            </div>
            <div class="col-md-10 border rounded" style=" background: lightgray; max-width:70%;">
                <div>
                    <h5>An</h5>
                </div>
                <div>
                    <p>I love the texture of the serum and I love the fact that its very smooth and light.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="contact-form rounded p-5">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post">
                            <div class="form-row">
                                <div class="col-sm-4 control-group">
                                    <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-sm-8 control-group">
                                    <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control p-4" id="message" name="message" placeholder="Comment" required="required" data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Send Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
		var ProductImg = document.getElementById("product-img");
		var SmallImg = document.getElementsByClassName("small-img");

		SmallImg[0].onclick = function()
		{
			ProductImg.src = SmallImg[0].src;
		}
		SmallImg[1].onclick = function()
		{
			ProductImg.src = SmallImg[1].src;
		}
		SmallImg[2].onclick = function()
		{
			ProductImg.src = SmallImg[2].src;
		}
		SmallImg[3].onclick = function()
		{
			ProductImg.src = SmallImg[3].src;
		}
	</script>
</body>
</html>
<?php
    include('footer.php');
?>