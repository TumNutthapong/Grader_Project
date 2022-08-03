<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><br>

        <form class="modal-content" method="post" action="add_sub_data.php" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h3 class="modal-title">ใส่ข้อมูลเพื่อสร้างห้องเรียน</h3>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">รหัสห้องเรียน</label>
                        <input type="text" class="form-control" name="sub_id" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อห้องเรียน</label>
                        <input type="text" class="form-control" name="sub_name" required/>
                      </div>
                    


                      </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
        </form>
               
       

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>

