<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$ex_no = $_GET["ex_no"];

$sql = "DELETE FROM tb_ex WHERE ex_no = '".$ex_no."' ";
$query = mysqli_query($Connection,$sql);

if (mysqli_affected_rows($Connection)) {
  header("location:ex.php?delete=pass");
  exit();
}

mysqli_close($Connection);
?>
