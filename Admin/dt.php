<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="dt.php" method="post">
    <input type="date" placeholder="INPUT DATE" name="dt">
    <input type="time" name="tm" placeholder="INPUT TIME">
    <input type="submit" name="btn" value="Submit">

    </form>
</body>
</html>

<?php
if(isset($_POST['btn']))
{
    $dt = $_POST['dt'];
    $tm = $_POST['tm'];

    echo "DATE IS ----> " . $dt ." and TIME IS ----> " . $tm;
    
}

?>