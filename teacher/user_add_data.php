<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_level) 
        VALUES ('".$_POST["user_username"]."','".$_POST["user_password"]."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_level"]."')";
$query = mysqli_query($Connection,$sql);

header("location:user.php?add=pass");
exit();

mysqli_close($Connection);
?>
