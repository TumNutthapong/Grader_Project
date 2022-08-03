<meta charset="UTF-8">
<?php
include('connections/mysqli.php');


$filecpp = $_POST['cpp'];
$user_id = $_POST['user_id'];
$score = $_POST['score'];

$user_name = $_POST['user_name'];
$user_surname = $_POST['user_surname'];
$user_stdcode = $_POST['user_stdcode'];
$ex_name = $_POST['ex_name'];
$datetime = $_POST['datetime'];
$dateline = $_POST['dateline'];
$sum = $_POST['test_score'];

if($dateline>=$datetime)
{ 
$status = "สำเร็จ";
}
else
{
$status = "ล่าช้า";
}



echo "$submission_id<br>";
echo "$sum<br>";
echo "$filecpp<br>";




  $sql="INSERT INTO tb_submission (user_id,user_name,user_surname,user_stdcode,ex_name,cpp,test_score,datetime,status) 
        values ('$user_id','$user_name','$user_surname','$user_stdcode','$ex_name','$filecpp','$sum','$datetime','$status')";
  $query=mysqli_query($Connection,$sql);



  mysqli_close($Connection);
  header("location:sub_record.php?user_id=$user_id");


 
?>



 