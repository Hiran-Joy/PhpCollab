<?php
include("../Assets/Connection/Connection.php");
if (isset($_POST['btn_submit'])) {
  $name = $_POST['txt_name'];
  $email = $_POST['txt_email'];
  $password = $_POST['txt_password'];

  $user_photo = $_FILES['file_photo']['name'];
  $temp = $_FILES['file_photo']['tmp_name'];
  move_uploaded_file($temp, '../Assets/File/UserDoc/' . $user_photo);

  $inQuery = "insert into tbl_user(user_name,user_email,user_password,user_photo) values('" . $name . "','" . $email . "','" . $password . "','" . $user_photo . "') ";
  if ($con->query($inQuery)) {
?>
    <script>
      alert("Registration completed successfully");
      window.location = "Registration.php";
    </script>
  <?php
  } else {
  ?>
    <script>
      alert("Registration failed!");
      window.location = "Registration.php";
    </script>
<?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration</title>
  <link rel="stylesheet" href="../Assets/CSS/RegistrationStyle.css"/>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <!-- Optional: Add image or background here -->
    </div>
    <div class="right-panel">
      <h2>Create an Account</h2>
      <form class="login-form" action="" method="post" enctype="multipart/form-data">
        <input type="text" name="txt_name" id="txt_name" placeholder="Full Name" required />
        <input type="email" name="txt_email" id="txt_email" placeholder="Email" required />
        <input type="password" name="txt_password" id="txt_password" placeholder="Create Password" required />
        <input type="file" name="file_photo" id="file_photo" class="file-input" required />

        <button type="submit" class="login-btn" name="btn_submit" id="btn_submit">Sign Up</button>

        <p class="sub-text">Already have an account? <a href="Login.php">Login</a></p>
      </form>
    </div>
  </div>
</body>
</html>
