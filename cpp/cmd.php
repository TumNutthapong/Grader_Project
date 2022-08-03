<?php
include 'connections/mysqli.php';

$ex_name = $_POST['ex_name'];
$filecpp = $_POST['cpp'];
$user_id = $_POST['user_id'];
$score = $_POST['score'];

$user_name = $_POST['user_name'];
$user_surname = $_POST['user_surname'];
$user_stdcode = $_POST['user_stdcode'];
$ex_name = $_POST['ex_name'];
$datetime = $_POST['datetime'];
$dateline = $_POST['dateline'];

$in1 = $_POST['in1'];
$in2 = $_POST['in2'];
$in3 = $_POST['in3'];
$in4 = $_POST['in4'];
$in5 = $_POST['in5'];
$in6 = $_POST['in6'];
$in7 = $_POST['in7'];
$in8 = $_POST['in8'];
$in9 = $_POST['in9'];
$in10 = $_POST['in10'];

$out1 = $_POST['out1'];
$out2 = $_POST['out2'];
$out3 = $_POST['out3'];
$out4 = $_POST['out4'];
$out5 = $_POST['out5'];
$out6 = $_POST['out6'];
$out7 = $_POST['out7'];
$out8 = $_POST['out8'];
$out9 = $_POST['out9'];
$out10 = $_POST['out10'];




    $file="$filecpp";
    

    putenv("PATH=C:\Program Files (x86)\Dev-Cpp\MinGW64\bin");

    shell_exec("g++ $filecpp -o runcode.exe"); //compile

    
  $point=0;
   
   $testcases = array(
              array("$in1","$out1"),
              array("$in2","$out2"),
              array("$in3","$out3"),
              array("$in4","$out4"),
              array("$in5","$out5"),
              array("$in6","$out6"),
              array("$in7","$out7"),
              array("$in8","$out8"),
              array("$in9","$out9"),
              array("$in10","$out10")
              );
   
  foreach ($testcases as $testcase) {
    $read_in=file_get_contents("$testcase[0]");
    $read_out=file_get_contents("$testcase[1]");

    //echo "$read_in <br>";
    //echo "$read_out <br>";

    $answer = shell_exec("runcode.exe < $testcase[0]");
    //echo "คำตอบ: $answer<br>";


  if ($answer==$read_out){

      $point = $point+10;
      }else{
        $point = $point+0;
     }//echo "ได้: $point<br><br>";

  }
//$sum คือ คะแนนสุทธิ
  $sum = $score*($point/100);
  
 //$point คือ คะแนนที่ได้จากการทดสอบเทสเคส ผลออกมาเป็น %
  //echo "คะแนนที่ได้: $point %<br>";

//$score คือ คะแนนเต็มที่โจทย์ระบุไว้
  //echo "คะแนนเต็ม: $score คะแนน<br>";

  //echo "คะแนนรวมๆๆ: $sum คะแนน";

 
   
//อ่านเนื้อหาในไฟล์โดยเก็บไว้ในตัวแปล $readfile
$readfile=file_get_contents("$filecpp");
?>


<style>
    .txtarea {
resize: none;
outline: none;
width: 100%;
height: 200px;
border: 3px solid #CCCCCC;
padding: 5px; font-family: Tahoma, sans-serif;
background-repeat: no-repeat;
font-size: 20px;
color:#FFFFFF;
}
    .txtarea1 {
resize: none;
outline: none;
width: 100%;
height: 200px;
border: 3px solid #CCCCCC;
padding: 5px; font-family: Tahoma, sans-serif;
background-repeat: no-repeat;
font-size: 30px;
color:#FFFFFF;
}
</style>

<!--form method="POST">
    <textarea name="cppcode" style="background:black;" placeholder="Enter C++ Code" class="txtarea"><?php echo $readfile; ?></textarea>
    
    <textarea name="cppcode2" style="background:green" disabled class="txtarea1" placeholder="See Result"><?php echo $sum; ?></textarea>
</form-->






<form name="myform" class="modal-content" method="post" action="../up_point.php">
  <input type="hidden" class="form-control" name="ex_name" value="<?php echo $ex_name; ?>"/>
  <input type="hidden" class="form-control" name="cpp" value="<?php echo $filecpp; ?>"/>
  <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>"/>
  <input type="hidden" class="form-control" name="score" value="<?php echo $score; ?>"/>
  <input type="hidden" class="form-control" name="test_score" value="<?php echo $sum; ?>"/>
  <input type="hidden" class="form-control" name="datetime" value="<?php echo $datetime; ?>"/>
  <input type="hidden" class="form-control" name="dateline" value="<?php echo $dateline; ?>"/>
  <input type="hidden" class="form-control" name="user_name" value="<?php echo $user_name; ?>"/>
  <input type="hidden" class="form-control" name="user_surname" value="<?php echo $user_surname; ?>"/>
  <input type="hidden" class="form-control" name="user_stdcode" value="<?php echo $user_stdcode; ?>"/>
</form>

  <!-- script คำสั่งกด submit อัตโนมัติ -->
  <script language="JavaScript">document.myform.submit();</script>



