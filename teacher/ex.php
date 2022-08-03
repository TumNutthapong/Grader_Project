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

$sql = "SELECT * FROM tb_ex WHERE ex_no ORDER BY ex_no ASC";
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
            <h1 class="h2">ข้อมูลโจทย์</h1>
          </div>

          <!-- ค้นหาข้อมูลโจทย์ -->
          <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-12 py-4">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              <option value="ex_name" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'ex_name') {echo 'selected';}} ?>>ชื่อโจทย์</option>
              <option value="pdf" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'pdf') {echo 'selected';}} ?>>ชื่อไฟล์ (PDF)</option>
              <option value="sub_name" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'sub_name') {echo 'selected';}} ?>>ชื่อห้องเรียน</option>
              <option value="score" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'score') {echo 'selected';}} ?>>คะแนน</option>
            </select>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="value" value="<?php if (isset($_POST['value'])) {echo $_POST['value'];} ?>" required/>
          </div>
          <div class="col-md-auto">
            <button type="submit" name="submit" class="btn btn-success">ค้นหา</button>
          </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $num = 1;
          $sql = "SELECT * FROM tb_ex WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($Connection,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            
            <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-danger">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อโจทย์</th>
                
                <th scope="col">ชื่อห้องเรียน</th>
                <th scope="col">คะแนน</th>
                <th scope="col">กำหนดส่ง</th>
                <th scope="col">ดูการส่งงาน</th>
                <th scope="col">เปิด-ปิดการส่ง</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['ex_name']; ?></td>
                  
                  <td><?php echo $result['sub_name']; ?></td>
                  <td><?php echo $result['score']; ?></td>
                  <td><?php echo $result['deadline']; ?></td>
                  

                  <!-- ปุ่มดูรายชื่อส่งงาน -->
                  <td><center><button type="button" class="btn btn-info btn-sm" onclick="window.location.href='submission.php?ex_name=<?php echo $result['ex_name'];?>'">ดูรายชื่อส่งงาน</button></center></td>

                  <!-- ปุ่มเปิด-ปิดการมองเห็น -->
                  <td><center>
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='upstatus_ex_close.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-eye-slash-fill">ปิด</i></button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='upstatus_ex_open.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-eye-fill ">เปิด</i></button>
                    &nbsp;&nbsp;&nbsp;
                    <?php
                      $status = $result['status_ex'];
                      if ($status == "เปิด") {
                        echo "<b style='color:blue;'>".เปิด."</b>";
                      } else {
                        echo "<b style='color:red;'>".ปิด."</b>";
                      }
                    ?>
                    </center>
                  </td>


                  
                  
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='ex_edit.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['ex_no']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['ex_no']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูลโจทย์</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบโจทย์ <?php echo $result['ex_name']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='ex_delete.php?ex_no=<?php echo $result['ex_no'];?>'">ยืนยัน</button>
                          </div>
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

            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>



          <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-danger">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อโจทย์</th>
                
                <th scope="col">ชื่อห้องเรียน</th>
                <th scope="col">คะแนน</th>
                <th scope="col">กำหนดส่ง</th>
                <th scope="col">ดูการส่งงาน</th>
                <th scope="col">เปิด-ปิดการส่ง</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['ex_name']; ?></td>
                  
                  <td><?php echo $result['sub_name']; ?></td>
                  <td><?php echo $result['score']; ?></td>
                  <td><?php echo $result['deadline']; ?></td>

                  <!-- ปุ่มดูรายชื่อส่งงาน -->
                  <td><center><button type="button" class="btn btn-info btn-sm" onclick="window.location.href='submission.php?ex_name=<?php echo $result['ex_name'];?>'">ดูรายชื่อส่งงาน</button></center></td>

                  <!-- ปุ่มเปิด-ปิดการมองเห็น -->
                  <td><center>
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='upstatus_ex_close.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-eye-slash-fill">ปิด</i></button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='upstatus_ex_open.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-eye-fill " >เปิด</i></button>
                    &nbsp;&nbsp;&nbsp;
                    
                    <?php
                      $status = $result['status_ex'];
                      if ($status == "เปิด") {
                        echo "<b style='color:blue;'>".เปิด."</b>";
                      } else {
                        echo "<b style='color:red;'>".ปิด."</b>";
                      }
                    ?>

                   </center>
                  </td>
                  

                  
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='ex_edit.php?ex_no=<?php echo $result['ex_no'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['ex_no']; ?>"><i class="bi bi-trash"></i></button>
                    <div class="modal fade" id="delete_data<?php echo $result['ex_no']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูลโจทย์</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบโจทย์ <?php echo $result['ex_name']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='ex_delete.php?ex_no=<?php echo $result['ex_no'];?>'">ยืนยัน</button>
                          </div>
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
