<?php
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form field named 'username'
    $username = $_POST['username'];

    // Perform authentication (you may want to check against a database)
    // For simplicity, we'll set a session variable if the username is not empty
    if (!empty($username)) {
        $_SESSION['user'] = $username;
    }
}

// Retrieve the session variable
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
         nav {
      background-color: #333;
      overflow: hidden;
    }

    nav a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 40px;
      padding-bottom: 5px;
      text-decoration: none;
    }

    nav a img {
      height: 30px; /* Set the maximum height of the image */
      
      margin-right: 5px; /* Add some space to the right of the image */
    }

    nav a:hover {
      background-color: #ddd;
      color: black;
    }
    .social-links a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
    }
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    </style>
</head>
<body>
<nav>
    <a href="#home">
      <img src="farmO.png" > 
    </a>
    <a href="farmer.php">Home</a>
    <a href="order.php">Orders</a>
    <a href="propages.php">Products</a>
    <a href="weather.html">Weather</a>
  </nav>
  <div style="height: 20px; padding-left: 25px; padding-top: -119px;">
        <b>user id: <?php echo $user; ?></b>
    </div>
<div class="container mt-5">
    <h2>Order Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Items</th>
                <th>Quantity(kgs)</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host = "localhost"; // MySQL server host
            $username = "root"; // MySQL username
            $password = ""; // MySQL password
            $database = "project"; // Database name

            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to retrieve data from the table (replace "your_table_name" with the actual table name)
            $sql = "SELECT * FROM orders where email='$user'";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" .$row["customer_name"] . "</td>
                            <td>" .$row["items"] . "</td>
                            <td>" .$row["quantity"] . "</td>
                            <td>" .$row["adrress"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No results found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
<footer>
    <br>
      <div class="social-links">
        <a href="https://www.linkedin.com/feed/?trk=registration-frontend" class="fa fa-linkedin" target="_blank"></a>
        <a href="https://www.facebook.com/profile.php?id=100091849125759" class="fa fa-facebook" target="_blank"></a>
        <a href="https://twitter.com/home" class="fa fa-twitter" target="_blank"></a>
        <a href="https://accounts.snapchat.com/v2/welcome" class="fa fa-snapchat-ghost" target="_blank"></a>
      </div><br>
      <p>&copy; 2023 Team-FarmO </p>
    </footer>

</body>
</html>

<!-- The rest of your code -->
