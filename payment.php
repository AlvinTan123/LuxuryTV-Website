<?php
session_start();

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$streetaddress = $_POST["streetaddress"];
$suburbtown = $_POST["suburbtown"];
$state = $_POST["state"];
$postcode = $_POST["postcode"];
$phone = $_POST["phone"];
$preferredContact = $_POST["preferredcontact"];
$product = $_POST["product"];
$productprice = $_POST["productprice"];
$quantity = $_POST["quantity"];
$productfeature = $_POST["productfeature"];
$featureprice = $_POST["featureprice"];
$mytextarea = $_POST["mytextarea"];
$totalprice = $_POST["totalprice"];

$_SESSION["firstname"] = $firstname;
$_SESSION["lastname"] = $lastname;
$_SESSION["email"] = $email;
$_SESSION["streetaddress"] = $streetaddress;
$_SESSION["suburbtown"] = $suburbtown;
$_SESSION["state"] = $state;
$_SESSION["postcode"] = $postcode;
$_SESSION["phone"] = $phone;
$_SESSION["preferredContact"] = $preferredContact;
$_SESSION["product"] = $product;
$_SESSION["productprice"] = $productprice;
$_SESSION["quantity"] = $quantity;
$_SESSION["productfeature"] = $productfeature;
$_SESSION["featureprice"] = $featureprice;
$_SESSION["mytextarea"] = $mytextarea;
$_SESSION["totalprice"] = $totalprice;

?>
<?php include("includes/header.inc") ?>
<head>
   <title>Payment</title>
</head>
<body class="body">
   <div class="containerpayment">
      <form id="paymentform" method="post" action="process_order.php" novalidate>
         <div class="row">
            <div class="col">
               <h3 class="title">billing detail</h3>
               <div class="inputBox">
                  <p>Your Name:<span id="confirm_name"><?php echo $firstname . ' ' . $lastname; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Email:<span id="confirm_email"><?php echo $email; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Street Address:<span id="confirm_streetaddress"><?php echo $streetaddress; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Suburb Town:<span id="confirm_suburbtown"><?php echo $suburbtown; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Sate:<span id="confirm_state"><?php echo $state; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Post Code:<span id="confirm_postcode"><?php echo $postcode; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Phone Number:<span id="confirm_phone"><?php echo $phone; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Preferred Contact:<span id="confirm_preferredcontact"><?php echo $preferredContact; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>TV:<span id="confirm_product"><?php echo $product; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Quantity:<span id="confirm_quantity"><?php echo $quantity; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Feature:<span id="confirm_features"><?php echo $productfeature; ?></span></p>
               </div>
               <div class="inputBox">
                  <p>Total Price: <span id="confirm_totalprice"><?php echo "RM " . $totalprice; ?></span></p>
               </div>
            </div>
            <!--Create the other hidden input here  -->
            <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
            <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
            <input type="hidden" name="email" value="<?php echo $email; ?>" />
            <input type="hidden" name="streetaddress" value="<?php echo $streetaddress; ?>" />
            <input type="hidden" name="suburbtown" value="<?php echo $suburbtown; ?>" />
            <input type="hidden" name="state" value="<?php echo $state; ?>" />
            <input type="hidden" name="postcode" value="<?php echo $postcode; ?>" />
            <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
            <input type="hidden" name="preferredcontact" value="<?php echo $preferredContact; ?>" />
            <input type="hidden" name="product" value="<?php echo $product; ?>" />
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>" />
            <input type="hidden" name="productfeature" value="<?php echo $productfeature; ?>" />
            <input type="hidden" name="totalprice" value="<?php echo $totalprice; ?>" />
            <input type="hidden" name="mytextarea" value="<?php echo $mytextarea; ?>" />
            <div class="col">
               <h3 class="title">Payment</h3>
               <div class="inputBox">
                  <span>Cards accepted :</span>
                  <img src="image/card_img.png" alt="creditcard">
                  <br>
                  <label class="enquireradio">
                     <input type="radio" name="cardtype" id="Mastercard" value="Mastercard" required="required">
                     <span></span>
                  </label>
                  <label class="enquireradio">
                     <input type="radio" name="cardtype" id="AmEx" value="AmEx">
                     <span></span>
                  </label>
                  <label class="enquireradio">
                     <input type="radio" name="cardtype" id="Visa" value="Visa">
                     <span></span>
                  </label>
               </div>
               <div class="inputBox">
                  <span>Name on card :</span>
                  <input type="text" id="cardname" name="cardname" placeholder="Tan Wen Hau" required="required" maxlength="40">
               </div>
               <div class="inputBox">
                  <span>Credit card number :</span>
                  <input type="text" id="cardnumber" name="cardnumber" placeholder="1111-2222-3333-4444" maxlength="19" required="required">
               </div>
               <div class="inputBox">
                  <span>Credit card expiry date:</span>
                  <input type="text" id="cardexpirydate" name="cardexpirydate" placeholder="MM-YY" maxlength="5" required="required">
               </div>
               <div class="inputBox">
                  <span>CVV :</span>
                  <input type="password" id="cardcvv" name="cardcvv" placeholder="123" maxlength="4" required="required">
               </div>
               <div class="carousel-container">
                  <div class="carousel-slide">
                     <img src="image/lgtv.png" alt="Image 1">
                     <img src="image/samsungtv.png" alt="Image 2">
                     <img src="image/sonytv.png" alt="Image 3">
                     <img src="image/image3.jpg" alt="Image 4">
                     <img src="image/image4.jpg" alt="Image 5">
                     <img src="image/image5.jpg" alt="Image 6">
                  </div>
                  <br>
               </div>
            </div>
         </div>
         <input type="submit" value="Proceed to Checkout" class="submit-btn">
         <input type="button" value="Back to Form" class="cancel-btn">
         <input type="button" value="Cancel Payment" class="cancelpay-btn">
      </form>
   </div>
</body>
</html>