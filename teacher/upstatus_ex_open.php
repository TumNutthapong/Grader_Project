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

$sql = "UPDATE tb_ex SET status_ex = 'เปิด' WHERE ex_no = $ex_no";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);


  header("location:ex.php?update=pass");
  exit();

?>

