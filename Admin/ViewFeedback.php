<?php
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Feedbacks</title>
</head>

<body>
<form action="" method="post">
  <table width="748" border="1">
    <tr>
      <td width="75"><div align="center">SlNo</div></td>
      <td width="189"><div align="center">Feedback content</div></td>
      <td width="233"><div align="center">Submitted date</div></td>
      <td width="181"><div align="center">Submitted user</div></td>
      <td width="200"><div align="center">Reply</div></td>
    </tr>
    <?php
      $selQUery="select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id";
      $row=$con->query($selQUery);
      $i=1;
      while($data=$row->fetch_assoc()){

    ?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $data['feedback_content']; ?></td>
      <td><?php echo $data['feedback_date']; ?></td>
      <td><?php echo $data['user_name']; ?></td>
     <?php
     if($data['feedback_reply']){
      ?>
        <td><?php echo $data['feedback_reply']; ?></td>
      <?php
     }
     else{
      ?>
       <td><a href="FeedbackReply.php?rid=<?php echo $data['feedback_id']; ?>">Reply</a></td>
       <?php
     }
     ?>
    </tr>
    <?php
      }
    ?>
  </table>

</form>
</body>
</html>