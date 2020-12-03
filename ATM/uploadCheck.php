<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Deposit</title>
    <link rel="stylesheet" href="../homepageStyle.css">
  </head>
  </head>
  <body>
    <div>
      <?php
      $target_dir = "checkImages/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = true;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if(isset($_POST["submit"])) {// Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = true;
        } else {
          $uploadOk = false;
        }
      }
      if ($_FILES["fileToUpload"]["size"] > 500000) {// Check file size
        echo "Sorry, your file is too large";
        $uploadOk = false;
      }
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  // Allow certain file formats
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
      }

      // Deposit ready
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

      if(isset($_POST["money"]) && isset($_POST["accountIndex"])) {
        if($_POST["money"] !== "") {
          $money = intval($_POST["money"]);
          $accountIndex = intval($_POST["accountIndex"]);

          $sql = "SELECT accountList FROM accounts WHERE email = '$id'";
          $result = mysqli_query($conn, $sql);
          if($result) {
            $row = mysqli_fetch_assoc($result);
            if(isset($row["accountList"])) {
              $list = json_decode($row["accountList"]);
              if(count($list) > $accountIndex) {
                if($uploadOk) {
                  // Deposit proceed
                  $list[$accountIndex]->balance += $money;
                  $accountList = json_encode($list);
                  $sql = "UPDATE accounts SET accountList='$accountList' WHERE email = '$id';";
                  $result = mysqli_query($conn, $sql);
                  if($result) {
                    echo "Successfully transferred.";
                  } else {
                    echo "Unexpected Error. Could not connect to the server.";
                  }
                  echo "<br>";

                  // Image upload proceed
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file: ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    echo '</br>';
                    echo "Check has been uploaded successfully";
                  } else {
                    echo "Sorry, there was an error uploading your file.";
                  }
                } else {
                  echo "Sorry, your file was not uploaded.";
                }
              } else {
                echo "Could not find the account.";
              }
            } else {
              echo "Could not find the user.";
            }
          } else {
            echo "Could not find the user.";
          }
        } else {
          echo "Please fill in the blanks. The amount section is empty.";
        }
      } else {
        echo "Please fill in the blanks. Failed to send data to server.";
      }

      ?>
      <p>Back to the Deposit page.</p>
      <button type="button" onclick="window.location.href = 'deposit.html';">Back</button>
    </div>
  </body>
</html>
