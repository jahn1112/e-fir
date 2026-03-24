<?php
session_start();

session_destroy();
// $_SESSION['login']=false;


 echo "<script>
alert('LOGGED OUT SUCCESSFULLY!');
window.location.href='index.php';
</script>";

?>