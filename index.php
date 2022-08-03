<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();}

include('mysqli.php');
//query ข้อมูลจากตาราง:
$query = "SELECT * FROM tb_sub ORDER BY sub_name asc ";

$result = mysqli_query($Connection, $query);

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
              <h1 class="display-5"><center>เลือกห้องเรียนที่ต้องการ</center></h1>
            </div>

            <center>
            <?php foreach ($result as $query) { ?>

            <div class="card-body">
            <div class="card" style="width: 50rem; margin-bottom: 5px; margin-right: 30px;" >
              <a style="width:100%;" href="show_ex.php?sub_name=<?php echo $query['sub_name'] ?>" class="btn btn-outline-dark">

                <h1 class="card-title"><?php echo $query['sub_name']; ?></h1>
                <h4 class="card-title">รหัสวิชา: <?php echo $query['sub_id']; ?></h4>
                
              </a>
                
            </div>
            </div>
            <?php } ?>
            </center>
            
                     



  
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
