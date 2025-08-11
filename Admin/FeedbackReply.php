<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit'])){
    $reply=$_POST['txt_reply'];
    
    $upQuery="update tbl_feedback set feedback_reply='".$reply."' where feedback_id='".$_GET['rid']."' ";
    if($con->query($upQuery)){
        ?>
        <script>
            alert("Replied successfully");
            window.location="ViewFeedback.php";
        </script>
        <?php
    }
    else{
         ?>
        <script>
            alert("Repling failed");
            window.location="ViewFeedback.php";
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
    <title>Feedback Reply   </title>
</head>
<body>
    <form action="" method="post">
        <h3>Feedback Reply</h3>
        <table border="1">
            <tr>
                <td>Reply</td>
                <td>
                    <textarea name="txt_reply" id="txt_reply" cols="25" rows="5" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <br>
</body>
</html>