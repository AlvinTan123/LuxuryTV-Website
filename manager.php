<?php include("includes/header.inc") ?>

<head>
    <title>Manager Page</title>
</head>

<body class="body">
    <?php include("includes/menu.inc") ?>
    <br>
    <div class="logoutcontainer">
        <h1 class="title2">Manager Page</h1>
        <!-- Logout button -->
        <a href="manager_logout.php" class="logout-button">Logout</a>
    </div>
    <br>
    <?php
    session_start();

    // Necessary files and establish database connection
    require_once('settings.php');

    $connection = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    if (!$connection) {
        // Display an error message
        echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
    } else {

        // Check if the Manager is logged in
        if (isset($_SESSION['managerLoggedIn']) && $_SESSION['managerLoggedIn'] === true) {
            // Manager is logged in
            $managerLoggedIn = true;
        } else {
            // Manager is not logged in
            $managerLoggedIn = false;
        }

        if ($managerLoggedIn) {
            // Process order status updates or cancellation
            // Check if a form is submitted for order status update
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateStatus'])) {
                $orderId = $_POST['orderId'];
                $newStatus = $_POST['newStatus'];

                // Update the order status in the database
                $updateStatusQuery = "UPDATE `orders` SET `order_status` = '$newStatus' WHERE `order_id` = $orderId";
                $connection->query($updateStatusQuery);
            }

            // Retrieve and display order data based on query parameters

            // Default query to retrieve all orders
            $query = "SELECT order_id, order_time, Product, Quantity, ProductFeature, order_cost, CONCAT(FirstName, ' ', LastName) AS customer_name, order_status FROM `orders`";

            // Check if specific query parameters are provided
            if (isset($_GET['customerName'])) {
                $customerName = $_GET['customerName'];
                $query .= " WHERE CONCAT(FirstName, ' ', LastName) LIKE '%$customerName%'";
            }
            if (isset($_GET['product'])) {
                $productName = $_GET['product'];
                if (!empty($productName)) {
                    if (strpos($query, 'WHERE') !== false) {
                        // If a WHERE clause already exists in the query, append the condition with an AND operator
                        $query .= " AND Product LIKE '%$productName%'";
                    } else {
                        // If there is no WHERE clause, add the condition with a WHERE keyword
                        $query .= " WHERE Product LIKE '%$productName%'";
                    }
                }
            }
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                if (!empty($status)) {
                    if (strpos($query, 'WHERE') !== false) {
                        // If a WHERE clause already exists in the query, append the condition with an AND operator
                        $query .= " AND order_status = '$status'";
                    } else {
                        // If there is no WHERE clause, add the condition with a WHERE keyword
                        $query .= " WHERE order_status = '$status'";
                    }
                }
            }

            if (isset($_GET['sortBy']) && $_GET['sortBy'] == 'order_cost') {
                $searchKeyword = isset($_GET['totalCost']) ? $_GET['totalCost'] : '';
                if (!empty($searchKeyword)) {
                    if (strpos($query, 'WHERE') !== false) {
                        // If a WHERE clause already exists in the query, append the condition with an AND operator
                        $query .= " AND order_cost LIKE '%$searchKeyword%'";
                    } else {
                        // If there is no WHERE clause, add the condition with a WHERE keyword
                        $query .= " WHERE order_cost LIKE '%$searchKeyword%'";
                    }
                }
            }

            function getSortArrow($column, $currentSortField, $currentSortOrder)
            {
                if ($column === $currentSortField) {
                    $arrow = ($currentSortOrder === 'asc') ? '&#9650;' : '&#9660;';
                    return "<span class='sort-arrow'>$arrow</span>";
                }
                return '';
            }

            // Retrieve the sort field and order from query parameters
            $sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'order_id';
            $sortOrder = isset($_GET['sortOrder']) && $_GET['sortOrder'] === 'asc' ? 'desc' : 'asc';

            // Update the SQL query to include the sort field and order
            $query .= " ORDER BY $sortField $sortOrder";

            // Execute the query
            $result = $connection->query($query);

            // Execute the query and handle any errors
            $result = mysqli_query($connection, $query);
            if (!$result) {
                echo "Query error: " . mysqli_error($connection);
            } else {

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelOrder'])) {
                    $orderId = $_POST['orderId'];
    
                    // Retrieve the order status from the database
                    $statusQuery = "SELECT order_status FROM `orders` WHERE `order_id` = $orderId";
                    $statusResult = $connection->query($statusQuery);
    
                    if ($statusResult && $statusResult->num_rows > 0) {
                        $orderData = $statusResult->fetch_assoc();
                        $orderStatus = $orderData['order_status'];
    
                        // Check if the order is in pending status
                        if ($orderStatus == 'Pending') {
                            // Cancel the order by deleting it from the database
                            $cancelOrderQuery = "DELETE FROM `orders` WHERE `order_id` = $orderId";
                            $connection->query($cancelOrderQuery);
                            echo "<p class='gold-text margin-right'>Order canceled successfully.</p>";
                        } else {
                            echo "<p class='red-text margin-right'>Only pending orders can be canceled.</p>";
                        }
                    } else {
                        echo "<p class='red-text margin-right'>Invalid order ID.</p>";
                    }
                }

                // HTML code to display the order data in a table
                echo "<table>
                <tr>
                    <th><a href='?sortField=order_id&sortOrder=$sortOrder' class='link-class' >Order Number " . getSortArrow('order_id', $sortField, $sortOrder) . "</a></th>
                    <th><a href='?sortField=order_time&sortOrder=$sortOrder' class='link-class'>Order Date " . getSortArrow('order_date', $sortField, $sortOrder) . "</a></th>
                    <th><a href='?sortField=product&sortOrder=$sortOrder' class='link-class'>Product Details " . getSortArrow('product', $sortField, $sortOrder) . "</a></th>
                    <th><a href='?sortField=customer_name&sortOrder=$sortOrder' class='link-class'>Customer Name " . getSortArrow('customer_name', $sortField, $sortOrder) . "</a></th>
                    <th><a href='?sortField=order_cost&sortOrder=$sortOrder' class='link-class'>Order Cost " . getSortArrow('order_cost', $sortField, $sortOrder) . "</a></th>
                    <th><a href='?sortField=order_status&sortOrder=$sortOrder' class='link-class'>Order Status " . getSortArrow('order_status', $sortField, $sortOrder) . "</a></th>
                    <th>Action</th>
                </tr>";

                // Iterate over the query results and display each order
                // Concatenate fields as needed for better presentation
                while ($row = mysqli_fetch_assoc($result)) {
                    $orderId = $row['order_id'];
                    $orderDate = $row['order_time'];
                    $product = $row['Product'];
                    $Quantity = $row['Quantity'];
                    $ProductFeature = $row['ProductFeature'];
                    $order_cost = $row['order_cost'];
                    $customerName = $row['customer_name'];
                    $orderStatus = $row['order_status'];

                    echo "<tr>
                      <td>$orderId</td>
                      <td>$orderDate</td>
                      <td>
                        TV:$product
                        <br><br>
                        Quantity:$Quantity
                        <br><br>
                        Product Feature:$ProductFeature
                      </td>
                      <td>$customerName</td>
                      <td>RM $order_cost.00</td>
                      <td>$orderStatus</td>
                      <td>
                      <form method='POST' action=''>
                      <input type='hidden' name='orderId' value='$orderId'>
                      <select name='newStatus' class='styled-select'>
                      <option value='Pending'>Pending</option>
                      <option value='Fulfilled'>Fulfilled</option>
                      <option value='Paid'>Paid</option>
                      <option value='Archived'>Archived</option>
                  </select>
                      <br>
                      <button type='submit' class='hover-button1' name='updateStatus'>Update</button>
                  </form>
                  <br>
                          <form method='POST' action=''>
                              <input type='hidden' name='orderId' value='$orderId'>
                              <button type='submit' class='hover-button1' name='cancelOrder'>Cancel</button>
                          </form>
                      </td>
                  </tr>";
                }

                echo "</table>";
            }

            echo "<br><h4 class='gold-heading margin-right'>Popular product ordered</h4><br>";

            $popularquery = "SELECT Product, COUNT(*) AS order_count
                FROM `orders`
                GROUP BY Product
                ORDER BY order_count DESC
                LIMIT 1";

            $popularresult = $connection->query($popularquery);

            if ($popularresult && $popularresult->num_rows > 0) {
                $row = $popularresult->fetch_assoc();
                $mostPopularProduct = $row['Product'];
                $orderCount = $row['order_count'];

                echo "<p class='gold-text margin-right'>The most popular product ordered is: $mostPopularProduct</p><br>";
                echo "<p class='gold-text margin-right'>Number of orders: $orderCount</p><br>";
            } else {
                echo "<p class='red-text margin-right'>No orders found.</p><br>";
            }

            $averagequery = "SELECT COUNT(*) AS total_orders, DATE(order_time) AS order_date
                FROM `orders`
                GROUP BY DATE(order_time)
                ORDER BY order_date";

            $averageresult = $connection->query($averagequery);

            if ($averageresult && $averageresult->num_rows > 0) {
                // Calculate the average number of orders per day
                $totalDays = $averageresult->num_rows;
                $totalOrders = 0;

                while ($row = $averageresult->fetch_assoc()) {
                    $totalOrders += $row['total_orders'];
                }

                $averageOrdersPerDay = $totalOrders / $totalDays;

                echo "<p class='gold-text margin-right'>Average number of orders per day: " . round($averageOrdersPerDay, 2) . "</p>";
            } else {
                echo "<p class='red-text margin-right'>No orders found.</p>";
            }

            // HTML form to make queries
            echo "<form method='GET' action='' class='search-form'>
            <label for='customerName'>Customer Name : <input type='text' name='customerName' id='customerName' placeholder='Search by customer name'></label>
            <br>
            <label for='product'>Product : <input type='text' name='product' id='product' placeholder='Search by product name'></label>
            <br>
            <label for='status'>Status : 
                <select name='status' id='status'>
                <option value=''>All</option>
                <option value='Pending'>Pending</option>
                <option value='Fulfilled'>Fulfilled</option>
                <option value='Paid'>Paid</option>
                <option value='Archived'>Archived</option>
            </select>
            </label>
            <br>
            <label for='totalCost'>Total Cost: <input type='text' name='totalCost' id='totalCost' placeholder='Search by total cost'></label>
            <br>
            </label>
            <br>
            <button type='submit'>Search</button>
        </form>";
        } else {
            echo "<p class='gold-text'>Access denied. Please log in as a Manager.</p>";
            echo '<script>window.location.href = "manager_login.php";</script>';
            exit;
        }
    }
    // Close database connection
    mysqli_close($connection);
    ?>
</body>
<br>
<hr>
<?php include("includes/footer.inc") ?>

</html>