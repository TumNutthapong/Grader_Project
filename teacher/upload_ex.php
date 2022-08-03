<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}
?>

<?php
include('mysqli.php');
//query ข้อมูลจากตาราง:
$query = "SELECT * FROM tb_sub ORDER BY sub_name asc ";

$result = mysqli_query($Connection, $query);
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><br>

        <form class="modal-content" method="post" action="upload_ex_data.php" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h3 class="modal-title">กรอกข้อมูลเพื่อสร้างโจทย์</h3>
                    </div>

                  <div class="modal-body">
                      
                    <div class="mb-3">
                      <label class="form-label">โปรดเลือกห้องเรียน</label>
                        <select name="sub_name" class="form-control" required>
                          <option>เลือก...</option>
                            <?php foreach($result as $results){?>
                          <option value="<?php echo $results["sub_name"];?>">
                            <?php echo $results["sub_name"]; ?>
                          </option>
                            <?php } ?>
                        </select>
                    </div>

                      <div class="mb-3">
                        <label class="form-label">ชื่อโจทย์</label>
                        <input type="text" class="form-control" name="ex_name" required/>
                      </div>


                      <div class="mb-3">
                        <label class="form-label">เนื้อหาโจทย์ (PDF File)</label><br>
                        <input id="pdf" type="file" name="pdf" class="form-control" value="" required>
                      </div> 
     

                    <div class="form-group row">
                      <div class="col-md-2 mb-2">
                        <label class="form-label">คะแนนเต็ม</label>
                        <input type="text" class="form-control" name="score" maxlength="3" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label">กำหนดส่ง</label>
                        <input type="date" class="form-control" name="deadline" maxlength="3" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required/>
                      </div>
                    </div><br>
                    



                    <label class="form-label">Test Case **ต้องใส่ให้ครบทั้ง 10 ไฟล์** (File .in .out) </label><br>
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label">ไฟล์ in 1 :</label>
                      <div class="col-sm-5">
                        <input id="in1" type="file" name="in1" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 6 :</label>
                      <div class="col-sm-5">
                        <input id="in6" type="file" name="in6" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 1 :</label>
                      <div class="col-sm-5">
                        <input id="out1" type="file" name="out1" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 6 :</label>
                      <div class="col-sm-5">
                        <input id="out6" type="file" name="out6" class="form-control" value="" required><br>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 2 :</label>
                      <div class="col-sm-5">
                        <input id="in2" type="file" name="in2" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 7 :</label>
                      <div class="col-sm-5">
                        <input id="in7" type="file" name="in7" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 2 :</label>
                      <div class="col-sm-5">
                        <input id="out2" type="file" name="out2" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 7 :</label>
                      <div class="col-sm-5">
                        <input id="out7" type="file" name="out7" class="form-control" value="" required><br>
                      </div>
                      
                      <label class="col-sm-1 col-form-label">ไฟล์ in 3 :</label>
                      <div class="col-sm-5">
                        <input id="in3" type="file" name="in3" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 8 :</label>
                      <div class="col-sm-5">
                        <input id="in8" type="file" name="in8" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 3 :</label>
                      <div class="col-sm-5">
                        <input id="out3" type="file" name="out3" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 8 :</label>
                      <div class="col-sm-5">
                        <input id="out8" type="file" name="out8" class="form-control" value="" required><br>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 4 :</label>
                      <div class="col-sm-5">
                        <input id="in4" type="file" name="in4" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 9 :</label>
                      <div class="col-sm-5">
                        <input id="in9" type="file" name="in9" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 4 :</label>
                      <div class="col-sm-5">
                        <input id="out4" type="file" name="out4" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 9 :</label>
                      <div class="col-sm-5">
                        <input id="out9" type="file" name="out9" class="form-control" value="" required><br>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 5 :</label>
                      <div class="col-sm-5">
                        <input id="in5" type="file" name="in5" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ in 10 :</label>
                      <div class="col-sm-5">
                        <input id="in10" type="file" name="in10" class="form-control" value="" required>
                      </div>
                      
                      <label class="col-sm-1 col-form-label">ไฟล์ out 5 :</label>
                      <div class="col-sm-5">
                        <input id="out5" type="file" name="out5" class="form-control" value="" required>
                      </div>

                      <label class="col-sm-1 col-form-label">ไฟล์ out 10 :</label>
                      <div class="col-sm-5">
                        <input id="out10" type="file" name="out10" class="form-control" value="" required>
                      </div>
                    </div>
                    <br><br>
 

                      <div class="modal-footer">
                        <button id="upload" type="submit" name="submit" value="Upload" class="btn btn-primary">บันทึกข้อมูล</button>
                      </div>
                    

                  </div>
             
        </form>
        </main>     
      </div>
    </div>
    

    

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>

