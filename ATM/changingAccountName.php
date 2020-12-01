<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Managing Accounts</title>
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

    $sql = "SELECT accountList FROM accounts WHERE email = '$id'";
    $results = mysqli_query($conn, $sql);;
    if ($results) {
      $row = mysqli_fetch_assoc($results);

      $list = json_decode($row["accountList"]);
      for ($i=0; $i < count($list); $i++) {
        $name = $_POST[strval($i)];
        if(isset($name)) {
          if($name != "") {
            $list[$i]->accountName = $name;
          } else {
            echo "Invalid account name included.";
          }
        } else {
          echo "Failed to editing accounts";
        }
      }
      $accountList = json_encode($list);

      $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$id'";

      if ($conn->query($sql) === TRUE) {
        $message = "Your accounts are successfully edited.";
        echo "<script>alert('$message');</script>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "Failed to connect to the server.";
    }

    mysqli_close($conn);
    ?>

    <p>Back to the Account Information page.</p>
    <button type="button" onclick="window.location.href = &quot;NewAccount.html&quot;;">Back</button>
  </body>
</html>
