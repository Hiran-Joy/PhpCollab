
<?php
include("../Assets/Connection/Connection.php");
session_start();
$selQry="select * from tbl_user where user_id=".$_SESSION["uid"];
$result=$con->query($selQry);
$data=$result->fetch_assoc();
if(isset($_POST["btn_update"]))
{
    $oldpassword=$_POST["txt_oldpassword"];
	$newpassword=$_POST["txt_newpassword"];
	$confirmpassword=$_POST["txt_confirmpassword"];
	
    $dbpassword=$data['user_password'];

if($dbpassword==$oldpassword)
{
	if($newpassword==$confirmpassword)
	{
		$upQry="update tbl_user set user_password='".$confirmpassword."' where user_id=".$_SESSION["uid"];
	if($con->query($upQry))
	{
		?>
        <script>
		alert('Password Updated')
		window.location="MyProfile.php";
		</script>
        <?php
	}
	}
	else
	{
		?>
        <script>
		alert("Password MisMatch");
		window.location="Changepassword.php";
		</script>
        <?php
		}
	}
	else
	{
		?>
        <script>
		alert("Password Inncorect");
		window.location="Changepassword.php";
		</script>
        <?php
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ChangePassword</title>
</head>

<body>
    <form action="" method="post">
        <table border=1>
            <tr>
                <td>Old Password</td>
                <td><input type="password" name="txt_oldpassword" id="txt_oldpassword" required /></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td> <input type="password" name="txt_newpassword" id="txt_newpassword" required /></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="txt_confirmpassword" id="txt_confirmpassword" required /></td>
            </tr>
            <tr>
                <td colspan=2>
                    <div align="center">
                        <input type="submit" class="btn" name="btn_update" id="btn_update" value="Update" />
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

