<?php

// Destroy the session and redirect to desired page after logging out
session_start();
session_destroy();
?>

<?php include("includes/header.inc") ?>

<head>
    <title>Manager Login</title>
</head>
<body class="body">
    <br><br><br><br><br><br><br>
    <h1 class="title1">Manager Logout</h1>
    <div class="containermanager">
    <!-- HTML form for manager logout -->
    <button class="button" onclick="location.href='manager_login.php'">Login as a Manager</button>
    
    <button class="button" onclick="location.href='manager_registration.php'">Register as New Manager</button>
    
    <button class="button" onclick="location.href='index.php'">Back to Homepage</button>
 
</div>
</body>

</html>