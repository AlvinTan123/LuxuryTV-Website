<?php
session_start();

// Include necessary files and establish database connection
require_once('settings.php');

$connection = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$connection) {
    // Displays an error message
    echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
} else {
    $tableExists = mysqli_query($connection, "SHOW TABLES LIKE 'manageraccount'");

    if ($tableExists->num_rows == 0) {
        $createTableQuery = "CREATE TABLE `manageraccount` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";

        // Execute the query to create the table
        if (mysqli_query($connection, $createTableQuery)) {
            echo "Table has been created successfully.";
        } else {
            echo "Error creating table: " . mysqli_error($connection);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql_table = "manageraccount";

    // Define error variables
    $usernameErr = $passwordErr = "";
    $username = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Perform server-side validation
        $isValid = true;

        // Check if username is empty or already exists
        if (empty($username)) {
            $usernameErr = "Username is required.";
            $isValid = false;
        } else {
            // Escape username to prevent SQL injection
            $escapedUsername = mysqli_real_escape_string($connection, $username);

            // Perform database query to check if username exists
            $query = "SELECT id FROM `manageraccount` WHERE username = '$escapedUsername'";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                // Username already exists
                $usernameErr = "Username already exists.";
                $isValid = false;
            }
        }

        // Check if password meets your desired rules
        if (empty($password)) {
            $passwordErr = "Password is required.";
            $isValid = false;
        }

        // If all validation checks pass, insert manager's information into the database
        if ($isValid) {
            // Escape password to prevent SQL injection
            $escapedPassword = mysqli_real_escape_string($connection, $password);

            // Insert the username and password into the database
            $query = "INSERT INTO `manageraccount` (username, password) VALUES ('$escapedUsername', '$escapedPassword')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Password successfully inserted into the database
                // Redirect to the manager login page or display a success message
                echo '<script>window.location.href = "manager_login.php";</script>';
                exit;
            } else {
                // Error occurred while inserting the password
                // Handle the error accordingly
                echo "Error: " . mysqli_error($connection);
            }
        }
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
<?php include("includes/header.inc") ?>

<head>
    <title>Manager Registration</title>
</head>

<body class="body">
    <br><br><br><br><br><br><br>
    <h1 class="title1">Manager Registration</h1>
    <div class="containerregister">
        <!-- HTML form for manager registration -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
            <?php if (isset($usernameErr)) : ?>
                <span class="error"><?php echo $usernameErr; ?></span>
            <?php endif; ?>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password">
            <?php if (isset($passwordErr)) : ?>
                <span class="error"><?php echo $passwordErr; ?></span>
            <?php endif; ?>
            <br><br>
            <input type="submit" value="Register">
            <br>
            <?php if (isset($username) && isset($password)) : ?>
                <br>
                <p>Already have an account? Login as a manager:</p>
                <a href="manager_login.php" class="button">Manager Login</a>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>