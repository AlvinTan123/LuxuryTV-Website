<?php include("includes/header.inc")?>
<head>
   <title>Enchancements2</title>
</head>
   <body class="body">
   <?php include("includes/menu.inc")?>
   </body>
   <main class="enchancebody">
      <h1>Javascript Enhancement 2</h1>
      <br>
      <h2>1.Calulation</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Notes: that you can go this page:<a href="enquire.php">Enquire </a><strong>to try the Calulation</strong></p>
         <br>
         <h3>The increment and decrement button</h3>
         <br>
         <img src="image/incrementbutton.png" class="enchanceicon" alt="incrementbutton">
         <br><br>
         <p>
            I have created these JavaScript functions to handle the increment and decrement operations for a numeric value displayed on my webpage.
            Here's a breakdown of what each function does:
            <br><br>
            incrementValue(): This function is triggered when an increment button is clicked. It first retrieves the selected option from a dropdown list and 
            the current numeric value displayed on the webpage. It also gets the quantity associated with the selected option. The new value is calculated by adding 1 
            to the current value and then taking the remainder when divided by the quantity plus 1. This ensures the value stays within the specified limit. If the 
            current value is less than the quantity, it updates the displayed value with the new value, formatted as a two-digit number with leading zeros. Additionally, 
            it calls a function called calculateTotalPrice() to calculate the total price based on the updated value.
            <br><br>
            decrementValue(): This function is triggered when a decrement button is clicked. It retrieves the current numeric value displayed on the webpage. 
            If the current value is greater than 1, it subtracts 1 from the current value and updates the displayed value. Similar to the incrementValue() function, 
            it also calls the calculateTotalPrice() function to recalculate the total price based on the updated value.
            <br><br>
         </p>
         <br>
         <img src="image/javenh1.png" class="enchance2icon" alt="incrementbutton">
         <br><br>
         <h3>How all the calculation works</h3>
         <p>
            These are the functions that are used to handle the calculations and updates related to a product's price and quantity on my webpage.
            <br><br>
            1. calculateTotalPrice(): This function calculates the total price based on the selected product, quantity, and any additional features selected. 
            It iterates over the selected feature checkboxes and updates the "noneCheckbox" if necessary. Then it retrieves the product and feature prices, 
            calculates the total price, and updates the relevant elements on the webpage.
            <br><br>
            2. calculateProductPrice(): This function retrieves the selected product option and its corresponding price. It updates the product price element and returns the product price.
            <br><br>
            3. getProductPrice(): This function takes an option as input and returns the corresponding price from a predefined price map.
            <br><br>
            4.calculateFeaturePrice(): This function calculates the total price of the selected features by iterating over the checkboxes and retrieving their prices. 
            It updates the feature price element and returns the feature price.
            <br><br>
            5.getFeaturePrice(): This function takes a checkbox as input and returns the corresponding price from a predefined price map.
            <br><br>
            6.updatePrice(): This function is called to reset the increment value to 1 and recalculate the total price by calling calculateTotalPrice().
         </p>
         <br>
      </section>
      <br>
      <h2>2.Prefill Form</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Notes: you need to fill up this page:<a href="enquire.php">Enquire </a>and click the Cancel button on this page:<a href="payment.html">Payment </a><strong>to try the Prefill Form function</strong></p>
         <br>
         <h3>Prefill Form function</h3>
         <br>
         <img src="image/prefill.png" class="enchance2icon" alt="prefillform">
         <img src="image/prefill2.png" class="enchance2icon" alt="prefillform2">
         <br><br>
         <p>
        
         The prefillForm() function is responsible for populating form fields on a webpage with previously entered data stored in the sessionStorage. 
         Let's me break down the code and explain what each part does:
         <br><br>
         1.The code starts with an if statement that checks if the firstname key exists in the session storage. If it exists, it means that the form fields have previously 
           been filled and stored in the session storage. In that case, the values are retrieved from the session storage and set in their corresponding form fields on the webpage.
         <br><br>
         2.The next section handles the radio buttons for preferred contact, a textarea field, and a total price field. It retrieves the stored values from the session storage
           and sets them in the corresponding elements on the webpage
         <br><br>
         3.The final section deals with checkboxes for product features. It retrieves the stored value for productfeature from the session storage and sets the checkboxes 
           accordingly based on the stored values.
         <br><br>
         4.After prefilling the form fields, the updatePrice() function is called to perform any necessary calculations or updates related to the form.
         <br><br>
         </p>
         <br>
      </section>
</main>
<hr>
<?php include("includes/footer.inc")?>
</html>