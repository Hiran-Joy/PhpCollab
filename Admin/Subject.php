<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
  $subject=$_POST['txt_subject'];
  $course_id=$_POST['sel_course'];
  $insQuery="insert into tbl_subject (course_id,subject_name) values('".$course_id."','".$subject."')";
  if($con->query($insQuery))
  {
    ?>
        <script>
      alert("Subject Name Inserted");
      window.location="Subject.php";
    </script>
    <?php
  }

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body><form action="" method="post"><table width="261" border="1">
  <tr>
    <td width="94">Course Name</td>
    <td width="151"><label for="sel_course"></label>
      <select name="sel_course" id="sel_course">
      <option>...Select...</option>
      <?php
       $selQuery="select * from tbl_course";
       $row=$con->query($selQuery);
       while($data=$row->fetch_assoc())
       {
        ?>
        <option value="<?php echo $data['course_id'] ?>"><?php echo $data['course_name'] ?></option>
        <?php
       }
      ?>

      </select></td>
  </tr>
  <tr>
    <td>Subject Name</td>
    <td><label for="txt_subject"></label>
      <input type="text" name="txt_subject" id="txt_subject" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
</form>
</body>
</html>