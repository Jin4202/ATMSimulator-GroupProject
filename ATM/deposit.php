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
      $accountIndex = intval($_POST["accountIndex"]);
      if($money < 0) {
        echo "Please type postive number.";
      } else {
        $sql = "SELECT accountList FROM accounts WHERE email = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          $row = mysqli_fetch_assoc($result);
          $list = json_decode($row["accountList"]);
          $list[$accountIndex]->balance += $money;
          $accountList = json_encode($list);
          $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$id';";
          $result = mysqli_query($conn, $sql);
          if($result) {
            echo "Successfully transferred.";
          } else {
            echo "Unexpected Error. Could not connect to the server.";
          }
        }
      }
      mysqli_close($conn);
      ?>
      <p>Back to the Deposit page.</p>
      <button type="button" onclick="window.location.href = 'deposit.html';">Back</button>
    </div>
  </body>
</html>
