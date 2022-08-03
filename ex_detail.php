<?php
require_once('connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:login.php");
  exit();}

include('mysqli.php');
$ex_no = $_GET['ex_no'];

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

 
    <?php
      $sql = "SELECT * FROM tb_user INNER JOIN tb_ex WHERE user_id AND ex_no = $ex_no";
               
      $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
      $row = mysqli_fetch_array($result);

    ?>

      

        <div class="container" style="margin-top:10px; margin-bottom:150px;">
        <center><br>
                <h1 class="card-title"><?php echo $row['ex_name']; ?></h1>
                <p class="card-text">ห้องเรียน: <?php echo $row['sub_name']; ?>  
                <p class="card-text">คะแนนเต็ม: <?php echo $row['score']; ?> คะแนน</p>
                <h5 class="card-text" style="color:red;">กำหนดส่ง: <?php echo $row['deadline']; ?></h5>
                <embed type="application/pdf" src="pdf/<?php echo $row['pdf'] ; ?>" width="900" height="500">
        </center><br>

      
      <form class="modal-content" method="post" action="submit_data.php" enctype="multipart/form-data">
            
                <input type="hidden" class="form-control" name="ex_no" value="<?php echo $row['ex_no']; ?>" required/>
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $result_tb_user[user_id]; ?>" required/>
                <input type="hidden" class="form-control" name="user_name" value="<?php echo $result_tb_user[user_name]; ?>" required/>
                <input type="hidden" class="form-control" name="user_surname" value="<?php echo $result_tb_user[user_surname]; ?>" required/>
                <input type="hidden" class="form-control" name="user_stdcode" value="<?php echo $result_tb_user[user_stdcode]; ?>" required/>
                <input type="hidden" class="form-control" name="ex_name" value="<?php echo $row[ex_name]; ?>" required/>
                <input type="hidden" class="form-control" name="score" value="<?php echo $row[score]; ?>" required/>
                <input type="hidden" class="form-control" name="datetime" value="<?=date('Y-m-d')?>" required/>
                <input type="hidden" class="form-control" name="dateline" value="<?php echo $row['deadline']; ?>" required/>
                

              
                
          
            <div class="mb-3">
                <label class="form-label">เลือกไฟล์โปรแกรมพื่อทำการตรวจ</label><br>
                <input id="cpp" type="file" name="cpp" class="form-control" value="" required>
            </div> 


        <div class="modal-footer">
            <button id="upload" type="submit" name="submit" value="Upload" class="btn btn-primary">เสร็จสิ้น</button>
        </div>
        </div>


      </form>




  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php mysqli_close($Connection);?>
</body>
</html>
