<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$sub_no = $_GET["sub_no"];
$sql = "DELETE FROM tb_sub WHERE sub_no = '".$sub_no."' ";
$query = mysqli_query($Connection,$sql);

if (mysqli_affected_rows($Connection)) {
  header("location:sub.php?delete=pass");
  exit();
}

mysqli_close($Connection);
?>
