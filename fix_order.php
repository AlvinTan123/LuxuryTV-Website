<?php
// Check if the file is accessed through a valid flow
if (!isset($_SERVER['HTTP_REFERER']) || (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'process_order.php') === false)) {
    // Invalid access attempt
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access to this page is not allowed.');
}

// Start the session to access the stored form data and errors
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store the data in session variables
    $_SESSION["firstname"] = $_POST["firstname"];
    $_SESSION["lastname"] = $_POST["lastname"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["streetaddress"] = $_POST["streetaddress"];
    $_SESSION["suburbtown"] = $_POST["suburbtown"];
    $_SESSION["state"] = $_POST["state"];
    $_SESSION["postcode"] = $_POST["postcode"];
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["preferredcontact"] = $_POST["preferredcontact"];
    $_SESSION["product"] = $_POST["product"];
    $_SESSION["productprice"] = $_POST["productprice"];
    $_SESSION["quantity"] = $_POST["quantity"];
    $_SESSION["productfeature"] = $_POST["productfeature"];
    $_SESSION["featureprice"] = $_POST["featureprice"];
    $_SESSION["mytextarea"] = $_POST["mytextarea"];
    $_SESSION["totalprice"] = $_POST["totalprice"];
    $_SESSION["cardtype"] = $_POST["cardtype"];
    $_SESSION["cardname"] = $_POST["cardname"];
    $_SESSION["cardnumber"] = $_POST["cardnumber"];
    $_SESSION["cardexpirydate"] = $_POST["cardexpirydate"];
    $_SESSION["cardcvv"] = $_POST["cardcvv"];
}

// Retrieve the stored form data and errors, if any
$formData = isset($_SESSION['formData']) ? $_SESSION['formData'] : array();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();

// Clear the stored form data and errors
unset($_SESSION['formData']);
unset($_SESSION['errors']);
?>

<?php include("includes/header.inc") ?>
<h1 class="fixh1">Fix Order Form</h1>
<br>

<body class="body">
    <main class="enquirecss">
        <form action="process_order.php" method="post" novalidate>
            <section class="enquirecontainer">
                <fieldset>
                    <legend>Your Name</legend>
                    <br>
                    <!-- Add your form fields -->
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo isset($formData['firstname']) ? htmlspecialchars($formData['firstname'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <?php if (isset($errors['firstname'])) : ?>
                        <br>
                        <span class="error"><?php echo "Error: " . $errors['firstname']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo isset($formData['lastname']) ? htmlspecialchars($formData['lastname'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['lastname'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['lastname']; ?></span>
                    <?php endif; ?>
                    <br><br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Your E-mail Address</legend>
                    <br>
                    <label for="email">Email address:</label>
                    <input type="email" id="email" name="email" placeholder="1234567@student.swin.edu.au" value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['email'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['email']; ?></span>
                    <?php endif; ?>
                    <br><br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Address</legend>
                    <br>
                    <label for="streetaddress">Street address:</label>
                    <input type="text" id="streetaddress" name="streetaddress" value="<?php echo isset($formData['streetaddress']) ? htmlspecialchars($formData['streetaddress'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['streetaddress'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['streetaddress']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <label for="suburbtown">Suburb/town:</label>
                    <input type="text" id="suburbtown" name="suburbtown" value="<?php echo isset($formData['suburbtown']) ? htmlspecialchars($formData['suburbtown'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['suburbtown'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['suburbtown']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <label for="state">State:</label>
                    <select id="state" name="state" required="required">
                        <option value="" selected disabled>Please select</option>
                        <option value="VIC" <?php echo isset($formData['state']) && $formData['state'] === 'VIC' ? 'selected' : ''; ?>>VIC start with "3 or 8"</option>
                        <option value="NSW" <?php echo isset($formData['state']) && $formData['state'] === 'NSW' ? 'selected' : ''; ?>>NSW start with "1 or 2"</option>
                        <option value="QLD" <?php echo isset($formData['state']) && $formData['state'] === 'QLD' ? 'selected' : ''; ?>>QLD start with "4 or 9"</option>
                        <option value="NT" <?php echo isset($formData['state']) && $formData['state'] === 'NT' ? 'selected' : ''; ?>>NT start with "0"</option>
                        <option value="WA" <?php echo isset($formData['state']) && $formData['state'] === 'WA' ? 'selected' : ''; ?>>WA start with "6"</option>
                        <option value="SA" <?php echo isset($formData['state']) && $formData['state'] === 'SA' ? 'selected' : ''; ?>>SA start with "5"</option>
                        <option value="TAS" <?php echo isset($formData['state']) && $formData['state'] === 'TAS' ? 'selected' : ''; ?>>TAS start with "7"</option>
                        <option value="ACT" <?php echo isset($formData['state']) && $formData['state'] === 'ACT' ? 'selected' : ''; ?>>ACT start with "0"</option>
                    </select>
                    <br>
                    <?php if (isset($errors['state'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['state']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <label for="postcode">Postcode:</label>
                    <input type="text" id="postcode" name="postcode" value="<?php echo isset($formData['postcode']) ? htmlspecialchars($formData['postcode'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['postcode'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['postcode']; ?></span>
                    <?php endif; ?>
                    <br><br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Contact No.</legend>
                    <br>
                    <label for="phone">Phone number:</label>
                    <input type="text" id="phone" name="phone" placeholder="123-456-7890" value="<?php echo isset($formData['phone']) ? htmlspecialchars($formData['phone'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <br>
                    <?php if (isset($errors['phone'])) : ?>
                        <span class="error"><?php echo $errors['phone']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <div class="enquireradiocontainer">
                        <label>Preferred contact:</label>
                        <br><br>
                        <label class="enquireradio">
                            <input type="radio" name="preferredcontact" id="emails" value="Email" <?php echo isset($formData['preferredcontact']) && $formData['preferredcontact'] === 'Email' ? 'checked' : ''; ?>>
                            Email
                            <span></span>
                        </label>
                        <label class="enquireradio">
                            <input type="radio" name="preferredcontact" id="post" value="Post" <?php echo isset($formData['preferredcontact']) && $formData['preferredcontact'] === 'Post' ? 'checked' : ''; ?>>
                            Post
                            <span></span>
                        </label>
                        <label class="enquireradio">
                            <input type="radio" name="preferredcontact" id="phones" value="Phone" <?php echo isset($formData['preferredcontact']) && $formData['preferredcontact'] === 'Phone' ? 'checked' : ''; ?>>
                            Phone
                            <span></span>
                        </label>
                        <br><br>
                        <?php if (isset($errors['preferredcontact'])) : ?>
                            <span class="error"><?php echo "Error: " . $errors['preferredcontact']; ?></span>
                        <?php endif; ?>
                    </div>
                    <br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>TV</legend>
                    <br>
                    <label for="product">Product:</label>
                    <select id="product" name="product" required="required">
                        <option value="" <?php echo isset($formData['product']) && $formData['product'] === '' ? 'selected' : ''; ?>>Please select</option>
                        <option value="Samsung 98 NEO QLED 4K QN90A" data-quantity="5" <?php echo isset($formData['product']) && $formData['product'] === 'Samsung 98 NEO QLED 4K QN90A' ? 'selected' : ''; ?>>Samsung 98" NEO QLED 4K QN90A</option>
                        <option value="LG: [LG OLED R]" data-quantity="10" <?php echo isset($formData['product']) && $formData['product'] === 'LG: [LG OLED R]' ? 'selected' : ''; ?>>LG: [LG OLED R]</option>
                        <option value="Sony: [Sony A9G Master Series]" data-quantity="2" <?php echo isset($formData['product']) && $formData['product'] === 'Sony: [Sony A9G Master Series]' ? 'selected' : ''; ?>>Sony: [Sony A9G Master Series]</option>
                    </select>
                    <br>
                    <?php if (isset($errors['product'])) : ?>
                        <span class="error"><?php echo "Error: " . $errors['product']; ?></span>
                    <?php endif; ?>
                    <br><br>
                    <p>Stocks left: <span id="productquantity"><?php echo isset($formData['product']) ? getProductQuantity($formData['product']) : ''; ?></span></p>
                    <br>
                    <p>Price: <span id="productprice"><?php echo isset($formData['product']) ? getProductPrice($formData['product']) : ''; ?></span></p>
                    <input type="hidden" name="productprice" id="hidden_productprice" value="" />
                    <br>
                    <br>
                    <div class="wrapperbuttoninc">
                        <span class="enquireminus">-</span>
                        <span id="quantity" class="equirenum" value="">01</span>
                        <input type="hidden" name="quantity" id="hidden_quantity" value="" />
                        <span class="enquireplus">+</span>
                    </div>
                    <br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Product features</legend>
                    <br>
                    <form class="enquirecheckbox">
                        <label class="enquirecheck">
                            <input type="checkbox" name="productfeature[]" id="feature1" value="feature1" <?php echo isset($formData['productfeature']) && in_array('HW-Q600B/XM', $formData['productfeature']) ? 'checked' : ''; ?>>HW-Q600B/XM
                        </label>
                        <label class="enquirecheck">
                            <input type="checkbox" name="productfeature[]" id="feature2" value="feature2" <?php echo isset($formData['productfeature']) && in_array('HW-B650/XM', $formData['productfeature']) ? 'checked' : ''; ?>>HW-B650/XM
                        </label>
                        <label class="enquirecheck">
                            <input type="checkbox" name="productfeature[]" id="feature3" value="feature3" <?php echo isset($formData['productfeature']) && in_array('HW-B550/XM', $formData['productfeature']) ? 'checked' : ''; ?>>HW-B550/XM
                        </label>
                        <label class="enquirecheck">
                            <input type="checkbox" name="productfeature[]" id="feature4" value="feature4" <?php echo isset($formData['productfeature']) && $formData['productfeature'] === 'None' ? 'checked' : ''; ?>>None
                        </label>
                        <input type="hidden" name="hidden_productfeature" id="hidden_productfeature" value="<?php echo isset($formData['productfeature']) ? htmlspecialchars(implode(',', $formData['productfeature']), ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        <br>
                        <?php if (isset($errors['productfeature'])) : ?>
                            <span class="error"><?php echo "Error: " . $errors['productfeature']; ?></span>
                        <?php endif; ?>
                    </form>
                    <br>
                    <div id="featureprice"></div>
                    <input type="hidden" name="featureprice" id="hidden_featureprice" value="" />
                    <br><br>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Get in touch</legend>
                    <br>
                    <label for="mytextarea">Message:</label>
                    <br><br>
                    <textarea id="mytextarea" name="mytextarea" placeholder="Message" rows="5" cols="50"><?php echo isset($formData['mytextarea']) ? htmlspecialchars($formData['mytextarea'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                    <br><br>
                </fieldset>
                <br>
                <p>Total price: <span id="totalprice" value=""></span></p>
                <input type="hidden" name="totalprice" id="hidden_totalprice" value="" />
                <br>
                <fieldset>
                    <div class="col">
                        <h3 class="title">Payment</h3>
                        <br>
                        <div class="inputBox">
                            <span>Cards accepted :</span>
                            <br><br>
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
                            <br><br>
                            <?php if (isset($errors['cardtype'])) : ?>
                                <span class="error"><?php echo "Error: " . $errors['cardtype']; ?></span>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="inputBox">
                            <span>Name on card :</span>
                            <input type="text" id="cardname" name="cardname" placeholder="Tan Wen Hau" required="required" maxlength="40">
                            <br>
                            <?php if (isset($errors['cardname'])) : ?>
                                <span class="error"><?php echo "Error: " . $errors['cardname']; ?></span>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="inputBox">
                            <span>Credit card number :</span>
                            <input type="text" id="cardnumber" name="cardnumber" placeholder="1111-2222-3333-4444" maxlength="19" required="required">
                            <br>
                            <?php if (isset($errors['cardnumber'])) : ?>
                                <span class="error"><?php echo "Error: " . $errors['cardnumber']; ?></span>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="inputBox">
                            <span>Credit card expiry date:</span>
                            <input type="text" id="cardexpirydate" name="cardexpirydate" placeholder="MM-YY" maxlength="5" required="required">
                            <br>
                            <?php if (isset($errors['cardexpirydate'])) : ?>
                                <span class="error"><?php echo "Error: " . $errors['cardexpirydate']; ?></span>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="password" id="cardcvv" name="cardcvv" placeholder="123" maxlength="4" required="required">
                            <br>
                            <?php if (isset($errors['cardcvv'])) : ?>
                                <span class="error"><?php echo "Error: " . $errors['cardcvv']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <button type="submit" id="submit">Pay Now</button>
                </fieldset>
                <br>
        </form>
        </section>
    </main>

</body>
<?php

if (isset($errors['productfeature'])) {
    $storedFeatureStr = isset($formData['productfeature']) ? htmlspecialchars($formData['productfeature'], ENT_QUOTES, 'UTF-8') : '';
    $storedFeatures = explode(', ', $storedFeatureStr);
    $productfeature = isset($_POST['productfeature']) ? $_POST['productfeature'] : [];

    if (in_array('HW-Q600B/XM', $storedFeatures)) {
        echo 'document.getElementById("feature1").checked = true;';
    }
    if (in_array('HW-B650/XM', $storedFeatures)) {
        echo 'document.getElementById("feature2").checked = true;';
    }
    if (in_array('HW-B550/XM', $storedFeatures)) {
        echo 'document.getElementById("feature3").checked = true;';
    }
    if (in_array('None', $storedFeatures)) {
        echo 'document.getElementById("feature4").checked = true;';
    }

    $featureStr = implode(', ', $productfeature);
    $_SESSION['productfeature'] = $featureStr;
    // Process the form data or store it in the database

}

function getProductQuantity($selectedProduct)
{
    $productQuantities = [
        "Samsung 98 NEO QLED 4K QN90A" => 5,
        "LG: [LG OLED R]" => 10,
        "Sony: [Sony A9G Master Series]" => 2
    ];

    return isset($productQuantities[$selectedProduct]) ? $productQuantities[$selectedProduct] : '';
}
function getProductPrice($selectedProduct)
{
    $productPrices = [
        "Samsung 98 NEO QLED 4K QN90A" => 49999.00,
        "LG: [LG OLED R]" => 131249.00,
        "Sony: [Sony A9G Master Series]" => 18399.00
    ];

    return isset($productPrices[$selectedProduct]) ? $productPrices[$selectedProduct] : '';
}
?>
</body>

</html>