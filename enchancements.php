<?php include("includes/header.inc")?>
<head>
   <title>Enchancements</title>
</head>
   <body class="body">
   <?php include("includes/menu.inc")?>
   </body>
   <main class="enchancebody">
      <h1>Enhancement</h1>
      <h2>Responsive Design</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Notes: that you can go to all these page:<a href="index.php">Homepage </a><a href="product.php">TV Product </a><a href="enquire.html">Enquire </a><a href="about.html">About</a>to try the responsive feature</strong></p>
         <br>
         <h3>@media (max-width: 1535px)</h3>
         <br>
         <p>Based on the width of the viewport, this code uses media queries to apply different styles to the website.
            The indexscroll-down element is given a 3% right offset with a cursor pointer and the padding of the header and indexicons are set to 15px and 3%, respectively, when the maximum width is 1535px.
         </p>
         <br>
         <h3>@media (max-width: 1460px)</h3>
         <p>The indexsectionText element's padding is set to 0 and 12% with a transition time of 0.2s, and its maximum width is 1460px.</p>
         <br>
         <h3>@media (max-width: 1340px)</h3>
         <p>Media query modifies the styling of several components for displays with a maximum width of 1340px. It changes the font size and margin of the h1 element inside the ".indexsectionText" element, resizes the pictures inside the ".indextv" element to fill the width of the container, and modifies the size and margin of the ".productaside" components.</p>
         <br>
         <h3>@media (max-width: 1195px)</h3>
         <p>Media query alters a number of styles, including the padding and height of ".indexsectionText," the size of the ".indextv" image, and the appearance of the ".indexicons" and ".indexscroll-down a" elements on devices with a maximum width of 1195px. Additionally, it alters the ".indexSection" element's layout so that its content is shown in a single column.</p>
         <br>
         <h3>@media (max-width: 990px)</h3>
         <p>Media query modifies the styles for various components, including the presentation of the ".logoheader" element and the configuration of the ".navigationbar" element, and it targets displays with a maximum width of 990px. Additionally, it modifies the ".productaside" components' size and margin as well as the ".productnav" element's layout.</p>
         <br>
         <h3>@media (max-width: 450px)</h3>
         <p>Media query modifies the size and margin of the ".indextv" and ".productaside" components as well as the layout of the ".wrapper" element for screens with a maximum width of 450px.</p>
         <br>
         <h3>Overall</h3>
         <p>These media queries allow the website to modify its layout and designs to fit multiple screen sizes, improving its usability and accessibility across a range of devices.</p>
      </section>
      <br>
      <h2>Icons Enchancements</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Check the icons on this page: <a href="index.php">Homepage </a></strong></p>
         <br>
         <img src="image/icons.png" class="enchanceicon" alt="icon">
         <img src="image/icons1.png" class="enchanceicon" alt="icon">
         <br>
         <p>As you can see picture above:<br>
            I will breifly explain what I do to get this result. 
            The a tags have a border and background colour and are styled as inline blocks. The link shifts a little to the right and the text's colour and border change when it is hovered over.
            The left margin and border are added by the ctaa class for a tags. The i tags inside of the ctaa tags have a margin-right and are vertically aligned.
            The indexicons class centres the icons on the page and gives the sides padding. This class's i tags provide margin, font-size, and colour attributes. The colour changes and the symbol moves up when it is hovered over.
            Futhuremore, the scroll-down arrow is placed at the bottom right of the page by the indexscroll-down class. This class's i tags provide padding, font-size, colour, and border-radius attributes. The arrow rises when it is hovered over.
         </p>
         <br>
      </section>
      <br>
      <h2>Enquire form with Shadow</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Check the Enquire form on this page: <a href="enquire.php">Enquire </a></strong></p>
         <br>
         <img src="image/enquirepic.png" class="enchanceicon" alt="enquire form">
         <p>For this I will explain the code in order to achieve this:<br>
            In this code, you created a CSS style rule for an element with the class name "enquirecontainer".
            Here is what each property does:
            position: relative;: Sets the position of the element relative to its normal position.
            max-width: 150%;: Sets the maximum width of the element to be 150% of its parent container.
            width: 150%;: Sets the width of the element to be 150% of its parent container.
            background: #0F1A29;: Sets the background color of the element to a dark blue color.
            padding: 25px;: Sets the padding of the element to 25 pixels on all sides.
            border-radius: 8px;: Sets the rounded corners of the element to have an 8 pixel radius.
            box-shadow: 0 0 10px #D7AF6D;: Applies a box shadow effect to the element, with a 10 pixel blur radius and a color of light brown (#D7AF6D).
         </p>
      </section>
      <br>
      <h2>Radio Button Enchancements</h2>
      <br>
      <section class="enchancesection">
         <br>
         <p><strong>Check the Enquire page and Product page on this page: <a href="enquire.php">Enquire </a><a href="product.php">TV Product </a></strong></p>
         <br>
         <img src="image/enchanceradio.png" class="enchanceicon" alt="radio button">
         <p>I will breifly explain of what i did:<br>
            The radio buttons are hidden and replaced with a circle that has a border. When the radio button is selected, a small circle in the center of the radio button appears with an animation.
         </p>
         <br>
      </section>
      <br>
   </main>
   <hr>
   <?php include("includes/footer.inc")?>
</html>