<?php
include("../Assets/Connection/Connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Notes</title>
</head> 
<body>
    <form action="" method="post">
        <table border="1">
            <tr>
                <td>Course</td>
                <td>
                    <select name="sel_course" id="sel_course" onchange="getSubject(this.value)">
                        <option>----select course----</option>
                        <?php
                            $selCou="select * from tbl_course";
                            $row=$con->query($selCou);
                            $i=0;
                            while($data=$row->fetch_assoc()){

                            
                        ?>
                        <option value="<?php echo $data['course_id']; ?>">
                            <?php echo $data['course_name']; ?>
                        </option>
                        <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Subject
                </td>
                <td>
                     <select name="sel_subject" id="sel_subject" onchange="getNotes(this.value)">
                        <option value="">----select subject----</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>SlNo</th>
                <th>Course</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
            </tr>
        </thead>

         <tbody id="note_table">
            <tr><td colspan="6">Please select a course and subject</td></tr>
        </tbody>

        <!-- <?php
        $noteSel="select * from tbl_notes n inner join  tbl_subject s  on n.subject_id=s.subject_id inner join tbl_course c on s.course_id=c.course_id";
        $result=$con->query($noteSel);
        $i=0;
        while($notes=$result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $notes['course_name']; ?></td>
            <td><?php echo $notes['subject_name']; ?></td>
            <td><?php echo $notes['note_name']; ?></td>
            <td><?php echo $notes['note_desc']; ?></td>
            <td>
                <?php $file =  $notes['note_file'];?>
                <a href="../Assets/File/NoteDoc/<?php echo $file; ?>">View file</a>
             </td>
        </tr>
        <?php
             }
        ?> -->
    </table>
    <script src="../Assets/JQuery/JQuery.js">
    </script>
    <script>
        function getSubject(did)
        {
            $.ajax({
              url:"../Assets/AjaxPages/AjaxSubject.php",
              data:{Did:did},
              success:function(response){
                $('#sel_subject').html(response);
                console.log("Subject data fetched");
              }
            })
        }
    </script>
    <script>
       function getNotes(sid)
       {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxNotes.php",
                data:{Sid:sid},
                success:function(response){
                    $("#note_table").html(response);
                }
            })
       } 
    </script>
</body>
</html>