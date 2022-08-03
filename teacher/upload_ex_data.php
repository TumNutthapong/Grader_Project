<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "teacher") {
  header("location:../index.php");
  exit();
}

$ex_name = $_POST['ex_name'];
$sub_name = $_POST['sub_name'];
$score = $_POST['score'];
$deadline = $_POST['deadline'];

include 'mysqli.php';
if (isset($_POST['submit'])) {
  $DateNow=Date("d_m_Y_H_i_s_");  //เปลี่ยนชื่อโดยการใส่วันที่และเวลาที่นำไฟล์เข้านำหน้าชื่อเดิม
  $pdf=$DateNow.$_FILES['pdf']['name'];
  $pdf_type=$_FILES['pdf']['type'];
  $pdf_size=$_FILES['pdf']['size'];
  $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
  $pdf_store="C:/AppServ/www/grader/pdf/".$pdf;

  move_uploaded_file($pdf_tem_loc,$pdf_store);

  $in1=$DateNow.$_FILES['in1']['name'];
  $in1_type=$_FILES['in1']['type'];
  $in1_size=$_FILES['in1']['size'];
  $in1_tem_loc=$_FILES['in1']['tmp_name'];
  $in1_store="C:/AppServ/www/grader/cpp/".$in1;

  move_uploaded_file($in1_tem_loc,$in1_store);

  $in2=$DateNow.$_FILES['in2']['name'];
  $in2_type=$_FILES['in2']['type'];
  $in2_size=$_FILES['in2']['size'];
  $in2_tem_loc=$_FILES['in2']['tmp_name'];
  $in2_store="C:/AppServ/www/grader/cpp/".$in2;

  move_uploaded_file($in2_tem_loc,$in2_store);

  $in3=$DateNow.$_FILES['in3']['name'];
  $in3_type=$_FILES['in3']['type'];
  $in3_size=$_FILES['in3']['size'];
  $in3_tem_loc=$_FILES['in3']['tmp_name'];
  $in3_store="C:/AppServ/www/grader/cpp/".$in3;

  move_uploaded_file($in3_tem_loc,$in3_store);

  $in4=$DateNow.$_FILES['in4']['name'];
  $in4_type=$_FILES['in4']['type'];
  $in4_size=$_FILES['in4']['size'];
  $in4_tem_loc=$_FILES['in4']['tmp_name'];
  $in4_store="C:/AppServ/www/grader/cpp/".$in4;

  move_uploaded_file($in4_tem_loc,$in4_store);

  $in5=$DateNow.$_FILES['in5']['name'];
  $in5_type=$_FILES['in5']['type'];
  $in5_size=$_FILES['in5']['size'];
  $in5_tem_loc=$_FILES['in5']['tmp_name'];
  $in5_store="C:/AppServ/www/grader/cpp/".$in5;

  move_uploaded_file($in5_tem_loc,$in5_store);

  $in6=$DateNow.$_FILES['in6']['name'];
  $in6_type=$_FILES['in6']['type'];
  $in6_size=$_FILES['in6']['size'];
  $in6_tem_loc=$_FILES['in6']['tmp_name'];
  $in6_store="C:/AppServ/www/grader/cpp/".$in6;

  move_uploaded_file($in6_tem_loc,$in6_store);

  $in7=$DateNow.$_FILES['in7']['name'];
  $in7_type=$_FILES['in7']['type'];
  $in7_size=$_FILES['in7']['size'];
  $in7_tem_loc=$_FILES['in7']['tmp_name'];
  $in7_store="C:/AppServ/www/grader/cpp/".$in7;

  move_uploaded_file($in7_tem_loc,$in7_store);

  $in8=$DateNow.$_FILES['in8']['name'];
  $in8_type=$_FILES['in8']['type'];
  $in8_size=$_FILES['in8']['size'];
  $in8_tem_loc=$_FILES['in8']['tmp_name'];
  $in8_store="C:/AppServ/www/grader/cpp/".$in8;

  move_uploaded_file($in8_tem_loc,$in8_store);

  $in9=$DateNow.$_FILES['in9']['name'];
  $in9_type=$_FILES['in9']['type'];
  $in9_size=$_FILES['in9']['size'];
  $in9_tem_loc=$_FILES['in9']['tmp_name'];
  $in9_store="C:/AppServ/www/grader/cpp/".$in9;

  move_uploaded_file($in9_tem_loc,$in9_store);

  $in10=$DateNow.$_FILES['in10']['name'];
  $in10_type=$_FILES['in10']['type'];
  $in10_size=$_FILES['in10']['size'];
  $in10_tem_loc=$_FILES['in10']['tmp_name'];
  $in10_store="C:/AppServ/www/grader/cpp/".$in10;

  move_uploaded_file($in10_tem_loc,$in10_store);

  $out1=$DateNow.$_FILES['out1']['name'];
  $out1_type=$_FILES['out1']['type'];
  $out1_size=$_FILES['out1']['size'];
  $out1_tem_loc=$_FILES['out1']['tmp_name'];
  $out1_store="C:/AppServ/www/grader/cpp/".$out1;

  move_uploaded_file($out1_tem_loc,$out1_store);

  $out2=$DateNow.$_FILES['out2']['name'];
  $out2_type=$_FILES['out2']['type'];
  $out2_size=$_FILES['out2']['size'];
  $out2_tem_loc=$_FILES['out2']['tmp_name'];
  $out2_store="C:/AppServ/www/grader/cpp/".$out2;

  move_uploaded_file($out2_tem_loc,$out2_store);

  $out3=$DateNow.$_FILES['out3']['name'];
  $out3_type=$_FILES['out3']['type'];
  $out3_size=$_FILES['out3']['size'];
  $out3_tem_loc=$_FILES['out3']['tmp_name'];
  $out3_store="C:/AppServ/www/grader/cpp/".$out3;

  move_uploaded_file($out3_tem_loc,$out3_store);

  $out4=$DateNow.$_FILES['out4']['name'];
  $out4_type=$_FILES['out4']['type'];
  $out4_size=$_FILES['out4']['size'];
  $out4_tem_loc=$_FILES['out4']['tmp_name'];
  $out4_store="C:/AppServ/www/grader/cpp/".$out4;

  move_uploaded_file($out4_tem_loc,$out4_store);

  $out5=$DateNow.$_FILES['out5']['name'];
  $out5_type=$_FILES['out5']['type'];
  $out5_size=$_FILES['out5']['size'];
  $out5_tem_loc=$_FILES['out5']['tmp_name'];
  $out5_store="C:/AppServ/www/grader/cpp/".$out5;

  move_uploaded_file($out5_tem_loc,$out5_store);

  $out6=$DateNow.$_FILES['out6']['name'];
  $out6_type=$_FILES['out6']['type'];
  $out6_size=$_FILES['out6']['size'];
  $out6_tem_loc=$_FILES['out6']['tmp_name'];
  $out6_store="C:/AppServ/www/grader/cpp/".$out6;

  move_uploaded_file($out6_tem_loc,$out6_store);

  $out7=$DateNow.$_FILES['out7']['name'];
  $out7_type=$_FILES['out7']['type'];
  $out7_size=$_FILES['out7']['size'];
  $out7_tem_loc=$_FILES['out7']['tmp_name'];
  $out7_store="C:/AppServ/www/grader/cpp/".$out7;

  move_uploaded_file($out7_tem_loc,$out7_store);

  $out8=$DateNow.$_FILES['out8']['name'];
  $out8_type=$_FILES['out8']['type'];
  $out8_size=$_FILES['out8']['size'];
  $out8_tem_loc=$_FILES['out8']['tmp_name'];
  $out8_store="C:/AppServ/www/grader/cpp/".$out8;

  move_uploaded_file($out8_tem_loc,$out8_store);

  $out9=$DateNow.$_FILES['out9']['name'];
  $out9_type=$_FILES['out9']['type'];
  $out9_size=$_FILES['out9']['size'];
  $out9_tem_loc=$_FILES['out9']['tmp_name'];
  $out9_store="C:/AppServ/www/grader/cpp/".$out9;

  move_uploaded_file($out9_tem_loc,$out9_store);

  $out10=$DateNow.$_FILES['out10']['name'];
  $out10_type=$_FILES['out10']['type'];
  $out10_size=$_FILES['out10']['size'];
  $out10_tem_loc=$_FILES['out10']['tmp_name'];
  $out10_store="C:/AppServ/www/grader/cpp/".$out10;

  move_uploaded_file($out10_tem_loc,$out10_store);
  

  
  $sql="INSERT INTO tb_ex (ex_name,pdf,sub_name,score,deadline,in1,in2,in3,in4,in5,in6,in7,in8,in9,in10,out1,out2,out3,out4,out5,out6,out7,out8,out9,out10) 
    values ('$ex_name','$pdf','$sub_name','$score','$deadline','$in1','$in2','$in3','$in4','$in5','$in6','$in7','$in8','$in9','$in10','$out1','$out2','$out3','$out4','$out5','$out6','$out7','$out8','$out9','$out10')";
  $query=mysqli_query($Connection,$sql);

}

 
header("location:ex.php");
exit();

mysqli_close($Connection);


?>