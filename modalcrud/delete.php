<?php 


  $hostname = "localhost";
  $username = "root";
  $password = "";
  $databaseName = "ajax";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());

 $id = $_POST['id'];
 

  $query = "DELETE FROM `registration_form` WHERE id = {$id}";

  if(mysqli_query($connect, $query)){
  	echo 1;
  }else {
  	echo 0;
  }
  ?>
