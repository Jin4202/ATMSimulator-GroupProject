<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create Accounts</title>
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

      $sql = "DELETE FROM accounts WHERE email = '$id'";

      if ($conn->query($sql) === TRUE) {
        echo "Your account successfully deleted.";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      mysqli_close($conn);
      ?>
      <p>Back to the Homepage.</p>
      <button type="button" onclick="window.location.href = &quot;../index.html&quot;;">Back</button>
    </div>
  </body>
</html>
