<?php
session_start();
include("../Assets/Connection/Connection.php");

$selQuery="select * from tbl_user where user_id='".$_SESSION['uid']."' ";
$row=$con->query($selQuery);
$data=$row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<body>
    <h3>My Profile</h3>
    <div>
        <img src="../Assets/File/UserDoc/<?php echo $data['user_photo']; ?>" alt="Image" style="width:100px; height:100px;">
    </div>
    <table border=1>
        <tr>
            <td>Name</td>
            <td> <?php echo $data['user_name']; ?> </td>
        </tr>
         <tr>
            <td>Email</td>
            <td> <?php echo $data['user_email']; ?>  </td>
        </tr>
        <tr>
            <td colspan=2>
                <a href="EditProfile.php">Edit Profile</a>
                <a href="ChangePassword.php">Change Password</a>
            </td>
        </tr>
    </table>
</body>
</html>