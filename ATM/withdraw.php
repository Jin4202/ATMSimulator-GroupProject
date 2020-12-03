<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transfer Money</title>
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

      if(isset($_POST["accountIndex"]) && isset($_POST["accountIndex"])) {
        if($_POST["wmoney"]) {

          $accountIndex = intval($_POST["accountIndex"]);
          $money = intval($_POST["wmoney"]);
          $fromSQL = "SELECT accountList FROM accounts WHERE email = '$id'";
          $fromConn = mysqli_query($conn, $fromSQL);
          $fromRow = mysqli_fetch_assoc($fromConn);

          $fromList = json_decode($fromRow["accountList"]);
          $fromBalance = $fromList[$accountIndex]->balance;
          if($money < 0) {
            echo "Please type postive number.";
            }
          else if($money > $fromBalance) {
              echo "You do not have enough money. Please check your account.";
          }
            else {
                  $fromList[$accountIndex]->balance = $fromBalance - $money;
                  $fromAccountList = json_encode($fromList);

                  $sql = "UPDATE accounts SET accountList='$fromAccountList' WHERE email = '$id';";
                  $result = mysqli_multi_query($conn, $sql);
                    if($result) {
                      echo "Successful Withdraw.";
                    }
                    else {
                      echo "Unexpected Error. Could not connect to the server.";
                    }
                }
        }
        else {
          echo "Please fill out the blanks";
        }
      }
      else {
        echo "Please select an account to withdraw from";
      }
      mysqli_close($conn);
      ?>
      <p>Back to the ATM page.</p>
      <button type="button" onclick="window.location.href = 'atmPage.html';"> Back </button>
    </div>
  </body>
</html>
