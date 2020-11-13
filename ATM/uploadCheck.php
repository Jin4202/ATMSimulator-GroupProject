<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  </head>
  <body>
    <center>
      <h2>
        <br><br>
      <?php

      $target_dir = "checkImages/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


      if(isset($_POST["submit"])) {// Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
          $uploadOk = 0;
        }
      }

      if ($_FILES["fileToUpload"]["size"] > 500000) {// Check file size
        echo "Sorry, your file is too large";
        $uploadOk = 0;
      }

      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  // Allow certain file formats
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      if ($uploadOk == 0) {// Check if $uploadOk is set to 0 by an error
        echo "Sorry, your file was not uploaded.";


      } else {// if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file: ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          echo '</br>';
          echo "Check has been uploaded successfully";
        } else {
          echo "Sorry, there was an error uploading your file.";

        }
      }
      ?>
      </h2>

  </body>
</html>
