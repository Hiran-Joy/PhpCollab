<?php
// ==============================================
// DATABASE CONNECTION & INITIALIZATION
// ==============================================
include("../Assets/Connection/Connection.php");
$subject_name = "";
$course_idd = "";

// ==============================================
// INSERT HANDLING
// ==============================================
if(isset($_POST['btn_submit']))
{
  $subject = $_POST['txt_subject'];
  $course_id = $_POST['sel_course'];
  $insQuery = "insert into tbl_subject (course_id,subject_name) values('".$course_id."','".$subject."')";
  
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

<?php
// ==============================================
// DELETE HANDLING
// ==============================================
if(isset($_GET['did']))
{
  $delQuery = "delete from tbl_subject where subject_id='".$_GET['did']."'";
  if($con->query($delQuery))
  {
    ?>
    <script>
      alert("Subject Name Deleted");
      window.location="Subject.php";
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
  $selQuery = "select * from tbl_subject where subject_id='".$_GET['eid']."'";
  $row = $con->query($selQuery);
  $data = $row->fetch_assoc();
  $subject_name = $data['subject_name'];
  $course_idd = $data['course_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Subject Management</title>
</head>

<body>
  <!-- ============================================== -->
  <!-- SUBJECT INPUT FORM -->
  <!-- ============================================== -->
  <form action="" method="post">
    <table width="261" border="1">
      <tr>
        <td width="94">Course Name</td>
        <td width="151">
          <label for="sel_course"></label>
          <select name="sel_course" id="sel_course">
            <option>...Select...</option>
            <?php
            $selQuery = "select * from tbl_course";
            $row = $con->query($selQuery);
            while($data = $row->fetch_assoc())
            {
              ?>
              <option 
                <?php if($course_idd == $data['course_id']) echo "selected"; ?>
                value="<?php echo $data['course_id']; ?>">
                <?php echo $data['course_name']; ?>
              </option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Subject Name</td>
        <td>
          <label for="txt_subject"></label>
          <input type="text" name="txt_subject" id="txt_subject" value="<?php echo $subject_name ?>" />
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

  <!-- ============================================== -->
  <!-- SUBJECT LISTING TABLE -->
  <!-- ============================================== -->
  <form action="" method="post">
    <table width="294" border="1">
      <tr>
        <td>SI No:</td>
        <td>Course Name</td>
        <td>Subject Name</td>
        <td>Action</td>
      </tr>
      <br>
      <?php
      $selQuery = "select * from tbl_subject s inner join tbl_course c on s.course_id=c.course_id";
      $row = $con->query($selQuery);
      $i = 0;
      while($data = $row->fetch_assoc())
      {
        $i++
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $data['course_name']; ?></td>
          <td><?php echo $data['subject_name']; ?></td>
          <td>
            <a href="Subject.php?did=<?php echo $data['subject_id'] ?>">Delete</a>
            <a href="Subject.php?eid=<?php echo $data['subject_id'] ?>">Edit</a>
          </td>
        </tr>
        <?php
      }
      ?>
    </table>
  </form>
</body>
</html>