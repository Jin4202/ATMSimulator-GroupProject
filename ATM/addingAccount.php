<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Accounts</title>
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

    $verification = false;
    if(isset($_POST["ssn"]) && isset($_POST["type"])) {
      if($_POST["ssn"] && $_POST["type"]) {
        $ssn = $_POST["ssn"];

        $sql = "INSERT INTO global() VALUES ()";
        if ($conn->query($sql) === TRUE) {
          $accountNumber = $conn->insert_id;


          class Account {
            public $accountName = "unnamed";
            public $type = "";
            public $balance = 0;
            public $accountNumber = -1;

            function set_type($type) {
              $this->type = $type;
            }
            function set_accountName($str) {
              $this->accountName = $str;
            }
          }
          $account = new Account();
          $account->set_type($_POST['type']);
          $account->accountNumber = $accountNumber;

          $sql = "SELECT ssn, accountList FROM accounts WHERE email = '$id'";
          $results = mysqli_query($conn, $sql);;
          if ($results) {
            $row = mysqli_fetch_assoc($results);
            if ($row["ssn"] === $ssn) {

              $list = json_decode($row["accountList"]);
              $account->set_accountName("Account".(count($list)+1));
              array_push($list, $account);
              $accountList = json_encode($list);

              $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$id'";

              if ($conn->query($sql) === TRUE) {
                $message = "Your account successfully created.";
                echo "<script>alert('$message');</script>";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
            } else {
              echo "Verification has failed. Wrong SSN was typed.";
            }
          }
        }
      } else {
        echo "Please fill out the blanks";
      }
    } else {
      echo "Please fill out the blanks";
    }

    mysqli_close($conn);
    ?>

    <p>Back to the Account Information page.</p>
    <button type="button" onclick="window.location.href = 'NewAccount.html';">Back</button>
  </body>
</html>
