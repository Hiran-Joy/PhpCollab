<?php
// ==============================================
// DATABASE CONNECTION & INITIALIZATION
// ==============================================
include("../Assets/Connection/Connection.php");
$course_name = "";
$course_id = "";
$hidden = "";

// ==============================================
// INSERT/UPDATE HANDLING
// ==============================================
if(isset($_POST['btn_submit']))
{
  $course = $_POST['txt_course'];
  $hidden = $_POST['txt_hidden'];
  echo $hidden;
  
  if($hidden == "")
  {
    $insQuery = "insert into tbl_course (course_name) values('".$course."')";
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
  else
  {
    $upQuery = "update tbl_course set course_name='".$course."' where course_id='".$hidden."'";
    if($con->query($upQuery))
    {
      ?>
      <script>
        alert("Course Name Updated");
        window.location="Course.php";
      </script>
      <?php
    }
  }
}
?>

<?php
// ==============================================
// DELETE HANDLING
// ==============================================
if(isset($_GET['did']))
{
  $delQuery = "delete from tbl_course where course_id='".$_GET['did']."'";
  if($con->query($delQuery))
  {
    ?>
    <script>
      alert("Course Name Deleted");
      window.location="Course.php";
    </script>
    <?php
  }
}
?>

<?php
// ==============================================
// EDIT DATA FETCHING
// ==============================================
if(isset($_GET['eid']))
{
  $selQuery = "select * from tbl_course where course_id='".$_GET['eid']."'";
  $row = $con->query($selQuery);
  $data = $row->fetch_assoc();
  $course_name = $data['course_name'];
  $course_id = $data['course_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Course</title>
</head>

<body>
  <!-- ============================================== -->
  <!-- COURSE INPUT FORM -->
  <!-- ============================================== -->
  <form action="" method="post">
    <table width="294" border="1">
      <tr>
        <td width="114">Course Name</td>
        <td width="164">
          <label for="txt_course"></label>
          <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $course_id ?>"/>
          <input type="text" name="txt_course" id="txt_course" value="<?php echo $course_name ?>"/>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </div>
        </td>
      </tr>
    </table>
  </form>
  
  <br>
  
  <!-- ============================================== -->
  <!-- COURSE LISTING TABLE -->
  <!-- ============================================== -->
  <form action="" method="post">
    <table width="294" border="1">
      <tr>
        <td>SI No:</td>
        <td>Course Name</td>
        <td>Action</td>
      </tr>
      <?php
      $selQuery = "select * from tbl_course";
      $row = $con->query($selQuery);
      $i = 0;
      while($data = $row->fetch_assoc())
      {
        $i++
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $data['course_name']; ?></td>
          <td>
            <a href="Course.php?did=<?php echo $data['course_id'] ?>">Delete</a>
            <a href="Course.php?eid=<?php echo $data['course_id'] ?>">Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </form>
</body>
</html>