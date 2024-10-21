<?php
// Check if the file is accessed through a valid flow
$validAccess = isset($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], 'payment.php') !== false || strpos($_SERVER['HTTP_REFERER'], 'fix_order.php') !== false);
$validFormSubmission = isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_ORIGIN']) && (strpos($_SERVER['HTTP_ORIGIN'], 'paymentform') !== false || strpos($_SERVER['HTTP_ORIGIN'], 'fixorderform') !== false);

if (!$validAccess && !$validFormSubmission) {
    // Invalid access attempt
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access to this page is not allowed.');
}

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
$quantity = $_POST["quantity"];
$productfeature = $_POST["productfeature"];
$mytextarea = $_POST["mytextarea"];
$totalprice = $_POST["totalprice"];
$cardtype = $_POST["cardtype"];
$cardname = $_POST["cardname"];
$cardnumber = $_POST["cardnumber"];
$cardexpirydate = $_POST["cardexpirydate"];
$cardcvv = $_POST["cardcvv"];

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
$_SESSION["quantity"] = $quantity;
$_SESSION["productfeature"] = $productfeature;
$_SESSION["mytextarea"] = $mytextarea;
$_SESSION["totalprice"] = $totalprice;
$_SESSION["cardtype"] = $cardtype;
$_SESSION["cardname"] = $cardname;
$_SESSION["cardnumber"] = $cardnumber;
$_SESSION["cardexpirydate"] = $cardexpirydate;
$_SESSION["cardcvv"] = $cardcvv;

// Sanitize and trim the received values
$firstname = isset($_POST["firstname"]) ? trim($_POST["firstname"]) : '';
$lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : '';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
$streetaddress = isset($_POST["streetaddress"]) ? trim($_POST["streetaddress"]) : '';
$suburbtown = isset($_POST["suburbtown"]) ? trim($_POST["suburbtown"]) : '';
$state = isset($_POST["state"]) ? trim($_POST["state"]) : '';
$postcode = isset($_POST["postcode"]) ? trim($_POST["postcode"]) : '';
$phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : '';
$preferredcontact = isset($_POST["preferredcontact"]) ? trim($_POST["preferredcontact"]) : '';
$product = isset($_POST["product"]) ? trim($_POST["product"]) : '';
$quantity = isset($_POST["quantity"]) ? trim($_POST["quantity"]) : '';
$productfeature = isset($_POST["productfeature"]) ? trim($_POST["productfeature"]) : '';
$totalprice = isset($_POST["totalprice"]) ? trim($_POST["totalprice"]) : '';
$mytextarea = isset($_POST["mytextarea"]) ? trim($_POST["mytextarea"]) : '';
$cardtype = isset($_POST["cardtype"]) ? trim($_POST["cardtype"]) : '';
$cardname = isset($_POST["cardname"]) ? trim($_POST["cardname"]) : '';
$cardnumber = isset($_POST["cardnumber"]) ? trim($_POST["cardnumber"]) : '';
$cardexpirydate = isset($_POST["cardexpirydate"]) ? trim($_POST["cardexpirydate"]) : '';
$cardcvv = isset($_POST["cardcvv"]) ? trim($_POST["cardcvv"]) : '';


// Remove backslashes from the values
$firstname = stripslashes($firstname);
$lastname = stripslashes($lastname);
$email = stripslashes($email);
$streetaddress = stripslashes($streetaddress);
$suburbtown = stripslashes($suburbtown);
$state = stripslashes($state);
$postcode = stripslashes($postcode);
$phone = stripslashes($phone);
$preferredcontact = stripslashes($preferredcontact);
$product = stripslashes($product);
$quantity = stripslashes($quantity);
$productfeature = stripslashes($productfeature);
$totalprice  = stripslashes($totalprice);
$mytextarea = stripslashes($mytextarea);
$cardtype = stripslashes($cardtype);
$cardname = stripslashes($cardname);
$cardnumber = stripslashes($cardnumber);
$cardexpirydate = stripslashes($cardexpirydate);
$cardcvv  = stripslashes($cardcvv);

// Remove HTML control characters from the values
$firstname = htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8');
$lastname = htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$streetaddress = htmlspecialchars($streetaddress, ENT_QUOTES, 'UTF-8');
$suburbtown = htmlspecialchars($suburbtown, ENT_QUOTES, 'UTF-8');
$state = htmlspecialchars($state, ENT_QUOTES, 'UTF-8');
$postcode = htmlspecialchars($postcode, ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$preferredcontact = htmlspecialchars($preferredcontact, ENT_QUOTES, 'UTF-8');
$product = htmlspecialchars($product, ENT_QUOTES, 'UTF-8');
$quantity = htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8');
$productfeature = htmlspecialchars($productfeature, ENT_QUOTES, 'UTF-8');
$totalprice = htmlspecialchars($totalprice, ENT_QUOTES, 'UTF-8');
$mytextarea = htmlspecialchars($mytextarea, ENT_QUOTES, 'UTF-8');
$cardtype = htmlspecialchars($cardtype, ENT_QUOTES, 'UTF-8');
$cardname = htmlspecialchars($cardname, ENT_QUOTES, 'UTF-8');
$cardnumber = htmlspecialchars($cardnumber, ENT_QUOTES, 'UTF-8');
$cardexpirydate = htmlspecialchars($cardexpirydate, ENT_QUOTES, 'UTF-8');
$cardcvv = htmlspecialchars($cardcvv, ENT_QUOTES, 'UTF-8');
?>

<?php
//validate postcode function
function isValidPostcode($postcode, $state)
{
    $firstDigit = substr($postcode, 0, 1);
    $selectedState = '';

    switch ($firstDigit) {
        case '3':
        case '8':
            $selectedState = 'VIC';
            break;
        case '1':
        case '2':
            $selectedState = 'NSW';
            break;
        case '4':
        case '9':
            $selectedState = 'QLD';
            break;
        case '0':
            if ($state === 'NT' || $state === 'ACT') {
                $selectedState = 'ACT';
            } else {
                $selectedState = 'NT';
            }
            break;
        case '6':
            $selectedState = 'WA';
            break;
        case '5':
            $selectedState = 'SA';
            break;
        case '7':
            $selectedState = 'TAS';
            break;
        default:
            $selectedState = '';
    }

    return $selectedState === $state && preg_match('/^\d{4}$/', $postcode);
}
?>

<?php
// Initialize an array to store the validation errors
$errors = array();

// Validate customer details (Part 1 rules)
if (empty($firstname)) {
    $errors["firstname"] = 'First name is required.';
} elseif (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
    $errors["firstname"] = 'Your first name must only contain alpha characters';
}

if (empty($lastname)) {
    $errors["lastname"] = 'Last name is required.';
} elseif (!preg_match('/^[a-zA-Z\-]+$/', $lastname)) {
    $errors["lastname"] = 'Your last name must only contain alpha characters and hyphens';
}

if (empty($email)) {
    $errors["email"] = 'Email is required.';
} elseif (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
    $errors["email"] = 'Please enter a valid email address';
}

if (empty($streetaddress)) {
    $errors["streetaddress"] = "Please fill your street's address so we can ship your TV!";
}

if (empty($suburbtown)) {
    $errors["suburbtown"] = 'Please fill in your suburb town.';
}

if (empty($state)) {
    $errors["state"] = 'You must select a state.';
}

if (empty($postcode)) {
    $errors["postcode"] = 'Postcode is required.';
}
// Perform post code check against state
elseif (!isValidPostcode($postcode, $state)) {
    $errors["postcode"] = 'Invalid post code for the selected state.';
}

if (empty($phone)) {
    $errors["phone"] = 'Phone is required.';
} elseif (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
    $errors["phone"] = 'Please enter a valid phone number in the format XXX-XXX-XXXX';
}

if (empty($preferredcontact)) {
    $errors["preferredcontact"] = 'Preferred Contact is required.';
}

// Validate product quantity and credit card details (Part 2 rules)
if (!is_numeric($quantity) || $quantity <= 0) {
    $errors["quantity"] = 'Quantity must be a positive number.';
}

if (empty($product)) {
    $errors["product"] = 'You must select a product.';
}

if (empty($productfeature)) {
    $errors["productfeature"] = 'Please select at least one feature or None';
}

// Perform additional checks on credit card details
function getCardType()
{
    $cardType = "";

    if (isset($_POST["cardtype"])) {
        $cardType = $_POST["cardtype"];
    }

    return $cardType;
}

$creditCardNumber = $_POST["cardnumber"];
$cardType = getCardType();

if (empty($cardType)) {
    $errors["cardtype"] = 'Please select your credit card type!';
}

if (empty($cardname)) {
    $errors["cardname"] = 'Card Name is required.';
} elseif (!preg_match('/^[A-Za-z ]{1,40}$/', $cardname)) {
    $errors["cardname"] = 'Please enter a valid name on the credit card.(maximum of 40 characters, alphabetical and space only)';
}

if (!preg_match('/^5[1-5][0-9]{14}$/', $creditCardNumber) && $cardType == "Mastercard") {
    $errors["cardnumber"] = "Please type the valid card number (MasterCard has 16 digits and starts with digits 51 through 55)";
}

if (!preg_match('/^3[47][0-9]{13}$/', $creditCardNumber) && $cardType == "AmEx") {
    $errors["cardnumber"] = "Please type the valid card number (American Express has 15 digits and starts with 34 or 37)";
}

if (!preg_match('/^4[0-9]{15}$/', $creditCardNumber) && $cardType == "Visa") {
    $errors["cardnumber"] = "Please type the valid card number (Visa cards have 16 digits and start with a 4)";
}

if (!preg_match('/^[0-9]{15,16}$/', $cardnumber)) {
    $errors["cardnumber"] = 'Credit card number must be 15 or 16 digits.';
}

if (empty($cardexpirydate)) {
    $errors["cardexpirydate"] = 'Expiry date of your card is required.';
} elseif (!preg_match('/^(0[1-9]|1[0-2])-(\d{2})$/', $cardexpirydate)) {
    $errors["cardexpirydate"] = 'Please enter valid expiry date!';
}


$cardCVV = $_POST['cardcvv'];
$cardType = getCardType();

if (empty($cardCVV)) {
    $errors["cardcvv"] = 'CVV is required.';
}

if (!(preg_match('/^\d{4}$/', $cardCVV)) && $cardType == "AmEx") {
    $errors["cardcvv"] = "Please enter a valid CVV based on card type! (American Express has a 4-digit CVV)";
}

if (!(preg_match('/^[0-9]{3,4}$/', $cardcvv)) && $cardType != "AmEx") {
    $errors["cardcvv"] = 'CVV must be a 3 or 4 digit number.';
}

// If there are errors, redirect back to fix_order.php
if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["formData"] = $_POST;

    echo '<script>window.location.href = "fix_order.php";</script>';
    exit;
}

// If validation passes, continue with processing and saving the order
if (empty($errors)) {
    require_once('settings.php');

    $connection = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );
    // Checks if connection is successful
    if (!$connection) {
        // Displays an error message
        echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
    } else {
        // Upon successful connection

        $_SESSION["errors"] = $errors;
        $_SESSION["formData"] = $_POST;

        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["streetaddress"] = $streetaddress;
        $_SESSION["suburbtown"] = $suburbtown;
        $_SESSION["state"] = $state;
        $_SESSION["postcode"] = $postcode;
        $_SESSION["preferredContact"] = $preferredContact;
        $_SESSION["product"] = $product;
        $_SESSION["productprice"] = $productprice;
        $_SESSION["quantity"] = $quantity;
        $_SESSION["productfeature"] = $productfeature;
        $_SESSION["productfeature"] = $productfeature;
        $_SESSION["mytextarea"] = $mytextarea;
        $_SESSION["totalprice"] = $totalprice;
        $_SESSION["cardtype"] = $cardtype;
        $_SESSION["cardname"] = $cardname;
        $_SESSION["cardnumber"] = $cardnumber;
        $_SESSION["cardexpirydate"] = $cardexpirydate;
        $_SESSION["cardcvv"] = $cardcvv;

        // Calculate total cost
        if (isset($_SESSION["totalprice"])) {
            $totalprice = $_SESSION["totalprice"];
        } else {
            $totalprice = ($productprice * $quantity) + $featureprice;
        }
        // Check if the table exists
        $tableExists = mysqli_query($connection, "SHOW TABLES LIKE 'orders'");

        // If the table doesn't exist, create it
        if ($tableExists->num_rows == 0) {
            // Define the SQL query to create the table
            $createTableQuery = "CREATE TABLE `orders` (
            order_id INT AUTO_INCREMENT PRIMARY KEY,
            order_cost DECIMAL(20,0),
            order_time DATETIME,
            order_status VARCHAR(10),
            FirstName VARCHAR(25),
            LastName VARCHAR(25),
            Email VARCHAR(40),
            StreetAddress VARCHAR(40),
            SuburbTown VARCHAR(20),
            State VARCHAR(3),
            Postcode INT(4),
            Phone INT(12),
            PreferredContact VARCHAR(10),
            Product VARCHAR(30),
            Quantity INT(5),
            ProductFeature VARCHAR(20),
            MyTextarea TEXT,
            CardType VARCHAR(10),
            CardName VARCHAR(40),
            CardNumber VARCHAR(19),
            CardExpiryDate INT(5),
            CardCVV INT(4)
        )";

            // Execute the query to create the table
            if (mysqli_query($connection, $createTableQuery)) {
                echo "Table has been created successfully.";
            } else {
                echo "Error creating table: " . mysqli_error($connection);
            }
        }

        $sql_table = "orders";

        // Get the current date and time
        $orderTime = date("Y-m-d H:i:s");

        // Store the order time in the session
        $_SESSION["order_time"] = $orderTime;

        // Insert the order into the orders table
        $insertOrderQuery = "INSERT INTO `$sql_table` (
            order_cost, order_time, order_status,
            FirstName, LastName, Email, StreetAddress, SuburbTown, State, Postcode, Phone, PreferredContact,
            Product, Quantity, ProductFeature,
            MyTextarea, CardType, CardName, CardNumber, CardExpiryDate, CardCVV
        ) SELECT * FROM (SELECT
            '$totalprice', '$orderTime', 'Pending',
            '$firstname', '$lastname', '$email', '$streetaddress', '$suburbtown', '$state', '$postcode', '$phone', '$preferredContact',
            '$product', '$quantity', '$productfeature',
            '$mytextarea', '$cardtype', '$cardname', '$cardnumber', '$cardexpirydate', '$cardcvv'
        ) AS tmp WHERE NOT EXISTS (
            SELECT order_time FROM `$sql_table` WHERE order_time = NOW()
        ) LIMIT 1";

        // Execute the query to insert the order
        $result = mysqli_query($connection, $insertOrderQuery);

        if ($result) {
            // Get the order ID of the inserted record
            $orderId = mysqli_insert_id($connection);

            // Store the order ID and order status in the session
            $_SESSION["order_id"] = $orderId;
            $_SESSION["order_status"] = 'Pending';
            $_SESSION["order_time"] = date("Y-m-d H:i:s");

            echo '<script>window.location.href = "receipt.php";</script>';
            exit;
        } else {
            // Handle the case where the insertion failed
            echo 'Error inserting order: ' . mysqli_error($connection);
        }
    }
}
?>

