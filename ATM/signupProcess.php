<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
  </head>
  <body>
    <?php
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
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"]) && isset($_POST["ssn"])) {
      // collect value of input field
      $email = $_POST['email'];
      $pw = $_POST['password'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $phone = $_POST['phone'];
      $ssn = $_POST['ssn'];

      /**
       *
       */
      class Account {
        public $accountName = "Account1";
        public $type = "";
        public $balance = 0;

        function set_type($type) {
          $this->type = $type;
        }
      }
      $account = new Account();
      $account->set_type($_POST['type']);
      $accounts = json_encode(array($account));

      $sql = "INSERT INTO accounts (email, password, firstname, lastname, phone, ssn, accountList) VALUES ('$email', '$pw', '$fname', '$lname', '$phone', '$ssn', '$accounts')";

      if ($conn->query($sql) === TRUE) {
        $message = "Your account successfully created.";
        echo "<script>alert('$message');</script>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "The form does not filled yet.";
    }
    mysqli_close($conn);
    ?>

    <div class="back">
      <p>Back to the log in page.</p>
      <button type="button" onclick="window.location.href = &quot;../index.html&quot;;">Log In</button>
    </div>
  </body>
</html>
