<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
       body {
    background: url(banner1.jpg);
    font-family: Arial, sans-serif;
    background-size: cover;
    height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
img {
    padding-left: 43px;
    height: 204px;
}
        .login-container {
            position: relative;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            margin: 20px auto;
        }

        
    </style>
</head>

<body>
    <div class="img"><img src="farmO.png">
    

    <div class="login-container">
        <!-- Your login form goes here -->
        <form action="login.php" method="post">
            <div style="font-family: Arial;color:#fff;font-weight:bold;">Login</div><br>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
            
            </div>
            <br>
            <center><button type="submit" class="btn btn-primary" name="submit"><b>Submit</b></button></center><br>
            <div><a href="abhi.php">Don't have an account?</a></div>
        </form>
    </div></div>
</body>
</html>
<?php
    session_start();

    $host = "localhost"; // MySQL server host
    $username = "root"; // MySQL username
    $password = ""; // MySQL password
    $database = "project"; // Database name

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        $user = $_POST["email"];
        $pass = $_POST["password"];

        $sql = "SELECT * FROM project1 WHERE email='$user' and password='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "SELECT * FROM project1 WHERE email='$user' and password='$pass'and type='Farmer'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['user'] = $user; // Store email in session
                header("Location: farmer.php");
            } else {
                $_SESSION['user'] = $user;
                header("Location: http://localhost:5173/product"); // Redirect to consumer.php
            }
        } else {
            echo '<script>alert("UserName or Password is wrong");</script>';
        }

        $conn->close();
    }
?>
