<?php
// ==============================================
// DATABASE CONNECTION
// ==============================================
include('../Assets/Connection/Connection.php');

// ==============================================
// NOTE UPLOAD HANDLING
// ==============================================
if(isset($_POST['btn_submit']))
{
  $note_title = $_POST['txt_title'];
  $note_desc = $_POST['txt_description'];
  $subject_id = $_POST['sel_subject'];
  $note_photo = $_FILES['file_note']['name'];
  $temp = $_FILES['file_note']['tmp_name'];
  
  move_uploaded_file($temp, '../Assets/File/UserDoc/' . $note_photo);

  $insQuery = "insert into tbl_notes (subject_id,note_name,note_file,note_desc) values('".$subject_id."','".$note_title."','".$note_photo."','".$note_desc."')";
  
  if($con->query($insQuery))
  {
    ?>
    <script>
      alert("Note Uploaded");
      window.location="Noteupload.php";
    </script>
    <?php
  }
}
?>

<?php
// ==============================================
// COURSE FETCHING (UNUSED IN CURRENT IMPLEMENTATION)
// ==============================================
$selQuery = "select * from tbl_course";
$row = $con->query($selQuery);
while($data = $row->fetch_assoc())
{
  $course_name = $data['course_name'];
}
?>

<?php
// ==============================================
// NOTE DELETION HANDLING
// ==============================================
if(isset($_GET['did']))
{
  $delQuery = "delete from tbl_notes where note_id='".$_GET['did']."'";
  if($con->query($delQuery))
  {
    ?>
    <script>
      alert("Note Deleted");
      window.location="Noteupload.php";
    </script>
    <?php
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Note Upload System</title>
</head>

<body>
  <!-- ============================================== -->
  <!-- NOTE UPLOAD FORM -->
  <!-- ============================================== -->
  <form action="" method="post" enctype="multipart/form-data">
    <table width="347" border="1">
      <tr>
        <td width="179">Course</td>
        <td width="152">
          <label for="sel_course"></label>
          <select name="sel_course" id="sel_course" onchange="getSubject(this.value)">
            <option>...Select...</option>
            <?php
            $selQuery = "select * from tbl_course";
            $row = $con->query($selQuery);
            while($data = $row->fetch_assoc())
            {
              $course_name = $data['course_name'];
              ?>
              <option value="<?php echo $data['course_id'] ?>"><?php echo $course_name ?></option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Subject</td>
        <td>
          <label for="sel_subject"></label>
          <select name="sel_subject" id="sel_subject">
            <option>...Select...</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Note Title</td>
        <td>
          <label for="txt_title"></label>
          <input type="text" name="txt_title" id="txt_title" />
        </td>
      </tr>
      <tr>
        <td>Note Description</td>
        <td>
          <label for="txt_description"></label>
          <textarea name="txt_description" id="txt_description" cols="45" rows="5"></textarea>
        </td>
      </tr>
      <tr>
        <td>Note file</td>
        <td>
          <label for="file_note"></label>
          <input type="file" name="file_note" id="file_note" />
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
  <!-- NOTES LISTING TABLE -->
  <!-- ============================================== -->
  <table width="347" border="1">
    <tr>
      <td>SI NO:</td> <!--Align this NOTES LISTING TABLE properly-->
      <td>Course</td>
      <td>Subject</td>
      <td>Note Title</td>
      <td>Note Description</td>
      <td>Note file</td>
      <td>Action</td>
    </tr>
    <?php
    $selQuery = "SELECT * FROM tbl_notes n 
                 INNER JOIN tbl_subject s ON n.subject_id = s.subject_id 
                 INNER JOIN tbl_course c ON s.course_id = c.course_id";
    
    $row = $con->query($selQuery);
    $i = 0;
    while($data = $row->fetch_assoc())
    {
      $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['course_name'] ?></td>
        <td><?php echo $data['subject_name'] ?></td>
        <td><?php echo $data['note_name'] ?></td>
        <td><?php echo $data['note_desc'] ?></td>
        <td><img src="../Assets/File/UserDoc/<?php echo $data['note_file']?>" alt="" width="100px" height="100px"></td>
        <td><a href="Noteupload.php?did=<?php echo $data['note_id']?>">Delete</a></td> <!--Edit is pending-->
      </tr>
      <?php
    }
    ?>
  </table>

  <!-- ============================================== -->
  <!-- AJAX SCRIPTS -->
  <!-- ============================================== -->
  <script src="../Assets/JQuery/JQuery.js"></script>
  <script>
    function getSubject(did)
    {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxSubject.php",
        data: {Did: did},
        success: function(response) {
          $('#sel_subject').html(response);
        }
      })
    }
  </script>
</body>
</html>