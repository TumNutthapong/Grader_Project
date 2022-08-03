<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();}

include('mysqli.php');
$sub_name = $_GET['sub_name'];

$sql = "SELECT * FROM tb_ex WHERE sub_name = '$sub_name' AND status_ex = 'เปิด'";
$query = mysqli_query($Connection,$sql);
  
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
  
            <div class="jumbotron mt-4">
              <h5 class="display-5"><center>แบบฝึกหัด</center></h5><br>
            </div>

            <center>
            <?php foreach ($query as $sql) { ?>

            <div class="card-body">
            <div class="card" style="width: 50rem; margin-bottom: 5px; margin-right: 30px;" >
              <a style="width:100%;" href="ex_detail.php?ex_no=<?php echo $sql['ex_no'] ?>" class="btn btn-outline-dark">

                <h1 class="card-title"><?php echo $sql['ex_name']; ?></h1>
                <p class="card-text">วิชา: <?php echo $sql['sub_name']; ?>  
                <p class="card-text">คะแนน: <?php echo $sql['score']; ?> คะแนน</p>
              </a>
                
            </div>
            </div>
            <?php } ?>
            <center>




  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
