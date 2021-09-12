<?php 


  $hostname = "localhost";
  $username = "root";
  $password = "";
  $databaseName = "ajax";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());

 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];
 $email = $_POST['email'];
 $mobile = $_POST['mobile'];
 $designation = $_POST['designation'];
 $gender = $_POST['gender'];
//echo $designation;

  $query = "INSERT INTO `registration_form`(`firstname`, `lastname`, `email`, `designation`,`mobile`,`gender`) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$designation}','{$mobile}','{$gender}')";

  if(mysqli_query($connect, $query)){
  	echo 1;
  }else {
  	echo 0;
  }
