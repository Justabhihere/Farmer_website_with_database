<?php
    session_start();
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>
<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$mysql_name = 'project';
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_name);

if (!$conn) {
    die('Cannot connect to the database: ' . mysqli_connect_error());
}

$sql = 'SELECT * FROM product';
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error fetching data: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 0.5px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
    <header>
        <h1>Product List</h1>
    </header>
    <div style=  "height: 20px;
    padding-left: 25px;
    padding-top: -120px;">
     <b>user id:<?php echo $user; ?></b> 
  </div>
    <main>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>Type</th><th>Description</th><th>Quantity</th><th>Price</th><th>Photo</th></tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['des'] . '</td>';
                echo '<td>' . $row['qua'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td><img src="images/' . $row['photo'] . '" alt="Product Photo" style="max-width: 100px; max-height: 100px;"></td>';


                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No products found.';
        }

        mysqli_close($conn);
        ?>
    </main>
    <footer>
      <div class="social-links">
        <a href="https://www.linkedin.com/feed/?trk=registration-frontend" class="fa fa-linkedin" target="_blank"></a>
        <a href="https://www.facebook.com/profile.php?id=100091849125759" class="fa fa-facebook" target="_blank"></a>
        <a href="https://twitter.com/home" class="fa fa-twitter" target="_blank"></a>
        <a href="https://accounts.snapchat.com/v2/welcome" class="fa fa-snapchat-ghost" target="_blank"></a>
      </div>
      <p>&copy; 2023 Team-FarmO </p>
    </footer>
</body>


</html>
