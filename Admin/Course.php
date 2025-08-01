<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit']))
{
  $course=$_POST['txt_course'];
  $insQuery="insert into tbl_course (course_name) values('".$course."')";
  if($con->query($insQuery))
  {
    ?>
    <script>
      alert("Course Name Inserted");
      window.location="Course.php";
    </script>
    <?php
  }
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course</title>
</head>

<body>
<form action="" method="post"><table width="294" border="1">
  <tr>
    <td width="114">Course Name</td>
    <td width="164"><label for="txt_course"></label>
      <input type="text" name="txt_course" id="txt_course" /></td>
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