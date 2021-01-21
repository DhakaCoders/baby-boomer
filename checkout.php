<?php
include('./kon/KonConfig.php');
if (!$_SESSION['billingSameAsShipping']) {
    $_SESSION['billingSameAsShipping'] = "YES";
}
if (isset($_POST['submitted']) && $_POST['submitted'] == '1') {

    $errors = array();
    $requiredFields = array('campaign_id' => 'Campaign Id', 'cc_number' => 'Credit Card number');
    foreach ($requiredFields as $k => $v) if (empty($_POST[$k])) {
        $errors[] = $requiredFields[$k] . " can not be empty.";
    }
    foreach ($_REQUEST as $k => $v) {
        $_SESSION[$k] = $v;
    }
    if (count($errors) > 0) {
        $errorMessage = implode("\n ", $errors);
    } else {
        $content = NewOrder($api_key_user, $api_key_pass, $_REQUEST);
        $ret = json_decode($content);
        if ($ret->result == 'SUCCESS') {
            $data2 = $ret->message;
            $_SESSION['purchased_items'] = array();
            $product_Id = $_REQUEST['product_id'];
            foreach ($_SESSION['all_products'] as $ide) {
                if (!empty($ide)) $_SESSION['purchased_items'][] = array('product_id' => $ide, 'time' => time(), 'return' => $content);
            }
            $orderId = $data2->orderId;
            $_SESSION['ord_id'] = $orderId;
            $_SESSION['all_products'] = array();
            $_SESSION['total_price'] = array();
            $_SESSION['itemid'] = array();
            $_SESSION['itemname'] = array();
            $_SESSION['price'] = array();
            $_SESSION['qty'] = array();
            $_SESSION['fields_fname'] = '';
            $_SESSION['fields_email'] = '';
            $_SESSION['fields_lname'] = '';
            $_SESSION['fields_address1'] = '';
            $_SESSION['fields_city'] = '';
            $_SESSION['fields_zip'] = '';
            $_SESSION['fields_phone'] = '';
            $_SESSION['fields_state'] = '';
            header("Location:/thank-you.php");
        } else {
            $errorMessage = "Error: ";
            if (is_string($ret->message)) {
                $errorMessage = "Please fix the following errors: " . $ret->message;
            } elseif (is_object($ret->message)) {
                foreach ($ret->message as $k => $v) {
                    $errorMessage .= " " . $k . " " . $v . " ";
                }
            }
        }
    }
} else {
} ?>

<?php
session_start();
error_reporting(0);
$validation_function = 'validate_checkout_()';
if (!isset($_REQUEST['prospectId']) || empty($_REQUEST['prospectId'])) {
    $validation_function = 'validate_one_()';
}
if ($errorMessage) {
    echo "<table style='width:100%;' align='center'><tr><td style='background-color:#ff0000;color:#ffffff;font-size: 18px;font-family: arial,helvetica,sans-serif; font-weight:bold;height:50px; padding-top: 10px; text-align: center;' align='center'>" . urldecode($errorMessage) . "</td></tr></table>";
} ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Checkout - Adsiato Naturals</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="robots" content="noindex">
    <meta name="robots" content="nofollow">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css?v=1.50" type="text/css"></head>
	<body>
<!-- header section -->
    <header id="mainHeader" class="clearfix">
        <div class="wrapper">
            <div class="topheader clearfix">
                <a href="index.php" class="logo"><img src="img/Adsiato Naturals - Logo.png?v=1" alt=""></a>
                <!-- end headerRight -->
            </div><!-- end topheader -->
            <nav class="clearfix menu" id="navigation">
                <ul id="category">
                     <li><a href="#">Weight Loss</a></li>
                    <li><a href="#">Beauty</a></li>
                    <li><a href="#">General Health</a></li>
                </ul>
                <a href="javascript:void(0);" class="responsivemenu cat-title">Menu</a>
                <ul id="menu">
                    <li><a href="index.php">Home</a></li><!-- 
                    <li><a href="store.html">STORE</a></li>
					<li><a href="about-us.html">About</a></li> -->
                    <li><a href="contact-us.html">CONTACT</a></li>
                    <li class="tell_no"><a href="tell:1-855-548-4811">1-855-548-4811</a></li>
					<div class="headerRight">
                    <a href="cart.php" class="cartIcon cartbg">Cart</a>
                    <div class="phone">
                        
                        Tel: 1-855-548-4811
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
            <!-- Start About Page Section -->
               <!-- <div class="innerpages1">
                    <h1>My Shopping Cart</h1>
					
					<input type="button" value="Continue Shopping" class="kcartShopButton" href="#">
					
					<table id="kcartTable">
	<tbody><tr id="kcartTitleRow"> 
    	<td style="width:200px">Item</td>
        <td>Description</td> 
        <td>Amount</td> 
        <td>&nbsp;</td> 
    </tr>
			<tr>
        <td colspan="5" id="kcartEmptyCartWarning">
    Your shopping cart is currently empty. Click the continue shopping button to add products to your cart.
        </td>
    </tr>
</tbody></table>
					
				</div> -->
				<div class="check_sec full-width pb-40">
<div class="container">
	<div class="row">
		<div class="col-6">
			<div class="shipping_form">
				<h3 class="text-center mb-30">Shipping & Billing Information</h3>

                <form class="form_col" data-toggle="validator" role="form" action="./checkout.php?product_id=<?php echo $cart['product_id'] ?>"
                      method="post" id="checkout_form">

                    <input type="hidden" name="billingSameAsShipping" value="YES">
					<div class="form-group">
					  <label for="usr">First Name:</label>
					  <input type="text" class="form-control" name="fields_fname" maxlength="20"
                             id="firstName" pattern="[\sa-zA-Z]{2,32}" placeholder="First name" onfocusout="partial_order()"
                      value="<?php echo $_SESSION['fields_fname']; ?>" required>
					</div>
					
					<div class="form-group">
					  <label for="usr">Last Name:</label>
					  <input type="text" class="form-control" pattern="[\sa-zA-Z]{2,32}" maxlength="20" onfocusout="partial_order()"
                       id="lastName" name="fields_lname" placeholder="Last name"
                       value="<?php echo $_SESSION['fields_lname']; ?>" required>
					</div>
					
					<div class="form-group">
					  <label for="usr">Shipping Address:</label>
					  <input type="text" class="form-control" minlength="3" maxlength="50"
                        name="fields_address1" placeholder="Address" id="address" value="<?php echo $_SESSION['fields_address1']; ?>" required>
					</div>
					
					<div class="form-group">
					  <label for="usr">City:</label>
					  <input type="text" class="form-control"
                             id="City" name="fields_city"
                             minlength="3" maxlength="30"
                             placeholder="City"
                             value="<?php echo $_SESSION['fields_city']; ?>" required>
					</div>

                    <?php

                    $statesArray = array();

                    $statesArray["AL"] = "Alabama (AL)";

                    $statesArray["AL"] = "Alabama";

                    $statesArray["AK"] = "Alaska";

                    $statesArray["AZ"] = "Arizona";

                    $statesArray["AR"] = "Arkansas";

                    $statesArray["CA"] = "California";

                    $statesArray["CO"] = "Colorado";

                    $statesArray["CT"] = "Connecticut";

                    $statesArray["DE"] = "Delaware";

                    $statesArray["DC"] = "District of Columbia";

                    $statesArray["FL"] = "Florida";

                    $statesArray["GA"] = "Georgia";

                    $statesArray["HI"] = "Hawaii";

                    $statesArray["ID"] = "Idaho";

                    $statesArray["IL"] = "Illinois";

                    $statesArray["IN"] = "Indiana";

                    $statesArray["IA"] = "Iowa";

                    $statesArray["KS"] = "Kansas";

                    $statesArray["KY"] = "Kentucky";

                    $statesArray["LA"] = "Louisiana";

                    $statesArray["ME"] = "Maine";

                    $statesArray["MD"] = "Maryland";

                    $statesArray["MA"] = "Massachusetts";

                    $statesArray["MI"] = "Michigan";

                    $statesArray["MN"] = "Minnesota";

                    $statesArray["MS"] = "Mississippi";

                    $statesArray["MO"] = "Missouri";

                    $statesArray["MT"] = "Montana";

                    $statesArray["NE"] = "Nebraska";

                    $statesArray["NV"] = "Nevada";

                    $statesArray["NH"] = "New Hampshire";

                    $statesArray["NJ"] = "New Jersey";

                    $statesArray["NM"] = "New Mexico";

                    $statesArray["NY"] = "New York";

                    $statesArray["NC"] = "North Carolina";

                    $statesArray["ND"] = "North Dakota";

                    $statesArray["OH"] = "Ohio";

                    $statesArray["OK"] = "Oklahoma";

                    $statesArray["OR"] = "Oregon";

                    $statesArray["PA"] = "Pennsylvania";

                    $statesArray["PR"] = "Puerto Rico";

                    $statesArray["RI"] = "Rhode Island";

                    $statesArray["SC"] = "South Carolina";

                    $statesArray["SD"] = "South Dakota";

                    $statesArray["TN"] = "Tennessee";

                    $statesArray["TX"] = "Texas";

                    $statesArray["UT"] = "Utah";

                    $statesArray["VT"] = "Vermont";

                    $statesArray["VI"] = "Virgin Islands of the U.S.";

                    $statesArray["VA"] = "Virginia";

                    $statesArray["WA"] = "Washington";

                    $statesArray["WV"] = "West Virginia";

                    $statesArray["WI"] = "Wisconsin";

                    $statesArray["WY"] = "Wyoming";

                    ?>
					<div class="form-group">
					  <label for="sel1">State:</label>
					  <span class="select_sign">
					  <select class="form-control select_box" name="fields_state" id="states" required>

                                                        <?php

                                                        foreach ($statesArray as $key => $value) {

                                                            if ($key == $_SESSION['fields_state']) {

                                                                echo "<option value='$key' selected>$value</option>";

                                                            } else {

                                                                echo "<option value='$key'>$value</option>";

                                                            }

                                                        }

                                                        ?>
					  </select>
					  </span>
					</div>
					
					<div class="form-group">
					  <label for="usr">Phone:</label>
					  <input type="text" class="form-control"  placeholder="Phone number" id="phone" name="fields_phone"
                             minlength="2" maxlength="10"
                             pattern="^((?!(0))[0-9]{10})$" value="<?php echo $_SESSION['fields_phone']; ?>"  onkeydown="return onlyNumbers(event, 'require')" required>
					</div>
					
					<div class="form-group mb-0">
					  <label for="usr">Your Email:</label>
					  <input type="email" class="form-control" minlength="3" maxlength="55"
                             placeholder="Email address" id="email" name="fields_email" onfocusout="partial_order()"

                             value="<?php echo $_SESSION['fields_email']; ?>"

                             pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
					</div>

                    <div class="form-group mb-0">
                        <label for="usr">Postal code:</label>
                    <input class="form-control" type="text" pattern="^([0-9]{5}))$" title="Zip code shouldn't start with 0, and accept 5 digits"
                           placeholder="Postal code" id="postalCode" name="fields_zip" minlength="5" maxlength="5" value="" onfocusout="partial_order()"
                           onkeydown="return onlyNumbers(event, 'require')" required="">
                    </div>
					
					<div class="width text-center mb-20">
						<img src="img/payment.jpg" alt="" class=""/>
					</div>
					
					<div class="form-group">
					  <label for="usr">Card Number:</label>
					  <input type="text" class="form-control" name="cc_number" maxlength="16" onkeydown="return onlyNumbers(event, 'require')" required>
					</div>
					
					<div class="form-group">
					  <label for="usr">Expiration Date:</label>
					  <div class="row">
                          <div class="col-6"">
                          <span class="select_sign">
                              <select name="fields_expyear" id="expirationYear"
                                      class="form-control select_box"
                                      required>
                                  <option value="" selected>Select year</option>
                              </select>
                          </span>
                          </div>
                          <div class="col-6">
                              <span class="select_sign">
                                  <select class="form-control select_box" name="fields_expmonth"

                                          id="expirationMonth" required>

                                      <option value="01" selected>01 (Jan)</option>

                                      <option value='02'>02 (Feb)</option>

                                      <option value='03'>03 (Mar)</option>

                                      <option value='04'>04 (Apr)</option>

                                      <option value='05'>05 (May)</option>

                                      <option value='06'>06 (Jun)</option>

                                      <option value='07'>07 (Jul)</option>

                                      <option value='08'>08 (Aug)</option>

                                      <option value='09'>09 (Sep)</option>

                                      <option value='10'>10 (Oct)</option>

                                      <option value='11'>11 (Nov)</option>

                                      <option value='12'>12 (Dec)</option>

                                  </select>
                              </span>
                              </div>

                          </div>
					  </div>
					
					<div class="form-group valid_code">
					  <div class="row">
						<div class="col-6">
							<label for="usr">CVV Code:</label>

                            <input class="form-control" type="text" placeholder="CVV code"

                                   id="securityCode" name="cc_cvv" pattern="^([0-9]*)$"

                                   autocomplete="off" maxlength="4" value=""

                                   onKeyDown="return onlyNumbers(event, 'require')"

                                   required>
						</div>
						
					  </div>
					</div>
					             <?php $product_id = $cart['product_id']; ?>

                                                    <input type="hidden" name="prc_id" value="<?php echo $product_id; ?>"/>
					
					  <input type="hidden" name="campaign_id" id="campaign_id"

                                                       value="<?php echo $campaign_id; ?>"/>

                   <input type="hidden" id="submitted" name="submitted" value="1"/>

                                                <input type="hidden" id="page" name="page" value="step2"/>

                                                <input type="hidden" id="hash_url" name="hash_url" value=""/>
                                                
                                                <div class="agree">
<!--<div class="container">-->
<!--	<label class="check_con">I have read and agree to<i class="b_color"> Terms and Conditions </i>, Refund & <i class="b_color">Privacy Policies</i>-->
<!--  <input type="checkbox">-->
<!--  <span class="checkmark"></span>-->
<!--</label>-->
<!-- <input type="checkbox" id="agree_txt" name="terms">
  <label for="agree_txt">I have read and agree to <span class="b_color">Terms and Conditions</span> , Refund & <span class="b_color">Privacy Policies</span></label>-->
  </div>
  </div>



<div class="submit">
<!--<a href="#">Submit Order-->
<!--</a>-->

<!--<button type="submit" class="text-center next_step_btn get_perfect checkout_btn" style="background: #128240;-->
<!--    color: #fff;-->
<!--    width: 18%;-->
<!--    display: block;-->
<!--    box-sizing: border-box;-->
<!--    text-align: center;-->
<!--    padding: 13px 0 13px;-->
<!--    border-radius: 4px;-->
<!--    cursor: pointer;-->
<!--    font-family: 'bitterregular';-->
<!--    font-size: 20px;-->
<!--    margin: 0 auto 40px;-->
<!--    text-transform: uppercase;" id="submit-checkout">Submit Order-->
<!-- </button>-->
<!--</div>-->

				
			</div>
		</div>
		<div class="col-6">
			<div class="white_content_box full-width mb-30">
				<p class="bitter_reg">$<?php echo $_SESSION['total_price']? $_SESSION['total_price'] : 0 ?></p>

<p class="bitter_reg">Total cost : $<?php echo $_SESSION['total_price']? $_SESSION['total_price'] : 0 ?></p>
			</div>
			
			<div class="white_content_box full-width mb-30">
				<p><span class="strong">We guarantee</span> you'll be completely satisfied with this program. If at any point you are not happy with the results, contact us for <span class="strong">Money back</span> within <span class="strong">180 days</span>. No hassles, no questions asked.</p>
			</div>
			
			<div class="white_content_box full-width mb-30">
				<p>Your order will be shipped in 3-5 business days by the USPS. Shipping is included for free, you are not charged. </p>
			</div>
			
			<div class="white_content_box full-width mb-30">
				<p class="pb-22">We offer a 180-Day Money Back warranty on all of our products purchased directly through our website. Your guarantee comes into effect on the day your product is shipped from our distribution center. The guarantee will expire 180-day after your shipped date. The Customer will be responsible for all return shipping charges acquired. We require that all Returns have a tracking number. The tracking number is very important in determining the delivery of your Return. No Return Authorization Number is needed. Simply send your Products to<br/>
ATTN: Returns Department – Adsiato Naturals<br/>
57 Pumpkin Delight Road,<br/>
Milford, CT 06460<br/>
If you have any questions regarding Returns, please contact our Customer Service Department at
<br/>1-855-548-4811<br/>
6 am – 6 pm PST MON – FRI<br/>
6 am – 4 pm PST SAT – SUN</p>
<p>Your purchase today will appear on your statement as "GL Pure Advanced". <p>
			</div>
		</div>
	</div>
</div>
</div>
	<div class="agree">
<div class="container">
	<!--<label class="check_con">I have read and agree to<a href="terms.html" class="b_color"> Terms and Conditions </a>, Refund & <a href="privacy.html" class="b_color">Privacy Policies</a>
  <input type="checkbox" required>
  <span class="checkmark"></span>
</label>-->
<div align='center'><input type="checkbox" name="vehicle1" value="CRH"> I have read and agree to<a href="terms-conditions.html" class="b_color" target="_blank"> Terms and Conditions </a>, Refund & <a href="privacy-policy.html" class="b_color" target="_blank">Privacy Policies. </div><br>


  </div>
  </div>





<button type="submit" class="text-center next_step_btn get_perfect checkout_btn" style="background: #0f75bc;
    color: #fff;
    width: 14%;
    display: block;
    box-sizing: border-box;
    text-align: center;
    padding: 10px 0 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
    margin: 0 auto 20px;
    text-transform: uppercase;" id="submit-checkout">Submit Order
 </button>			
				
				
		<div = align='center'><p class="statement_details">Your purchase today will appear on your statement as "GL Pure Advanced". <p></div>		
				
				
				
				
				
				
            <!-- End About Page Section -->
        <!-- end rightsideBar -->
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
<script type="text/javascript" src="/js/checkout.js?v=2.2"></script>
<script>
    $(function () {

        var i = 0;

        $('#checkout_form').submit(function () {

            if (!$(this).checkValidity || $(this).checkValidity()) {

                if (i > 0) {

                    return false;

                }

                i++;

            } else { }

        });

    });





    window.onbeforeunload = function () {

        $.ajax({

            method: "POST",

            async: false,

            url: "./kon/lead.php",

            data: $('#checkout_form').serializeArray()

        })

            .done(function (msg) {



            });

    }

    var ccYear = $("#expirationYear");

    var currentYear = new Date().getFullYear();

    $("#cyear").html(currentYear);

    for (var i = currentYear; i < currentYear + 19; i++) {

        var elem = $('<option value=' + i.toString().substr(-2) + '>' + i + '</option>');

        ccYear.append(elem);

    }


</script>
<script>
    function partial_order(){
        $.ajax({
            url:"./kon/lead.php",
            type:"POST",
            async: true,
            data: $('#checkout_form').serializeArray(),
            success: function(data){
                console.log(data);
            }
        });
    }
    function onlyNumbers(e,type)
    {
        var keynum;
        var keychar;
        var numcheck;
        if(window.event) // IE
        {
            keynum = e.keyCode;
        }
        else if(e.which) // Netscape/Firefox/Opera
        {
            keynum = e.which;
        }
        keychar = String.fromCharCode(keynum);
        numcheck = /\d/;

        switch (keynum)
        {
            case 8:    //backspace
            case 9:    //tab
            case 35:   //end
            case 36:   //home
            case 37:   //left arrow
            case 38:   //right arrow
            case 39:   //insert
            case 45:   //delete
            case 46:   //0
            case 48:   //1
            case 49:   //2
            case 50:   //3
            case 51:   //4
            case 52:   //5
            case 54:   //6
            case 55:   //7
            case 56:   //8
            case 57:   //9
            case 96:   //0
            case 97:   //1
            case 98:   //2
            case 99:   //3
            case 100:  //4
            case 101:  //5
            case 102:  //6
            case 103:  //7
            case 104:  //8
            case 105:  //9
                result2 = true;
                break;
            case 109: // dash -
                if (type == 'phone')
                {
                    result2 = true;
                }
                else
                {
                    result2 = false;
                }
                break;
            default:
                result2 = numcheck.test(keychar);
                break;
        }

        return result2;
    }
</script>
</body></html>
