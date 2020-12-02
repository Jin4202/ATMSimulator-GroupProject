<?php
  $id = $_COOKIE["username"];
  if(!isset($_COOKIE["username"])) {
    echo "Please log in first.";
  }
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "onlineatm";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT email, password, firstname, lastname, phone, ssn, pin, accountList FROM accounts WHERE email = '$id'";
  $result = $conn->query($sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $accountList = json_decode($row["accountList"]);
    $user = array("email" => $row["email"], "password" => $row["password"], "firstname" => $row["firstname"], "lastname" => $row["lastname"], "phone" => $row["phone"], "ssn" => $row["ssn"], "pin" => $row["pin"], "accountList" => $accountList );
    echo json_encode($user);
  } else {
    echo "Error occured. We couldn't find the user.";
  }
  mysqli_close($conn);
?>
