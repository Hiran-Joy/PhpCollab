<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit'])){
    
    $content=$_POST['txt_content'];
    
    $inQuery="insert into tbl_feedback(feedback_content,feedback_date,user_id) values('".$content."',CURDATE(),'".$_SESSION['uid']."')";
    if($con->query($inQuery)){
        ?>
        <script>
            alert("Feedback submited");
            window.location="HomePage.php";
        </script>
    <?php
    }
    else{
         ?>
        <script>
            alert("Feedback submission failed");
            window.location="HomePage.php";
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
    <title>User Feedback</title>
</head>
<body>
    <form action="" method="post">
        <h3>Feedback Form</h3>
        <table border="1">
            <tr>
                <td>Content</td>
                <td>
                    <textarea name="txt_content" id="txt_content" cols="25" rows="5" required></textarea>
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
    <table border="1">
        <tr>
            <td>SlNo</td>
            <td>Feeback content</td>
            <td>Feedback date</td>
            <td>Reply</td>
        </tr>
        <?php
            $selQuery="select * from tbl_feedback where user_id='".$_SESSION['uid']."' ";
            $row=$con->query($selQuery);
            $i=1;
            while($data=$row->fetch_assoc()){
            
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $data['feedback_content'];  ?></td>
            <td><?php echo $data['feedback_date'];  ?></td>
            <td><?php echo $data['feedback_reply']; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>