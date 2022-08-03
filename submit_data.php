<?php
include 'connections/mysqli.php';

$ex_no = $_POST['ex_no'];
$score = $_POST['score'];


$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_surname = $_POST['user_surname'];
$user_stdcode = $_POST['user_stdcode'];
$ex_name = $_POST['ex_name'];
$datetime = $_POST['datetime'];
$dateline = $_POST['dateline'];



if (isset($_POST['submit'])) {
  $DateNow=Date("d_m_Y_H_i_s_"); //เปลี่ยนชื่อโดยการใส่วันที่และเวลาที่นำไฟล์เข้านำหน้าชื่อเดิม
  $cpp=$DateNow.$_FILES['cpp']['name'];
  $cpp_type=$_FILES['cpp']['type'];
  $cpp_size=$_FILES['cpp']['size'];
  $cpp_tem_loc=$_FILES['cpp']['tmp_name'];
  $cpp_store="C:/AppServ/www/grader/cpp/".$cpp;

  move_uploaded_file($cpp_tem_loc,$cpp_store);

 

}

//mysqli_close($Connection);

?>

<?php

      $sql = "SELECT * FROM tb_submission WHERE submission_id AND cpp = '$cpp'";
               
      $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
      $row = mysqli_fetch_array($result);

  ?>



<form name="myform" class="modal-content" method="post" action="cpp/cmd.php">
  <input type="hidden" class="form-control" name="ex_name" value="<?php echo $ex_name; ?>"/>
  <input type="hidden" class="form-control" name="cpp" value="<?php echo $cpp; ?>"/>
  <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>"/>
  <input type="hidden" class="form-control" name="score" value="<?php echo $score; ?>"/>
  <input type="hidden" class="form-control" name="datetime" value="<?php echo $datetime; ?>"/>
  <input type="hidden" class="form-control" name="dateline" value="<?php echo $dateline; ?>"/>
  <input type="hidden" class="form-control" name="user_name" value="<?php echo $user_name; ?>"/>
  <input type="hidden" class="form-control" name="user_surname" value="<?php echo $user_surname; ?>"/>
  <input type="hidden" class="form-control" name="user_stdcode" value="<?php echo $user_stdcode; ?>"/>
  

  <?php

      $sql = "SELECT * FROM tb_ex WHERE ex_no = $ex_no";
               
      $result = mysqli_query($Connection, $sql) or die ("Error in query: $sql " . mysqli_error());
      $row = mysqli_fetch_array($result);

  ?>

                <input type="hidden" class="form-control" name="in1" value="<?php echo $row['in1']; ?>"required/>
                <input type="hidden" class="form-control" name="in2" value="<?php echo $row['in2']; ?>"/>
                <input type="hidden" class="form-control" name="in3" value="<?php echo $row['in3']; ?>"/>
                <input type="hidden" class="form-control" name="in4" value="<?php echo $row['in4']; ?>"/>
                <input type="hidden" class="form-control" name="in5" value="<?php echo $row['in5']; ?>"/>
                <input type="hidden" class="form-control" name="in6" value="<?php echo $row['in6']; ?>"/>
                <input type="hidden" class="form-control" name="in7" value="<?php echo $row['in7']; ?>"/>
                <input type="hidden" class="form-control" name="in8" value="<?php echo $row['in8']; ?>"/>
                <input type="hidden" class="form-control" name="in9" value="<?php echo $row['in9']; ?>"/>
                <input type="hidden" class="form-control" name="in10" value="<?php echo $row['in10']; ?>"/>

                <input type="hidden" class="form-control" name="out1" value="<?php echo $row['out1']; ?>"required/>
                <input type="hidden" class="form-control" name="out2" value="<?php echo $row['out2']; ?>"/>
                <input type="hidden" class="form-control" name="out3" value="<?php echo $row['out3']; ?>"/>
                <input type="hidden" class="form-control" name="out4" value="<?php echo $row['out4']; ?>"/>
                <input type="hidden" class="form-control" name="out5" value="<?php echo $row['out5']; ?>"/>
                <input type="hidden" class="form-control" name="out6" value="<?php echo $row['out6']; ?>"/>
                <input type="hidden" class="form-control" name="out7" value="<?php echo $row['out7']; ?>"/>
                <input type="hidden" class="form-control" name="out8" value="<?php echo $row['out8']; ?>"/>
                <input type="hidden" class="form-control" name="out9" value="<?php echo $row['out9']; ?>"/>
                <input type="hidden" class="form-control" name="out10" value="<?php echo $row['out10']; ?>"/>
  
                

  <!-- script คำสั่งกด submit อัตโนมัติเพื่อส่งชื่อไฟล์ไปรัน -->
  <script language="JavaScript">document.myform.submit();</script>
</form>



      

 

