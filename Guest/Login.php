<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit'])){
  $email=$_POST['txt_email'];
  $password=$_POST['txt_password'];

  $selQuery="select * from tbl_user where user_email='".$email."' and user_password='".$password."' ";
  $row=$con->query($selQuery);
  if($data=$row->fetch_assoc()){
    $_SESSION['uid']=$data['user_id'];
    $_SESSION['uname']=$data['user_name'];
    echo "Login successfull";
    header("location:../User/HomePage.php");
  }
  else{
    ?>
      <script>
        alert("Invalid email or password");
        window.location="Login.php";
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
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/CSS/LoginStyle.css">
</head>
<body>
  <div class="container">
    <div class="left-panel">
      
    </div>
    <div class="right-panel">
      <h2>Welcome back</h2>
    
      <form class="login-form" action="" method="post">
        <input type="email" name="txt_email" id="txt_email" placeholder="Email" required>
        <input type="password" name="txt_password" id="txt_password" placeholder="Enter your password" required>

        <button type="submit" class="login-btn" name="btn_submit" id="btn_submit" value="submit">Login</button>

        <p class="sub-text">Don’t have an account? <a href="Registration.php">Sign up</a></p>
      </form>
    </div>
  </div>
<!-- <form action="" method="get">
<table width="311" border="1">
  <tr>
    <td width="144">Email</td>
    <td width="151"><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email"></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password"></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_login" id="btn_login" value="Login">
    </div></td>
    </tr>
</table>

</form> -->
</body>
</html>