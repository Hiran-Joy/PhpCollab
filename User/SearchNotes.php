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
                     <select name="sel_subject" id="sel_subject">
                        <option value="">----select subject----</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
    <script src="../Assets/JQuery/JQuery.js">
    console.log("JQuery connected");
    </script>
    <script>
        function getSubject(did)
        {
            console.log("getSubject fn called");
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
</body>
</html>