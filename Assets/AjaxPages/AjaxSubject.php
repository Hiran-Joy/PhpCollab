<?php
include("../Connection/Connection.php");
?>
<script>
	console.log("")
</script>
<?php

$subject_idd = isset($_GET['Sid']) ? $_GET['Sid'] : "";

$selQuery = "SELECT * FROM tbl_subject WHERE course_id='".$_GET['Did']."'";
$row = $con->query($selQuery);

while($data = $row->fetch_assoc())
{
    ?>
    <option value="<?php echo $data['subject_id']; ?>"
        <?php if($subject_idd == $data['subject_id']) { echo "selected"; } ?>>
        <?php echo $data['subject_name']; ?>
    </option>
    <?php
}
?>
