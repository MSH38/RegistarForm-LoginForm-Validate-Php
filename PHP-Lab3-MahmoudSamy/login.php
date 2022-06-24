<?php
if(isset($_POST['sub'])){
  $mail =$_POST['mail'];
    $pass =$_POST['pass'];
    //$name =$_POST['name'];

  $exist=false;
  $data= file('validate.txt');

  foreach ($data as $record){
  // var_dump($record);
    $s_record= explode(",",$record);
    // var_dump($s_record);
    if ($s_record['1']===$pass & $s_record['2']===$mail){
      $name =$s_record['0'];
      $exist=true;
      echo"<h2> log in done</h2>";
      print_r($s_record);
    }
  }
  if($exist){
  session_start();
  $_SESSION['usr']=$name;
  }
  else{
    header("location: login.html?error_not_valid_mail_or_passward");
    exit();
  }
echo "<h3> welcome ".$_SESSION['usr']."</h3";
}
$data= fopen('validate.txt');
foreach ($data as $record){
  print_r($s_record);
    $s_record= explode(",",$record);
  if ($record['1']==$pass&$s_record['2']==$mail){
    $exist=true;
    echo"<h2> log in done</h2>";
  }
};

        