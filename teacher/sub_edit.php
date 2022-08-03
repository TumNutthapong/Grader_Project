<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$sub_no = $_GET["sub_no"];

$sql = "SELECT * FROM tb_sub WHERE sub_no = '".$sub_no."'";
$query = mysqli_query($Connection,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
  $sql_2 = "UPDATE tb_sub SET sub_name = '".$_POST['sub_name']."', sub_id = '".$_POST['sub_id']."' WHERE sub_no = '".$sub_no."'";
  $query_2 = mysqli_query($Connection,$sql_2);

  header("location:sub.php?update=pass");
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
            <h1 class="h2">แก้ไขข้อมูลห้องเรียน</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='sub.php'">ย้อนกลับ</button>
            </div>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-6">
              <div class="card">
                <h5 class="card-header"><?php echo 'ID : '.$result['sub_no']; ?></h5>
                <div class="card-body">
                  <form method="post">
                    <div class="mb-3">
                      <label class="form-label">ชื่อห้องเรียน</label>
                      <input type="text" class="form-control" name="sub_name" value="<?php echo $result['sub_name']; ?>" required/>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">รหัสห้องเรียน</label>
                      <input type="text" class="form-control" name="sub_id" value="<?php echo $result['sub_id']; ?>" required/>
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
