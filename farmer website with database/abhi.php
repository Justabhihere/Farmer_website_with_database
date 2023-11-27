<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Registration Form</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background: url(banner1.jpg);
    padding-top: 1%;
    display: flex;
    justify-content: center;
    background-size: cover;
}

    form {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 5px;
      width: 400px;
    }
      img {
    padding-bottom: 10px;
    padding-left: 66px;
    height: 135px;
}
  

  </style>
</head>
<body><div><div class="img"><img src="farmO.png"></div>
<div>  
<form action="abhi.php" method="post">
  <div ><center style="font-size: 35px;">
    Registration Form
</center>
    
  </div><br>
    <div class="row">
      <div class="col">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" aria-label="First name" name="fname"required>
      </div>
      <div class="col">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control"  aria-label="Last name" name="lname">
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label" >Email address</label>
      <input type="email" class="form-control" required name="email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" required name="password">
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="phone" class="form-control" required name="phone">
    </div><div class="mb-3">
      <div class="mb-3">
        <label for="type">Registration type</label><br>
        <select class="form-select" name="type">
          <option selected disabled>---Select Type---</option>
          <option value="Farmer" >Farmer</option>
          <option value="Consumer">Consumer</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <input type="text" class="form-control" name="address">
      </div>
      <div class="row">
      <div class="col">
        <label class="form-label">District  </label>
        <input type="text" class="form-control" aria-label="First name" name="district" required>
      </div>
      <div class="col">
        <label class="form-label">Taluk</label>
        <input type="text" class="form-control"  aria-label="Last name" name="taluk" required>
      </div></div>  
<br><button type="submit" class="btn btn-primary">Submit</button> 
  </form>
  </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost"; // MySQL server host
    $username = "root"; // MySQL username
    $password = ""; // MySQL password
    $database = "project"; // Database name

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 $firstname=$_POST["fname"];
 $lastname=$_POST["lname"];
 $email1=$_POST["email"];
 $password=$_POST["password"];
 $ph=$_POST["phone"];
 $ty=$_POST["type"];
 $add=$_POST["address"];
 $dist=$_POST["district"];
 $tal=$_POST["taluk"];

 $sql = "INSERT INTO project1 (fname,lname, email,password,phone,type,address,dis,tal) VALUES ('$firstname','$lastname', '$email1','$password','$ph','$ty','$add','$dist','$tal')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record created successfully.")</script>';
        header('Locattion: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>