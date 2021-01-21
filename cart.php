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
    <title>Cart - Adsiato Naturals</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="robots" content="noindex">
    <meta name="robots" content="nofollow">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css?v=1.17" type="text/css"></head>
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
                    <li class="tell_no"><a href="tell:844-000-00005">844-000-00005</a></li>
					<div class="headerRight">
                    <a href="cart.php" class="cartIcon cartbg">Cart</a>
                    <div class="phone">
                        
                        Tel:  1-855-548-4811
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
        <div class="ftrow clearfix">
            <div class="widget">
                <ul>
                    <li><a href="terms-conditions.html">Terms &amp; Conditions</a></li>
					<li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="contact-us.html">Contact Us</a></li>
					<li><a href="refunds.html">Refunds</a></li>
					<li><a href="faq.html">FAQ</a></li>
                </ul>
            </div>
            
        </div>
        <!--<p align='center'>Hormonal Harmony LLC: 66 W Flagler, Street STE 900, Miami, FL 33130</p><br>-->
        <div class="bottomfooter clearfix">
        	<p>The statements on this website and on these product labels have not been evaluated
        	by the food and drug administration. These products are intended as a dietary supplement only.
        	Products are not intended to diagnose, treat, cure or prevent any disease.
        	Individual results may vary based on age, gender, body type, compliance, and other factors.
        	All products are intended for use by adults over the age of 18. Consult a physician before taking any of our products,
        	especially if you are pregnant, nursing, taking medication, diabetic, or have any medical condition.
			<br><br>
        	© 2020 Adsiato Naturals. All Rights Reserved
			</p>
            <img src="img/cards.png" class="cardbot" alt="Visa Mastercard Discover">
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
