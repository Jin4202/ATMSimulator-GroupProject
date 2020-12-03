<html>
  <head>
    <title>Login Processing File</title>
  </head>
  <body>
    <?php
      $logged_in = false;

      if (isset($_POST["email"]) && isset($_POST["password"])) {
        if($_POST["email"] && $_POST["password"]){

          $username = $_POST["email"];
          $password = $_POST["password"];

          $conn = mysqli_connect("localhost", "root", "", "onlineatm");

          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT password FROM accounts WHERE email = '$username'";
          $results = mysqli_query($conn, $sql);;

          if ($results) {
            $row = mysqli_fetch_assoc($results);
            if(isset($row["password"])) {
              if ($row["password"] === $password) {
                $logged_in = true;
                setcookie("username", $username, time() + (86400 * 30), "/"); // = one day
                echo "Successfully logged in. <br> Username and Password confirmed.";
                header('Location: home.html');
              } else {
                echo "Incorrect password. Try again.";
              }
            } else {
              echo "Can not find the username.";
            }
          } else {
            echo "Can not find the username.";
          }
        } else {
          echo "Please fill in the blanks.";
        }
      }
    ?>

    <br>
    <br>

    <button onclick="window.location.href ='../index.html'">Go Back </button>

  </body>
</html>
