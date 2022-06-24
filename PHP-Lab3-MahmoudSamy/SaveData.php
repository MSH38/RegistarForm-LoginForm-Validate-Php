<?php

function valid_mail ($mail){
$regx= "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";

if (!preg_match($regx,$mail))
{
  // header("location: signup.html?error_not_valid_mail");
  // exit();
  $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
  $email = $_POST['email'];
  if(empty($email)){
      echo "<span style='color:red;'> email notvalid </span>";
  }
}
else {
  return filter_var($mail,FILTER_VALIDATE_EMAIL);
}

$currentDirectory = getcwd();
$uploadDirectory = "/uploads/";
$errors = []; 
$fileExtensionsAllowed = ['jpeg','jpg','png']; 

if(isset($_POST['sub'])){
  $mail =$_POST['mail'];
  $pass =$_POST['pass'];
  $name =$_POST['name'];
  valid_mail($mail);
  $fileName = $_FILES['im']['name'];
  $fileSize = $_FILES['im']['size'];
  $fileTmpName  = $_FILES['im']['tmp_name'];
  $fileType = $_FILES['im']['type'];
  $ext=explode('.',$fileName);
  $fileExtension = strtolower(end($ext));

  $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }
    if ($fileSize > 4000000) {
      $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

      // if ($didUpload) {
      //   //echo "The file " . basename($fileName) . " has been uploaded";
      // } else {
      //     header("location: signup.html?error_not_valid_imge");
      //     exit();
      // }
    } else {
        foreach ($errors as $error) {
            header("location: signup.html?error_not_valid_mail");
            exit();
          //echo $error . "These are the errors" . "\n";
        }
    }}
    $myfile = fopen("validate.txt","a") or die("Unable to open file!");
    $txt=PHP_EOL .$name.','.$pass.','.$mail;
    fwrite($myfile, $txt);
    fclose($myfile);
    echo "registretion done";
    $data= file('custfile.txt');
}