<?php
session_start();
include('./kon/KonConfig.php');
$cart = $_SESSION['all_products'];
$total_price = $_SESSION['total_price'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Cart - Baby Boomer Biotech</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="robots" content="noindex">
    <meta name="robots" content="nofollow">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css?v=1.17" type="text/css"></head>
    <link rel="stylesheet" href="css/style-new.css?v=10.8" type="text/css">
        <style>
        .remove{
            width: 10%;
            margin-left: 1%;
            margin-top: 0.5%;
        }
        .remove_class{
            border: none;
        }
    </style>
	<body>
<!-- header section -->
    <header id="mainHeader" class="clearfix">
        <div class="wrapper">
            <div class="topheader clearfix">
                <a href="index.php" class="logo"><img src="img/Adsiato Naturals - Logo.png?v=1" alt=""></a>
                <!-- end headerRight -->
            </div><!-- end topheader -->
            <nav class="clearfix menu" id="navigation">
                 <a href="javascript:void(0);" class="responsivemenu cat-title">Menu</a>
                <ul id="menu">
                    <li><a href="index.php">Home</a></li><!-- 
                    <li><a href="store.html">STORE</a></li>
					<li><a href="about-us.html">About</a></li> -->
                    <li><a href="contact-us.html">CONTACT</a></li>
                    <li class="tell_no"><a href="tell:602-425-0838">1-602-425-0838</a></li>
					<div class="headerRight">
                    <a href="cart.php" class="cartIcon cartbg">Cart</a>
                    <div class="phone">
                        Tel:  1-602-425-0838
                    </div>
                </div>
                </ul>
				
            </nav>
        </div><!-- end wrapper -->
    </header>
<!-- end header section -->

<!-- start Main content section -->
<main id="mainContent" class="innerbg">
    <div class="wrapper">
        <div class="col-12">
            <!-- Start About Page Section -->
               <div class="innerpages1">
                    <h1>My Shopping Cart</h1>
					
					<!--<a value="Continue Shopping" class="kcartShopButton" href="index.php">Continue Shopping</a>-->
					
					<table id="kcartTable">
	<tbody><tr id="kcartTitleRow"> 
    	<td style="width:200px">Item</td>
        <td>Amount</td> 
        <td>Remove</td> 

    </tr>
    <tr>
     <?php
                //if cart  is empty
                if(!empty($cart)){
                    foreach ($cart as $c => $v ){
                        ?>
    <tr>
    <td>
                        <p><?php echo $productArray[$c]['name']; ?></p>
                    </td>
                    <td>
                        <p>$<?php echo count($v) * $productArray[$c]['price']; ?></p>
                    </td>
                    <td class="remove">
                        <button class="remove_class" data-price="<?php echo count($v) * $productArray[$c]['price']; ?>" data-id="<?php echo $productArray[$c]['id']; ?>" id="remove-<?php echo $productArray[$c]['id']; ?>"><img src="img/removeimg.gif"></button>
                    </td>
    </tr>
                <?php }
                }else{?>
        <td colspan="5" id="kcartEmptyCartWarning">
    Your shopping cart is currently empty. Click the continue shopping button to add products to your cart.
        </td>
                        <?php  }
                ?>
    </tr>
</tbody></table>
<div class="row pad-top-50">
<div class="col-8">
<a value="Continue Shopping" class="kcartShopButton cont_shop" href="index.php">Continue Shopping</a>
</div>
<div class="col-4">
<div class="mini-shop-cart">
						<div class="calculation-area">
							<p>Sub Total<span>$<?php echo $total_price; ?></span></p>
							<p>Delivery Fee<span class="blu-color">Free</span></p>
							<p><b>Total</b><span>$<?php echo $total_price; ?></span></p>
						</div>
					</div>

					<a href="/checkout.php" class="kcartShopButton">Proceed to Checkout</a>
					
					
					</div>
					</div>
				</div>
            <!-- End About Page Section -->
        </div><!-- end rightsideBar -->
      </div><!-- end wrapper -->
</main>
<!-- end Main content section -->

<!-- BEGIN Footer -->

<footer id="footer">
    <div class="wrapper">
      <div class="col-12">
        <div class="footer-col-wrp clearfix">
          <div class="footer-col-lft">
            <div class="footer-logo">
              <a href="#"><img src="images-new/Adsiato Naturals - Logo.png"></a>
            </div>
            <p>The statements on this website and on these product labels have not been evaluated by the food
            and drug
            administration. These products are intended as a dietary supplement only. Products are not
            intended to
            diagnose, treat, cure or prevent any disease. Individual results may vary based on age, gender,
            body
            type, compliance, and other factors. All products are intended for use by adults over the age
            of 18.
            Consult a physician before taking any of our products, especially if you are pregnant, nursing,
            taking medication, diabetic, or have any medical condition.</p>
          </div>
          <div class="footer-col-rgt clearfix">
            <div class="ftr-col-right">
            <h3>Get in Touch</h3>
            <ul>
              <li><span>Support: </span> <a href="tel:602-425-0838"> +1 602-425-0838</a></li>
              <li><span>Email: </span> <a href="mailto:suooprt@babyboomerbiotech.com"> suooprt@babyboomerbiotech.com</a></li>
              <li><span>Beardown Markerting LLC dba Baby Boomer Biotech <br>3370 N Hayden Rd 123-601 <br> Scottodale AZ, 85251, United States</span></li>
              <li style="display: none;"><span>1140 S Highbrook St, Akron, OH 44301, United States</span></li>
            </ul>
          </div>
          </div>
        </div>
        <div class="footer-copy-right">
          <p>&copy; 2021 Baby Boomer Biotech. All Rights Reserved.</p>
        </div>
      </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script>
    $(".remove_class").click(function(){
        var id = $(this).data('id');
        var price = $(this).data('price');
        $.ajax({
            url: "./kon/cart_ajax.php",
            type: "POST",
            data:{id:id,price:price},
            success: function(result){
                location.reload();
            }});
    });
</script>

</body></html>
