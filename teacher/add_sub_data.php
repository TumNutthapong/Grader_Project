<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}


       $sql = "INSERT INTO tb_sub (sub_id,sub_name) VALUES ('".$_POST["sub_id"]."','".$_POST["sub_name"]."')";
       $query = mysqli_query($Connection,$sql);

    header("location:sub.php");

       exit();
       mysqli_close($Connection);
       
       
       
?>


