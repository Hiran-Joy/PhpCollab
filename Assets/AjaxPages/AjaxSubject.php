<?php
include("../Connection/Connection.php");
?>
<script>
	console.log("")
</script>
<?php

$selQuery="select * from tbl_subject where course_id='".$_GET['Did']."'";
$row=$con->query($selQuery);
	while($data=$row->fetch_assoc())
	{
		?>
		<option value="<?php echo  $data['subject_id']?>"><?php echo  $data['subject_name']?></option>
		<?php
	}
?>