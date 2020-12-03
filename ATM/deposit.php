<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Deposit Money</title>
    <link rel="stylesheet" href="../homepageStyle.css">
  </head>
  <body>
    <div>
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

      $money = intval($_POST["money"]);
      if($money < 0) {
            echo "Please type postive number.";
      } else {
        echo "Please fill out the blanks";
      }


      mysqli_close($conn);
      ?>
      <p>Back to the Deposit page.</p>
      <button type="button" onclick="window.location.href = 'deposit.html';">Back</button>
    </div>



  </body>
</html>
