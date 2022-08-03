<?php
require_once('connections/mysqli.php');

if ($_SESSION != NULL) {
  header("location:index.php");
  exit();
}

$check_submit = "";
$user_username = "";
$user_name = "";
$user_surname = "";
$user_sec = "";
$user_stdcode = "";

if (isset($_POST["submit"])) {
  $sql = "SELECT * FROM tb_user WHERE user_username = '".trim($_POST['user_username'])."'";
  $query = mysqli_query($Connection,$sql);
  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

  $user_username = $_POST["user_username"];
  $user_stdcode = $_POST["user_stdcode"];

  if ($result) {
    $check_submit = '<div class="alert alert-danger" role="alert">';
    $check_submit .= '<span><i class="bi bi-info-circle"></i> ชื่อผู้ใช้นี้มีผู้ใช้อื่นใช้งานแล้ว กรุณากรอกชื่อผู้ใช้ใหม่</span>';
    $check_submit .= '</div>';
  }else{
    $sql = "INSERT INTO tb_user (user_username,user_password,user_name,user_surname,user_sec,user_stdcode) VALUES ('".$_POST["user_username"]."','".$_POST["user_password"]."','".$_POST["user_name"]."','".$_POST["user_surname"]."','".$_POST["user_sec"]."','".$_POST["user_stdcode"]."')";
    $query = mysqli_query($Connection,$sql);
    
    header("location:login.php?register=success");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
</head>
<body class="default">
  <?php include 'includes/navbar.php';?>
  <div class="container-fluid">
    <div class="col-md-12 mt-4">
      <div class="row justify-content-md-center">
        <div class="col-md-auto"><?php echo $check_submit;?></div>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-5 mb-4">
        <div class="card border-dark mt-2">
          <h5 class="card-header">Register</h5>
          <div class="card-body">
            <div class="row justify-content-md-center mb-2">
              <div class="col col-lg-6">
                <img src="images/regis.png" style="width: 100%;">
              </div>
            </div>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" name="user_username" value="<?php echo $user_username;?>" placeholder="Enter Username" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="user_password" placeholder="Enter Password" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="user_name" value="<?php echo $user_name;?>" placeholder="Enter Name" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="user_surname" value="<?php echo $user_surname;?>" placeholder="Enter Surname" required/>
              </div>
              <div class="mb-3">
                <label class="form-label">หมู่เรียน</label>
                <select class="form-select" name="user_sec">
                  <option value="700">700</option>
                  <option value="800">800</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">รหัสนิสิต</label>
                <input type="text" class="form-control" name="user_stdcode" value="<?php echo $user_stdcode;?>" placeholder="Enter Code" maxlength="10" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
              </div>
              <button type="submit" class="btn btn-success" name="submit">สมัครสมาชิก</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
