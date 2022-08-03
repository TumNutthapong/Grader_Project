<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

if (isset($_GET["add"])) {
  if ($_GET["add"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["update"])) {
  if ($_GET["update"] == "pass") {
    $check_submit = check_submit_p2("บันทึกข้อมูลเรียบร้อยแล้ว");
  }
}
if (isset($_GET["delete"])) {
  if ($_GET["delete"] == "pass") {
    $check_submit = check_submit_p2("ลบข้อมูลออกจากระบบเรียบร้อยแล้ว");
  }
}

$num = 1;
$ex_name = $_GET['ex_name'];

$sql = "SELECT * FROM tb_submission WHERE ex_name = '$ex_name'  ";
$query = mysqli_query($Connection,$sql);
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
            <h1 class="h2">ข้อมูลการส่งงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <input type='button' class="btn btn-secondary" value='ย้อนกลับ' onclick='javascript:window.history.back()'>
            </div>
          </div>

          
          <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> 
            <thead>
              <tr class="table-success">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อโจทย์</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">รหัสนิสิต</th>
                <th scope="col">สถานะการส่ง</th>
                <th scope="col">คะแนนที่ได้</th>
                <th scope="col" >รายละเอียดงานที่ส่ง</th>
                
               
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['ex_name']; ?></td>
                  <td><?php echo $result['user_name']; ?></td>
                  <td><?php echo $result['user_surname']; ?></td>
                  <td><?php echo $result['user_stdcode']; ?></td>
                  <td><?php
                      $status = $result['status'];
                      if ($status == "สำเร็จ") {
                        echo "<b><p style='color:#33CC33	;'>".สำเร็จ."</p><b>";
                      } else {
                        echo "<b><p style='color:red;'>".ล่าช้า."</p><b>";
                      }
                    ?>
                </td>
                  <td><b><?php echo $result['test_score']; ?><b></td>
                  

                  <!-- ปุ่มดูโค้ดงานที่ส่ง -->
                  <td><center><button type="button" class="btn btn-info btn-sm" onclick="window.location.href='../cpp/<?php echo $result['cpp'];?>'">ดูรายละเอียดงาน</button></center></td>
      
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </main>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
