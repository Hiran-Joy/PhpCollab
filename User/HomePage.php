<?php
session_start();
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['uname'];  ?></h1>
    <a href="MyProfile.php">MyProfile</a>
    <a href="Noteupload.php">NoteUpload</a>
    <a href="SearchNotes.php">Search Note</a>
    <a href="FeedBack.php">Feedback</a>
    <a href="MyProfile.php">Myprofile</a>
</body>
</html> 