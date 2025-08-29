<?php
include("../Connection/Connection.php");

$notes_id = isset($_GET['Nid']) ? $_GET['Nid'] : "";

$selQuery = "select * from tbl_notes n inner join tbl_subject s on n.subject_id=s.subject_id inner join tbl_course c on s.course_id=c.course_id where s.subject_id='".$_GET['Sid']."' ";
$result = $con->query($selQuery);

$i=0;
$output = "";
while($note = $result->fetch_assoc()){
    $output .= "<tr>
        <td>".++$i."</td>
        <td>".$note['course_name']."</td>
        <td>".$note['subject_name']."</td>
        <td>".$note['note_name']."</td>
        <td>".$note['note_desc']."</td>
        <td><a href='../Assets/File/NoteDoc/".$note['note_file']."'>View File</a></td>
    </tr>";
}
if($i == 0){
    $output = "<tr><td colspan='6'>No notes found</td></tr>";
}

echo $output;
?>