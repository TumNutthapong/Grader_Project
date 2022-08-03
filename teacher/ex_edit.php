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


$sql = "SELECT * FROM tb_ex WHERE ex_no = '".$ex_no."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);


if (isset($_POST['submit'])) {
  $DateNow=Date("d_m_Y_H_i_s_");  //เปลี่ยนชื่อโดยการใส่วันที่และเวลาที่นำไฟล์เข้านำหน้าชื่อเดิม
  $pdf=$DateNow.$_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  $pdf_store="C:/AppServ/www/grader/pdf/".$pdf;

  move_uploaded_file($pdf_tem_loc,$pdf_store);



  $sql_2 = "UPDATE tb_ex SET ex_name = '".$_POST['ex_name']."',sub_name = '".$_POST['sub_name']."',score = '".$_POST['score']."', deadline = '".$_POST['deadline']."' WHERE ex_no = '".$ex_no."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:ex.php?update=pass");
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขข้อมูลโจทย์</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='ex.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <form method="post">

                  <div class="mb-3">
                  <?php
                    include('mysqli.php');
                    //query ข้อมูลจากตาราง:
                    $query = "SELECT * FROM tb_sub ORDER BY sub_name asc ";

                    $result1 = mysqli_query($Connection, $query);
                  ?>
                      <label class="form-label">โปรดเลือกห้องเรียน</label>
                        <select name="sub_name" class="form-control" required>
                          <option><?php echo $result["sub_name"]; ?></option>
                            <?php foreach($result1 as $results){?>
                          <option value="<?php echo $results["sub_name"];?>">
                            <?php echo $results["sub_name"]; ?>
                          </option>
                            <?php } ?>
                        </select>
                    </div>


      

                    <div class="mb-3">
                      <label class="form-label">ชื่อโจทย์</label>
                      <input type="text" class="form-control" name="ex_name" value="<?php echo $result['ex_name']; ?>" required/>
                    </div>
                    
                  

                    <div class="mb-3">
                      <label class="form-label">คะแนน</label>
                      <input type="text" class="form-control" name="score" value="<?php echo $result['score']; ?>" maxlength="3" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">กำหนดส่ง</label>
                      <input type="date" class="form-control" name="deadline" value="<?php echo $result['deadline']; ?>" required/>
                    </div>

                   
                   
                    <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
