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

$sql = "SELECT * FROM tb_user WHERE user_id ORDER BY user_stdcode ASC";
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
            <h1 class="h2">ข้อมูลผู้ใช้งาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- เพิ่มข้อมูล -->
              <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add_data">เพิ่มข้อมูลอาจารย์</button>
              <div class="modal fade" id="add_data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <form class="modal-content" method="post" action="user_add_data.php">
                    <div class="modal-header">
                      <h5 class="modal-title">เพิ่มข้อมูลอาจารย์</h5>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="user_username" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" name="user_password" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="user_name" required/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="user_surname" required/>
                      </div>
                      
                      
                      <div>
                        <label class="form-label">ระดับผู้ใช้</label>
                        <select class="form-select" name="user_level">
                          <option value="student">อาจารย์</option>
                          
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- ค้นหาข้อมูลนักเรียน -->
          <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-12 py-4">
        <form class="row" method="POST">
          <div class="col col-lg-2">
            <select class="form-select" name="select" required>
              <option value="" selected disabled> -- เลือกข้อมูล -- </option>
              <option value="user_stdcode" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'user_stdcode') {echo 'selected';}} ?>>รหัสนักศึกษา</option>
              <option value="user_name" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'user_name') {echo 'selected';}} ?>>ชื่อ</option>
              <option value="user_surname" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'user_surname') {echo 'selected';}} ?>>นามสกุล</option>
              <option value="user_sec" <?php if (isset($_POST['select'])) {if ($_POST['select'] == 'user_sec') {echo 'selected';}} ?>>หมู่เรียน</option>
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
          $sql = "SELECT * FROM tb_user WHERE ".$_POST['select']." LIKE '".$_POST['value']."%'";
          $query = mysqli_query($Connection,$sql);
          $check_data = mysqli_num_rows($query);
          if ($check_data == 0) {
            echo '<p class="text-center py-4"><span class="badge bg-danger" style="font-size: 20px;">ไม่พบข้อมูล</span></p>';
          }else{
            ?>
            
            <table class="table table-bordered table-hover"> <!-- table-sm -->
            <thead>
              <tr class="table-info">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col" width="130px">รหัสผ่าน</th>
                <th scope="col">ขื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">หมู่เรียน</th>
                <th scope="col">รหัสนิสิต</th>
                <th scope="col">ระดับผู้ใช้</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['user_username']; ?></td>
                  <td>
                    <!-- เปลี่ยนรหัสผ่าน -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_password<?php echo $result['user_id']; ?>">
                      เปลี่ยนรหัสผ่าน
                    </button>
                    <div class="modal fade" id="edit_password<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content" method="post" action="user_edit_password.php">
                          <div class="modal-header">
                            <h5 class="modal-title">เปลี่ยนรหัสผ่านผู้ใช้ ID : <?php echo $result['user_stdcode']; ?></h5>
                          </div>
                          <div class="modal-body">
                            <div>
                              <label class="form-label">รหัสผ่านใหม่</label>
                              <input type="password" class="form-control" name="user_password" required/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $result['user_id']; ?>"/>
                        </form>
                      </div>
                    </div>
                  </td>
                  <td><?php echo $result['user_name']; ?></td>
                  <td><?php echo $result['user_surname']; ?></td>
                  <td><?php echo $result['user_sec']; ?></td>
                  <td><?php echo $result['user_stdcode']; ?></td>
                  <td><?php if ($result['user_level'] == "student") {echo "นักเรียน";}else{echo "อาจารย์";} ?></td>
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='user_edit.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['user_id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูล</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['user_username']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='user_delete.php?id=<?php echo $result['user_id'];?>'">ยืนยัน</button>
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
              <tr class="table-info">
                <th scope="col" width="65px">ลำดับที่</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col" width="130px">รหัสผ่าน</th>
                <th scope="col">ขื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">หมู่เรียน</th>
                <th scope="col">รหัสนิสิต</th>
                <th scope="col">ระดับผู้ใช้</th>
                <th scope="col" width="90px">ตัวเลือก</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <th scope="row"><?php echo $num++; ?></th>
                  <td><?php echo $result['user_username']; ?></td>
                  <td>
                    <!-- เปลี่ยนรหัสผ่าน -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_password<?php echo $result['user_id']; ?>">
                      เปลี่ยนรหัสผ่าน
                    </button>
                    <div class="modal fade" id="edit_password<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <form class="modal-content" method="post" action="user_edit_password.php">
                          <div class="modal-header">
                            <h5 class="modal-title">เปลี่ยนรหัสผ่านผู้ใช้ ID : <?php echo $result['user_stdcode']; ?></h5>
                          </div>
                          <div class="modal-body">
                            <div>
                              <label class="form-label">รหัสผ่านใหม่</label>
                              <input type="password" class="form-control" name="user_password" required/>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $result['user_id']; ?>"/>
                        </form>
                      </div>
                    </div>
                  </td>
                  <td><?php echo $result['user_name']; ?></td>
                  <td><?php echo $result['user_surname']; ?></td>
                  <td><?php echo $result['user_sec']; ?></td>
                  <td><?php echo $result['user_stdcode']; ?></td>
                  <td><?php if ($result['user_level'] == "student") {echo "นักเรียน";}else{echo "อาจารย์";} ?></td>
                  <td>
                    <!-- ปุ่มแก้ไข -->
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='user_edit.php?id=<?php echo $result['user_id'];?>'"><i class="bi bi-pencil-square"></i></button>
                    <!-- ลบข้อมูล-->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_data<?php echo $result['user_id']; ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <div class="modal fade" id="delete_data<?php echo $result['user_id']; ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ลบข้อมูล</h5>
                          </div>
                          <div class="modal-body">
                            กดยืนยันหากคุณต้องการลบผู้ใช้ <?php echo $result['user_username']; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='user_delete.php?id=<?php echo $result['user_id'];?>'">ยืนยัน</button>
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
