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

$sql = "SELECT * FROM tb_sub WHERE sub_no ORDER BY sub_no ASC";
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
            <h1 class="h2">ข้อมูลห้องเรียน</h1>
          </div>

          <!-- ค้นหาข้อมูลโจทย์ -->
          <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-12 py-4">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              <option value="sub_name" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'sub_name') {echo 'selected';}} ?>>ชื่อห้องเรียน</option>
              <option value="sub_id" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'sub_id') {echo 'selected';}} ?>>รหัสห้องเรียน</option>
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
          $sql = "SELECT * FROM tb_sub WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($Connection,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            
            <?php echo $check_submit;?>
          <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-success">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อห้องเรียน</th>
                <th scope="col">รหัสห้องเรียน</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                <th scope="row"><?php echo $num++; ?></th>
                  
                  <td><?php echo $result['sub_name']; ?></td>
                  <td><?php echo $result['sub_id']; ?></td>
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='sub_edit.php?sub_no=<?php echo $result['sub_no'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['sub_no']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['sub_no']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูลห้องเรียน</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบห้องเรียน <?php echo $result['sub_name']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='sub_delete.php?sub_no=<?php echo $result['sub_no'];?>'">ยืนยัน</button>
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
              <tr class="table-success">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อห้องเรียน</th>
                <th scope="col">รหัสห้องเรียน</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['sub_name']; ?></td>
                  <td><?php echo $result['sub_id']; ?></td>
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='sub_edit.php?sub_no=<?php echo $result['sub_no'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['sub_no']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['sub_no']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูลห้องเรียน</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบห้องเรียน <?php echo $result['sub_name']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='sub_delete.php?sub_no=<?php echo $result['sub_no'];?>'">ยืนยัน</button>
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
