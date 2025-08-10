<?php
// ==============================================
// DATABASE CONNECTION
// ==============================================
include('../Assets/Connection/Connection.php');
$course_idd = "";
$subject_idd = "";
$note_titlee = "";
$note_descc = "";
$note_id = "";

// ==============================================
// NOTE INSERT / UPDATE HANDLING
// ==============================================
if(isset($_POST['btn_submit']))
{
    $note_title = $_POST['txt_title'];
    $note_desc = $_POST['txt_description'];
    $subject_id = $_POST['sel_subject'];
    $course_id = $_POST['sel_course'];
    $hid = $_POST['hid'];

    // File handling
    $note_photo = $_FILES['file_note']['name'];
    $temp = $_FILES['file_note']['tmp_name'];
    if($note_photo != "") {
        move_uploaded_file($temp, '../Assets/File/UserDoc/' . $note_photo);
    }

    if(trim($hid) == "") {
        // Insert new note
        $insQuery = "INSERT INTO tbl_notes(course_id,subject_id,note_name,note_file,note_desc) 
                     VALUES('".$course_id."','".$subject_id."','".$note_title."','".$note_photo."','".$note_desc."')";
        if($con->query($insQuery)) {
            ?>
            <script>
                alert("Note Uploaded");
                window.location="Noteupload.php";
            </script>
            <?php
        }
    } else {
        // Update existing note
        if($note_photo != "") {
            $updateQuery = "UPDATE tbl_notes 
                            SET course_id='".$course_id."',
                                subject_id='".$subject_id."',
                                note_name='".$note_title."',
                                note_file='".$note_photo."',
                                note_desc='".$note_desc."' 
                            WHERE note_id='".$hid."'";
        } else {
            // If file not changed, don't update note_file
            $updateQuery = "UPDATE tbl_notes 
                            SET course_id='".$course_id."',
                                subject_id='".$subject_id."',
                                note_name='".$note_title."',
                                note_desc='".$note_desc."' 
                            WHERE note_id='".$hid."'";
        }
        if($con->query($updateQuery)) {
            ?>
            <script>
                alert("Note Updated");
                window.location="Noteupload.php";
            </script>
            <?php
        }
    }
}

// ==============================================
// NOTE DELETION HANDLING
// ==============================================
if(isset($_GET['did']))
{
    $delQuery = "DELETE FROM tbl_notes WHERE note_id ='".$_GET['did']."'";
    if($con->query($delQuery)) {
        ?>
        <script>
            alert("Deleted");
            window.location="Noteupload.php";
        </script>
        <?php 
    }
}

// ==============================================
// EDIT FETCH DATA
// ==============================================
if(isset($_GET['eid']))
{
    $selQuery = "SELECT * FROM tbl_notes WHERE note_id ='".$_GET['eid']."'";
    $row=$con->query($selQuery);
    $data=$row->fetch_assoc();
    $course_idd = $data['course_id'];
    $subject_idd = $data['subject_id'];
    $note_titlee = $data['note_name'];
    $note_descc = $data['note_desc'];
    $note_id = $data['note_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Note Upload System</title>
</head>
<body>

<!-- ============================================== -->
<!-- NOTE FORM -->
<!-- ============================================== -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="hid" value="<?php echo $note_id; ?>" />
    <table width="347" border="1">
        <tr>
            <td width="179">Course</td>
            <td width="152">
                <select name="sel_course" id="sel_course" onchange="getSubject(this.value)">
                    <option>...Select...</option>
                    <?php
                    $selQuery = "SELECT * FROM tbl_course";
                    $row = $con->query($selQuery);
                    while($data = $row->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $data['course_id']; ?>" 
                            <?php if($course_idd == $data['course_id']) echo "selected"; ?>>
                            <?php echo $data['course_name']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>
                <select name="sel_subject" id="sel_subject">
                    <option>...Select...</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Note Title</td>
            <td>
                <input type="text" name="txt_title" id="txt_title" value="<?php echo $note_titlee; ?>"/>
            </td>
        </tr>
        <tr>
            <td>Note Description</td>
            <td>
                <textarea name="txt_description" id="txt_description" cols="45" rows="5"><?php echo $note_descc; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Note file</td>
            <td>
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
<table border="1">
    <tr>
        <td>SI NO:</td>
        <td>Course</td>
        <td>Subject</td>
        <td>Note Title</td>
        <td>Note Description</td>
        <td>Note file</td>
        <td>Action</td>
    </tr>
    <?php
    $selQuery = "SELECT n.note_id, n.note_name, n.note_desc, n.note_file, 
                        s.subject_name, c.course_name
                 FROM tbl_notes n
                 INNER JOIN tbl_subject s ON n.subject_id = s.subject_id
                 INNER JOIN tbl_course c ON s.course_id = c.course_id";
    $row = $con->query($selQuery);
    $i = 0;
    while($data = $row->fetch_assoc()) {
        $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['course_name']; ?></td>
            <td><?php echo $data['subject_name']; ?></td>
            <td><?php echo $data['note_name']; ?></td>
            <td><?php echo $data['note_desc']; ?></td>
            <td><img src="../Assets/File/UserDoc/<?php echo $data['note_file']; ?>" alt="" width="100px" height="100px"></td>
            <td>
                <a href="Noteupload.php?did=<?php echo $data['note_id']; ?>">Delete</a> | 
                <a href="Noteupload.php?eid=<?php echo $data['note_id']; ?>">Edit</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<!-- ============================================== -->
<!-- JAVASCRIPT SECTION -->
<!-- ============================================== -->
<script src="../Assets/JQuery/JQuery.js"></script>
<?php 
if(isset($_GET['eid'])) { 
?>
<script>
$(document).ready(function() {
    getSubject('<?php echo $course_idd; ?>', '<?php echo $subject_idd; ?>');
});
</script>
<?php 
}
?>
<script>
function getSubject(did, selectedId = null)
{
    $.ajax({
        url: "../Assets/AjaxPages/AjaxSubject.php",
        data: {Did: did, Sid: selectedId},
        success: function(response) {
            $('#sel_subject').html(response);
            if (selectedId) {
                $('#sel_subject').val(selectedId);
            }
        }
    });
}
</script>

</body>
</html>