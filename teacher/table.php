<?php
require_once('../connections/mysqli.php');

if(isset($_POST['submit'])){

$table_name=mysqli_real_escape_string($Connection,$_POST['table_name']);

$result =  mysqli_query($Connection,"SHOW TABLES LIKE '".$table_name."'");
if($result->num_rows == 1) {

    echo '<script language="javascript">';
    echo 'alert("Table exists, Please try again")';
    echo '</script>';
}
else {

    $table5 = "CREATE TABLE $table_name ( sub_id INT(250) UNSIGNED AUTO_INCREMENT PRIMARY KEY,sub_name VARCHAR(200), 
        sub_sec VARCHAR(200))";
    $res5=mysqli_query($Connection,$table5);

    echo '<script language="javascript">';
    echo 'alert("Table Successfully Created ")';
    echo '</script>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>ระบบหลังบ้าน</title>

</head>
<body> 
<?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    
    <form action="" method="post" style="margin-top: 50px;margin-left: 70px;">
        <h3>ตั้งชื่อวิชาเรียนที่ต้องการ</h3>
        <input type="text" name="table_name"><br/><br/>
        <input type="submit" name="submit" value="submit">
    </form>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
</body>
</html>