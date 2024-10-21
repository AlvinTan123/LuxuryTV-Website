<?php
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
}
?>

<?php include("includes/header.inc") ?>

<head>
   <title>Enquire</title>
</head>

<body class="body">
   <?php include("includes/menu.inc") ?>
   <br>
   <main class="enquirecss">
      <form id="enquireform" method="post" action="payment.php" novalidate>
         <section class="enquirecontainer">
            <fieldset>
               <legend>Your Name</legend>
               <br>
               <label for="firstname">First name:</label>
               <input type="text" id="firstname" name="firstname" maxlength="25" pattern="[a-zA-Z]+" required="required">
               <label for="lastname">Last name:</label>
               <input type="text" id="lastname" name="lastname" maxlength="25" pattern="[a-zA-Z]+" required="required">
               <br><br>
            </fieldset>
            <br>
            <fieldset>
               <legend>Your E-mail Address</legend>
               <br>
               <label for="email">Email address:</label>
               <input type="email" id="email" name="email" maxlength="40" placeholder="1234567@student.swin.edu.au" required="required">
               <br><br>
            </fieldset>
            <br>
            <fieldset>
               <legend>Address</legend>
               <br>
               <label for="streetaddress">Street address:</label>
               <input type="text" id="streetaddress" name="streetaddress" maxlength="40" required="required">
               <br><br>
               <label for="suburbtown">Suburb/town:</label>
               <input type="text" id="suburbtown" name="suburbtown" maxlength="20" required="required">
               <br><br>
               <label for="state">State:</label>
               <select id="state" name="state" required="required">
                  <option value="" selected disabled>Please select</option>
                  <option value="VIC">VIC start with "3 or 8"</option>
                  <option value="NSW">NSW start with"1 or 2"</option>
                  <option value="QLD">QLD start with "4 or 9"</option>
                  <option value="NT">NT start with "0"</option>
                  <option value="WA">WA start with "6"</option>
                  <option value="SA">SA start with "5"</option>
                  <option value="TAS">TAS start with "7"</option>
                  <option value="ACT">ACT start with "0"</option>
               </select>
               <br><br>
               <label for="postcode">Postcode:</label>
               <input type="text" id="postcode" name="postcode" pattern="\d{4}" maxlength="4">
               <br><br>
            </fieldset>
            <br>
            <fieldset>
               <legend>Contact No.</legend>
               <br>
               <label for="phone">Phone number:</label>
               <input type="text" id="phone" name="phone" maxlength="12" placeholder="123-456-7890" required="required">
               <br><br>
               <div class="enquireradiocontainer">
                  <label>Preferred contact:</label>
                  <br><br>
                  <label class="enquireradio">
                     <input type="radio" name="preferredcontact" id="emails" value="Email">Email
                     <span></span>
                  </label>
                  <label class="enquireradio">
                     <input type="radio" name="preferredcontact" id="post" value="Post">Post
                     <span></span>
                  </label>
                  <label class="enquireradio">
                     <input type="radio" name="preferredcontact" id="phones" value="Phone">Phone
                     <span></span>
                  </label>
               </div>
               <br>
            </fieldset>
            <br>
            <fieldset>
               <legend>TV</legend>
               <br>
               <label for="product">Product:</label>
               <select id="product" name="product" required="required">
                  <option value="">Please select</option>
                  <option value="Samsung 98 NEO QLED 4K QN90A" data-quantity="5">Samsung 98" NEO QLED 4K QN90A</option>
                  <option value="LG: [LG OLED R]" data-quantity="10">LG: [LG OLED R]</option>
                  <option value="Sony: [Sony A9G Master Series]" data-quantity="2">Sony: [Sony A9G Master Series]</option>
               </select>
               <br><br>
               <p>Stocks left: <span id="productquantity"></span></p>
               <br>
               <p>Price: <span id="productprice"></span></p>
               <input type="hidden" name="productprice" id="hidden_productprice" value="" />
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
                     <input type="checkbox" name="productfeature[]" id="feature1" value="feature1"<?php if (in_array('HW-Q600B/XM', explode(', ', $_SESSION['productfeature']))) echo 'checked'; ?>>HW-Q600B/XM
                  </label>
                  <label class="enquirecheck">
                     <input type="checkbox" name="productfeature[]" id="feature2" value="feature2"<?php if (in_array('HW-B650/XM', explode(', ', $_SESSION['productfeature']))) echo 'checked'; ?>>HW-B650/XM
                  </label>
                  <label class="enquirecheck">
                     <input type="checkbox" name="productfeature[]" id="feature3" value="feature3"<?php if (in_array('HW-B550/XM', explode(', ', $_SESSION['productfeature']))) echo 'checked'; ?>>HW-B550/XM
                  </label>
                  <label class="enquirecheck">
                     <input type="checkbox" name="productfeature[]" id="feature4" value="feature4" <?php if (in_array('None', explode(', ', $_SESSION['productfeature']))) echo 'checked'; ?>checked>None
                  </label>
                  <input type="hidden" name="productfeature" id="hidden_productfeature" value="" />
               </form>
               <br><br>
               <div id="featureprice"></div>
               <input type="hidden" name="featureprice" id="hidden_featureprice" value="" />
               <br><br>
            </fieldset>
            <br>
            <fieldset>
               <legend>Get in touch</legend>
               <br>
               <label for="mytextarea"></label>
               <textarea id="mytextarea" name="mytextarea" placeholder="Message" rows="5" cols="50"></textarea>
               <br><br>
            </fieldset>
            <br>
            <p>Total price: <span id="totalprice" value=""></span></p>
            <input type="hidden" name="totalprice" id="hidden_totalprice" value="" />
            <br>
            <button type="submit" id="submit">Pay Now</button>
            <button type="reset" id="reset">Reset</button>
      </form>
      </section>
   </main>
   <?php include("includes/scripts.inc") ?>
</body>
<br>
<hr>
<?php include("includes/footer.inc") ?>
</html>