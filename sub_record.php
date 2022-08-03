<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();}
  $user_id = $_GET['user_id'];
include('mysqli.php');
//query ข้อมูลจากตาราง:
//$query = "SELECT * FROM tb_submission WHERE user_id = $user_id ";

$query = "SELECT * FROM tb_submission WHERE user_id= $user_id";

$result = mysqli_query($Connection, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
</head>
<body class="default">
  <?php include 'includes/navbar.php';?>
  
            <div class="jumbotron mt-4">
              <h1 class="display-5"><center>ประวัติการส่งงาน</center></h1>
            </div>

            
              
<?php

$num = 1;
$user_id = $_GET['user_id'];

$sql = "SELECT * FROM tb_submission WHERE user_id = '$user_id'  ";
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
  
  </head>

  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <main class="col-md-9 ms-sm col-lg-12 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ข้อมูลการส่งงาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            </div>
          </div>

          
          <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> 
            <thead>
              <tr class="table-success">
                
                <th scope="col">ชื่อโจทย์</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">รหัสนิสิต</th>
                <th scope="col">วันที่ส่ง</th>
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
                  
                  <td><b><?php echo $result['ex_name']; ?><b></td>
                  <td><?php echo $result['user_name']; ?></td>
                  <td><?php echo $result['user_surname']; ?></td>
                  <td><?php echo $result['user_stdcode']; ?></td>
                  <td><?php echo $result['datetime']; ?></td>
                  
                  <td><?php
                      $status = $result['status'];
                      if ($status == "สำเร็จ") {
                        echo "<center><b><p style='color:#33CC33	;'>".สำเร็จ."</p><b></center>";
                      } else {
                        echo "<center><b><p style='color:red;'>".ล่าช้า."</p><b></center>";
                      }
                    ?></td>
                  
                 
                  <td><center><b><?php echo $result['test_score']; ?><b></center></td>
                  

                  <!-- ปุ่มดูโค้ดงานที่ส่ง -->
                  <td><center><a class="card-title" href="cpp/<?php echo $result['cpp']; ?>" target="_blank">ดาวน์โหลด</a></center></td>

      
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
 
          




            
                     



  
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>