<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit'])){
  $name=$_POST['txt_name'];
  $email=$_POST['txt_email'];
  $password=$_POST['txt_password'];

  $user_photo=$_FILES['file_photo']['name'];
  $temp=$_FILES['file_photo']['tmp_name'];
  move_uploaded_file($temp,'../Assets/File/UserDoc/'.$user_photo);

  $inQuery="insert into tbl_user(user_name,user_email,user_password,user_photo) values('".$name."','".$email."','".$password."','".$user_photo."') ";
  if($con->query($inQuery)){
    ?>
    <script>
      alert("Registration completed successfully");
      window.locaction="Registration.php";
    </script>
    <?php
  }
  else{
    ?>
    <script>
      alert("Registration failed!");
      window.locaction="Registration.php";
    </script>
    <?php
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data"><table width="334" border="1">
  <tr>
    <td width="138">Name</td>
    <td width="180"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name"></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password"></td>
  </tr>
  <tr>
    <td>Photo</td>
    <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo"></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
    </div></td>
    </tr>
</table>
</form>
</body>
</html>