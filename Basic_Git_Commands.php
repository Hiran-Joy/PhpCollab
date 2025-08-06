<!--1--><!-- Forcing Git to recognize the case change -->

<!-- git config core.ignorecase false -->

<!-- git mv -f course.php Course.php
git commit -m "Force rename: course.php to Course.php"
git push  -->


<?php
if(isset($_GET['eid']))
{
$selQuery="select * from tbl_course where note_id='".$_GET['eid']."'";
$row=$con->query($selQuery);
$data=$row->fetch_assoc();
$course_namee=$data['course_name'];

}

?>