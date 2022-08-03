<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM tb_user WHERE user_id = '".$id."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
  $sql_2 = "UPDATE tb_user SET user_username = '".$_POST['user_username']."', user_name = '".$_POST['user_name']."', user_surname = '".$_POST['user_surname']."',
    user_sec = '".$_POST['user_sec']."', user_stdcode = '".$_POST['user_stdcode']."', user_level = '".$_POST['user_level']."' WHERE user_id = '".$id."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:user.php?update=pass");
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
            <h1 class="h2">แก้ไขข้อมูลผู้ใช้งาน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='user.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header"><?php echo 'ID : '.$result['user_stdcode']; ?></h5>
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label class="form-label">ชื่อผู้ใช้</label>
                      <input type="text" class="form-control" name="user_username" value="<?php echo $result['user_username']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">ชื่อ</label>
                      <input type="text" class="form-control" name="user_name" value="<?php echo $result['user_name']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">นามสกุล</label>
                      <input type="text" class="form-control" name="user_surname" value="<?php echo $result['user_surname']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">หมู่เรียน</label>
                      <select class="form-select" name="user_sec">
                        <option value="700" <?php if ($result["user_sec"] == '700') {echo " selected";} ?>>700</option>
                        <option value="800" <?php if ($result["user_sec"] == '800') {echo " selected";} ?>>800</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">รหัสนิสิต</label>
                      <input type="text" class="form-control" name="user_stdcode" value="<?php echo $result['user_stdcode']; ?>" maxlength="10" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">ระดับผู้ใช้</label>
                      <select class="form-select" name="user_level">
                        <option value="student" <?php if ($result["user_level"] == 'student') {echo " selected";} ?>>นักเรียน</option>
                        <option value="teacher" <?php if ($result["user_level"] == 'teacher') {echo " selected";} ?>>อาจารย์</option>
                      </select>
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
