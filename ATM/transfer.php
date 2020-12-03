<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transfer Money</title>
  </head>
  <body>
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

    $accountIndex = intval($_POST["accountIndex"]);
    $targetId = $_POST["targetId"];
    $targetNumber = $_POST["targetNumber"];
    $money = intval($_POST["money"]);


    $sql = "SELECT accountList FROM accounts WHERE email = '$id'";
    $results = mysqli_query($conn, $sql);;
    if ($results) {
      $row = mysqli_fetch_assoc($results);

      $list = json_decode($row["accountList"]);
      $balance = $list[$accountIndex]->balance;
      if($money < 0) {
        echo "Please type postive number.";
        return;
      } else if($money > $balance) {
        echo "You do not have enough money. Please check your account.";
        return;
      } else {
        $list[$accountIndex]->balance = $balance - $money;
        $accountList = json_encode($list);
      }
      $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$id'";
      if ($conn->query($sql) === TRUE) {
        $sql = "SELECT accountList FROM accounts WHERE email = '$targetId'";
        $results = mysqli_query($conn, $sql);
        if ($results) {
          $row = mysqli_fetch_assoc($results);
          $list = json_decode($row["accountList"]);
          $isSet = false;
          for($i = 0; $i < count($list); $i++) {
            if($list[$i]->accountNumber == $targetNumber) {
              $list[$i]->balance = $list[$i]->balance + $money;
              $isSet = true;
            }
          }
          if($isSet) {
            $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$targetId'";
            $results = mysqli_query($conn, $sql);
            if ($results) {
              echo "Successfully transferred.";
            } else {
              echo "Unexpected error due to connection to the server.";
            }
          } else {
            echo "We could not find the matching account.";
          }
        } else {
          echo "We can not find the matching user.";
        }
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "Failed to connect to the server.";
    }

    mysqli_close($conn);
    ?>

    <p>Back to the Transfer page.</p>
    <button type="button" onclick="window.location.href = 'transfer.html';">Back</button>
  </body>
</html>
