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

      if(isset($_POST["accountIndex"]) && isset($_POST["targetId"]) && isset($_POST["targetNumber"]) && isset($_POST["accountIndex"])) {
        if($_POST["accountIndex"] && $_POST["targetId"] && $_POST["targetNumber"] && $_POST["accountIndex"]) {

          $accountIndex = intval($_POST["accountIndex"]);
          $targetId = $_POST["targetId"];
          $targetNumber = $_POST["targetNumber"];
          $money = intval($_POST["money"]);

          $fromSQL = "SELECT accountList FROM accounts WHERE email = '$id'";
          $toSQL = "SELECT accountList FROM accounts WHERE email = '$targetId'";

          $fromConn = mysqli_query($conn, $fromSQL);
          $toConn = mysqli_query($conn, $toSQL);

          if($fromConn) {
            $fromRow = mysqli_fetch_assoc($fromConn);

            // check 'from' account exist & money is in proper range.
            $fromList = json_decode($fromRow["accountList"]);
            $fromBalance = $fromList[$accountIndex]->balance;
            if($money < 0) {
              echo "Please type postive number.";
            } else if($money > $fromBalance) {
              echo "You do not have enough money. Please check your account.";
            } else {

              // check 'to' account exist
              if($toConn) {
                $toRow = mysqli_fetch_assoc($toConn);
                if(!isset($toRow["accountList"])) {
                  echo "Couldn't find.";
                }
                $toList = json_decode($toRow["accountList"]);
                $isSet = false;
                $toIndex = -1;
                for($i = 0; $i < count($toList); $i++) {
                  if($toList[$i]->accountNumber == $targetNumber) {
                    $toIndex = $i;
                    $isSet = true;
                  }
                }

                if($isSet) {
                  // when you transfer in same user account.
                  if($id == $targetId) {
                    $fromList[$accountIndex]->balance = $fromBalance - $money;
                    $fromList[$toIndex]->balance += $money;
                    $fromAccountList = json_encode($fromList);
                    $sql = "UPDATE accounts SET accountList='$fromAccountList' WHERE email = '$id';";
                    $result = mysqli_query($conn, $sql);
                    if($result) {
                      echo "Successfully transferred.";
                    } else {
                      echo "Unexpected Error. Could not connect to the server.";
                    }
                  } else {

                    // 'from' account
                    $fromList[$accountIndex]->balance = $fromBalance - $money;
                    $fromAccountList = json_encode($fromList);

                    // 'to' account
                    $toList[$toIndex]->balance += $money;
                    $toAccountList = json_encode($toList);

                    // UPDATE
                    $sql = "UPDATE accounts SET accountList='$fromAccountList' WHERE email = '$id';";
                    $sql .= "UPDATE accounts SET accountList='$toAccountList' WHERE email = '$targetId';";
                    $result = mysqli_multi_query($conn, $sql);
                    if($result) {
                      echo "Successfully transferred.";
                    } else {
                      echo "Unexpected Error. Could not connect to the server.";
                    }
                  }

                } else {
                  echo "We could not find the account.";
                }
              } else {
                echo "We could not find the user.";
              }
            }

          } else {
            echo "Unexpected Error. Could not connect to the server.";
          }
        } else {
          echo "Please fill out the blanks";
        }
      } else {
        echo "Please fill out the blanks";
      }


      mysqli_close($conn);
      ?>
      <p>Back to the Transfer page.</p>
      <button type="button" onclick="window.location.href = 'transfer.html';">Back</button>
    </div>



  </body>
</html>
