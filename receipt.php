<?php

// Check if the file is accessed through a valid flow
if (!isset($_SERVER['HTTP_REFERER']) || (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'process_order.php') === false)) {
    // Invalid access attempt
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access to this page is not allowed.');
}

session_start();

// Check if the order ID and order status are present in the session
if (isset($_SESSION['order_id']) && isset($_SESSION['order_status']) && isset($_SESSION['order_time'])) {
    $orderId = $_SESSION['order_id'];
    $orderTime = $_SESSION['order_time'];
    $orderStatus = $_SESSION['order_status'];

    // Retrieve other order details from the session or the database
    // You can access the order details using $_SESSION or by querying the database
    $totalcost = $_SESSION['totalprice'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $streetaddress = $_SESSION['streetaddress'];
    $suburbtown = $_SESSION['suburbtown'];
    $state = $_SESSION['state'];
    $postcode = $_SESSION['postcode'];
    $phone = $_SESSION['phone'];
    $preferredContact = $_SESSION['preferredContact'];
    $product = $_SESSION['product'];
    $quantity = $_SESSION['quantity'];
    $productfeature = $_SESSION['productfeature'];
    $mytextarea = $_SESSION['mytextarea'];
    $cardtype = $_SESSION['cardtype'];
    $cardname = $_SESSION['cardname'];
    $cardnumber = $_SESSION['cardnumber'];
    $cardexpirydate = $_SESSION['cardexpirydate'];
    $cardcvv = $_SESSION['cardcvv'];

    // Clear the session data for the order
    unset($_SESSION['order_id']);
    unset($_SESSION['order_time']);
    unset($_SESSION['order_status']);

    unset($_SESSION['totalprice']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['email']);
    unset($_SESSION['streetaddress']);
    unset($_SESSION['suburbtown']);
    unset($_SESSION['state']);
    unset($_SESSION['postcode']);
    unset($_SESSION['phone']);
    unset($_SESSION['preferredContact']);
    unset($_SESSION['product']);
    unset($_SESSION['quantity']);
    unset($_SESSION['productfeature']);
    unset($_SESSION['mytextarea']);
    unset($_SESSION['cardtype']);
    unset($_SESSION['cardname']);
    unset($_SESSION['cardnumber']);
    unset($_SESSION['cardexpirydate']);
    unset($_SESSION['cardcvv']);
} else {
    echo "<p>No order information found.</p>";
}
?>
<?php include("includes/header.inc") ?>

<head>
    <title>Receipt</title>
</head>

<body class="body">
    <br>
    <main class="enquirecss">
        <div class="containerpayment">
            <form id="paymentform" method="post" action="index.php" novalidate>
                <div class="row">
                    <div class="col">
                        <h3 class="title">Receipt detail</h3>
                        <br>
                        <div class="inputBox1">
                            <p>Reference Receipt on <span id="confirm_orderTime"><?php echo $orderTime; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Order ID:<span id="confirm_orderId"><?php echo $orderId; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Order Status:<span id="confirm_orderStatus"><?php echo $orderStatus; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Order Cost: RM <span id="confirm_totalcost"><?php echo $totalcost; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Your Name:<span id="confirm_name"><?php echo $firstname . ' ' . $lastname; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Email:<span id="confirm_email"><?php echo $email; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Street Address:<span id="confirm_streetaddress"><?php echo $streetaddress; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Suburb/Town:<span id="confirm_suburbtown"><?php echo $suburbtown; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Sate:<span id="confirm_state"><?php echo $state; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Postcode:<span id="confirm_postcode"><?php echo $postcode; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Phone Number:<span id="confirm_phone"><?php echo $phone; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Preferred Contact:<span id="confirm_preferredcontact"><?php echo $preferredContact; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Product TV:<span id="confirm_product"><?php echo $product; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Quantity:<span id="confirm_quantity"><?php echo $quantity; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Product Feature:<span id="confirm_features"><?php echo $productfeature; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Card Type: <span id="confirm_cardtype"><?php echo $cardtype; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Cardholder Name: <span id="confirm_cardname"><?php echo $cardname; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Card Number: <span id="confirm_cardnumber"><?php echo $cardnumber; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Card Expiry Date: <span id="confirm_cardexpirydate"><?php echo $cardexpirydate; ?></span></p>
                        </div>
                        <br>
                        <div class="inputBox1">
                            <p>Secure CC: ****</p>
                        </div>
                        <br>
                    </div>
                </div>
                <input type="submit" value="Back To Homepage" class="submit-btn">
            </form>
        </div>
        <br>
    </main>
</body>

</html>