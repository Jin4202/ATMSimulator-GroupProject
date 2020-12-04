<html>
  <head>
    <title>Login Processing File</title>
  </head>
  <body>
    <?php
      $logged_in = false;

      if (isset($_POST["email"]) && isset($_POST["pin"])) {
        if($_POST["email"] && $_POST["pin"]){

          $username = $_POST["email"];
          $pin = $_POST["pin"];

          $conn = mysqli_connect("localhost", "root", "", "onlineatm");

          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT pin FROM accounts WHERE email = '$username'";
          $results = mysqli_query($conn, $sql);;

          if ($results) {
            $row = mysqli_fetch_assoc($results);
            if ($row["pin"] === $pin) {
              $logged_in = true;
              setcookie("username", $username, time() + (86400 * 30), "/"); // = one day
              echo "Successfully logged in. <br> Username and pin confirmed.";
              header('Location: atmPage.html');
            }
            else {
              echo "Incorrect pin. Try again.";
              //header('Location: History.go(-1)');
            }
          }
        } else {
            echo "Nothing was submitted.";
        }
      }
    ?>

    <br>
    <br>

    <button onclick="history.go(-1);">Go Back </button>

  </body>
</html>
