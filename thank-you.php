<?php
session_start();
include('./kon/KonConfig.php');
$cart = $_SESSION['all_products'];
$total_price = $_SESSION['total_price'];
error_reporting(0);


$returnArray = json_decode($_SESSION['purchased_items'][0]['return'], true);
//echo "<pre>";
//var_dump($returnArray['message']['items']);
$order_id = $returnArray['message']['orderId'];
$total = $returnArray['message']['orderValue'];

?>
<?php
include('./kon/confirm_order.php');
$response = '';
$click_id = $_GET['click_id'];
if ($_REQUEST['errorMessage']) {
    echo "<table style='width:100%;' align='center'><tr><td style='background-color:#ff0000;color:#ffffff;font-size: 18px;font-family: arial,helvetica,sans-serif; font-weight:bold;height:50px; padding-top: 10px; text-align: center;' align='center'>" . urldecode($_REQUEST['errorMessage']) . "</td></tr></table>";
}
if (isset($_SESSION['p_price'])) {
    $transactionProducts = array();
    $sku = $_SESSION['sku'];
    $name = $_SESSION['p_name'];
    $quantity = "1";
    $products_details = ['sku' => $sku, 'name' => $name, 'price' => $_SESSION['p_price'], 'quantity' => $quantity,];
    $returnArray = json_decode($_SESSION['purchased_items'][0]['return'], true);
    $order_id = $returnArray['message']['orderId'];
    $tracAffiliation = 'MB-2';
    $traTotal = $_SESSION['p_price'];
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>Thank You - Hormonal Harmony</title>
    <META NAME="robots" CONTENT="noindex,nofollow">
    <META NAME="robots" CONTENT="noindex">
    <META NAME="robots" CONTENT="nofollow">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/style.css?v=1.5" type="text/css" media="screen">
    <link rel="stylesheet" href="css/media.css?v=12.5" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style-new.css?v=10.8" type="text/css">
    <link rel='icon' href='img/HB-5-fav_32x32.gif' type='image/x-icon'/>
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <style>
        .footer li a:hover {
            color: #624968!important;
        }

        .footer {
            background-position: top center;
        }
    </style>
</head>
<body>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'transactionId': <?php echo str_replace('"', "'", json_encode($order_id));?>, // string (required)
        'transactionAffiliation': <?php echo str_replace('"', "'", json_encode($tracAffiliation));?>, // string (required)
        'transactionTotal': <?php echo str_replace('"', "'", json_encode($traTotal));?>, // string (required)
        'transactionProducts': <?php echo str_replace('"', "'", json_encode($products_details));?>
    });
</script>
<header>
    <div class="container">
        <!--====logo left=====-->
        <div class="row">
            <div class=" col-sm-8 logo wow fadeInLeft animated"><a href="javascript:void(0)" class="logo_main"><img
                            src="img/HH_LOGO.png?v=1" alt="" style="float:left"></a></div>
            <div class="col-sm-4 wow fadeInRight animated">
            </div>
        </div>
        <!--====/logo left=====-->
    </div>
</header>
<!--=====container white section=====-->
<div class="white_bg_cont pb_0">
    <div class="container">
        <div class="resize1">
            <div class="stepwizard-row2 step_2 wow fadeInUp animated" data-wow-delay="0.1s">
                <ul>
                    <li>
                        <div class="col-xs-4">
                            <div class="stepwizard-step2">
                                <a class="btn btn-default deactive btn-circle" disabled="disabled" data-toggle="tab"
                                   onClick="stepnext(1)">SHIPPING </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-xs-4">
                            <div class="stepwizard-step2">
                                <a class="btn btn-default deactive btn-circle" disabled="disabled" href="#step-2"
                                   data-toggle="tab">PAYMENT</a>
                            </div>
                        </div>
                    </li>
                    <li class="active2">
                        <div class="col-xs-4">
                            <div class="stepwizard-step2">
                                <a class="btn btn-circle active-step btn-primary" href="#step-2" data-toggle="tab">ORDER
                                    SUMMARY</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="product_total wow fadeInLeft animated">
                <div class="product_info tab_cont" id="tab1" style="display:table;">
                    <div class="col-md-12">
                        <div class="thank_inner">
                            <h1>Thank You For Your Order</h1>
                            <h2> You'll receive your confirmation email within 30 mins. </h2>
                            <h2 class="order_txt">ORDER RECEIPT</h2>
                            <div class="product_price">
                                <p class="l">Order placed: </p>
                                <p class="r"><?php echo date('l jS \of F', $_SESSION['purchased_items'][0]['time']); ?></p>
                            </div>

                            <div class="product_price">
                                <p class="l">Transaction ID: </p>
                                <?php $returnArray = json_decode($_SESSION['purchased_items'][0]['return'], true) ?>
                                <p class="r" id='transaction-p'><?php echo $returnArray['message']['orderId']; ?></p>
                            </div>
                            <?php
                            foreach ($returnArray['message']['items'] as $v){

                                    $name = $v['name'];
                                    $pr_price = $v['price'];
                                    ?>
                                    <div class="product_price">
                                        <p class="l"><?php echo $name; ?> </p>
                                        <p class="r"> <?php echo '$' . $pr_price ?></p>
                                    </div>  <?php } ?>

                            <div class="product_price total_price">
                                <p class="l">Total: </p>
                                <p class="r"><?php echo '$' . $total; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- /resize end -->
    </div>
</div>
<!--=====container white section=====-->
<!--=====footer section=====-->
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

<!--=====/footer section=====-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

    var currentYear = new Date().getFullYear();
    $("#cyear").html(currentYear);

(function (w, d, t, r, u) {
        var f, n, i;
        w[u] = w[u] || [], f = function () {
            var o = {ti: "25015778"};
            o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad")
        }, n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function () {
            var s = this.readyState;
            s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null)
        }, i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i)
    })(window, document, "script", "//bat.bing.com/bat.js", "uetq");</script>
</body>
</html>