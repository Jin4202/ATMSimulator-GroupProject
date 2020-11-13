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
             if ($row["password"] === $password) {
               $logged_in = true;
              echo "Successfully logged in. <br> Username and Password confirmed.";
              header('Location: home.html');
              }
             else {
               echo "Incorrect password. Try again.";
               //header('Location: History.go(-1)');
             }
           }

           //mysqli_close($conn); // close connection
           }
           else {
           echo "Nothing was submitted.";
           }
           }
    ?>

    <br>
    <br>

    <button onclick="history.go(-1);">Go Back </button>

  </body>
</html>
