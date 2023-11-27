<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Your CSS styles remain unchanged */
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
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
      display: grid;
      gap: 8px;
    }

    label {
      font-weight: bold;
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

    input,
    textarea {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
    }


    input[type="file"] {
      margin-top: 5px;
    }
    input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
  padding: 10px 20px; /* Add padding to the submit button */
  border: none;
  border-radius: 5px;
}
select {
            padding: 8px;
            margin-top: 10px;
        }

.submit-button {
            margin-top: 10px; /* Adjust the margin as needed */
            align-self: flex-end; /* Align to the right side */
        }
  </style>
  
</head>

<body>

    <header>
        <h1>Add Product</h1>
    </header>
    <div style="height: 20px; padding-left: 25px; padding-top: -120px;">
        <b>user id:<?php echo $user; ?></b>
    </div>
    <main>
        <form action="product.php" method="post" enctype="multipart/form-data">
            
            <form action="product.php" method="post" enctype="multipart/form-data">
      <select id="location" name="type">
        <optgroup label="Vegetable">
            <option value="Tomato">Tomato</option>
            <option value="Potato">Potato</option>
            <option value="Ladyfinger">Ladyfinger</option>
            <option value="Pumpkin">Pumpkin</option>
            <option value="Onion">Onion</option>
            <option value="Red Chilli">Red Chilli</option>
            <option value="Carrot">Carrot</option>
            <option value="Beetroot">Beetroot</option>
            <option value="Brinjal">Brinjal</option>
            <option value="Cabbage">Cabbage</option>
            <option value="Cucumber">Cucumber</option>
        </optgroup>
        <optgroup label="Flowers">
            <option value="Red Chrysanthemum">Red Chrysanthemum</option>
            <option value="Jasmin">Jasmin</option>
            <option value="Mogra">Mogra</option>
            <option value="Open Chrysanthemum">Open Chrysanthemum</option>
            <option value="Pink Chrysanthemum">Pink Chrysanthemum</option>
            <option value="Pink Rose">Pink Rose</option>
            <option value="Pompom">Pompom</option>
            <option value="Red Dahlia">Red Dahlia</option>
            <option value="Yellow Chrysanthemum">Yellow Chrysanthemum</option>
            <option value="Orange Chrysanthemum">Orange Chrysanthemum</option>
        </optgroup>
        <optgroup label="Fruits">
            <option value="Apple">Apple</option>
            <option value="Avocado">Avocado</option>
            <option value="Corn">Corn</option>
            <option value="Grapes">Grapes</option>
            <option value="Guava">Guava</option>
            <option value="Lemon"> Lemon</option>
            <option value="Mango">Mango</option>
            <option value="Orange">Orange</option>
            <option value="Papaya">Papaya</option>
            <option value=" Pineapple"> Pineapple</option>
            <option value="Pomegranate">Pomegranate</option>
            <option value="Strawberry">Strawberry</option>
            <option value="Watermelon">Watermelon</option>
        </optgroup>
        <!-- Add more optgroup and option elements as needed -->
    </select>
            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
            <label for="quan">Net Quantity:</label>
            <input type="number" id="quan" name="quan" min="0" step="0.01" required>
            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" min="0" step="0.01" required>
            <label for="photo">Select Photo:</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    </main>

    <?php
    $mysql_host = 'localhost';
    $mysql_user = 'root';
    $mysql_password = '';
    $mysql_name = 'project';
    $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_name);
    if (!$conn) {
        die('Cannot connect to the database: ' . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
        $ty = isset($_POST["type"]) ? $_POST["type"] : '';
        $des = isset($_POST["productDescription"]) ? $_POST["productDescription"] : '';
        $qu = isset($_POST["quan"]) ? $_POST["quan"] : '';
        $price = isset($_POST["productPrice"]) ? $_POST["productPrice"] : '';

        $uploadDirectory = 'C:/xampp/htdocs/images/';
        $file = $_FILES["photo"];

        if ($file["error"] === UPLOAD_ERR_OK) {
            $file_name = basename($file["name"]);
            $target_path = $uploadDirectory . $file_name;

            if (move_uploaded_file($file["tmp_name"], $target_path)) {
                // File uploaded successfully
                $file_name_to_save_in_db = $file_name;

                // Insert data into the database
                $sql = "INSERT INTO product(type, des, qua, price, photo) VALUES ('$ty', '$des', '$qu', '$price', '$file_name_to_save_in_db')";

                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Data inserted successfully!");</script>';
                } else {
                    echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                }
            } else {
                echo 'Error uploading file.';
            }
        } else {
            echo 'Error: ' . $file["error"];
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>

</html>
