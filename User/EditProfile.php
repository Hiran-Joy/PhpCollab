<?php
session_start();
include("../Assets/Connection/Connection.php");

$selQuery="select * from tbl_user where user_id='".$_SESSION['uid']."' ";
$row=$con->query($selQuery);
$data=$row->fetch_assoc();
?>
    <script>
    console.log(<?php echo json_encode($data['user_photo']); ?>);
    </script>
<?php



if(isset($_POST['btn_update'])){
    $name=$_POST['txt_name'];
    $email=$_POST['txt_email'];
    if(!empty($_FILES['file_photo']['name'])){
        $user_photo = $_FILES['file_photo']['name'];
        $temp = $_FILES['file_photo']['tmp_name'];
        move_uploaded_file($temp, '../Assets/File/UserDoc/' . $user_photo); 
    }
    else{
        $user_photo=$data['user_photo'];
        ?>
        <script>
        console.log($data['user_photo']);
        </script>
        <?php

    }
    $upQuery="update tbl_user set user_name='".$name."',user_email='".$email."',user_photo='".$user_photo."' where user_id=".$_SESSION['uid'];
    if($con->query($upQuery)){
        ?>
            <script>
                alert("Profile updated");
                window.location="Myprofile.php";
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
    <title>Edit Profile</title>
</head>
<body>
    <h3>Edit Profile</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <table border=1>
            <tr>
                <td>New profile pic</td>
                <td><input type="file" name="file_photo" id="file_photo"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="txt_name" value="<?php echo ($data['user_name']); ?>" id="txt_email" required /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="txt_email" value="<?php echo ($data['user_email']); ?>" id="txt_email" required /></td>
            </tr>
            <tr>
                <td colspan="2"><div align="center">
                    <input type="submit" name="btn_update" id="btn_update" value="Update">
                </div></td>
            </tr>
        </table>
    </form>
</body>
</html>