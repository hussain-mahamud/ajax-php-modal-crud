<?php 


  $hostname = "localhost";
  $username = "root";
  $password = "";
  $databaseName = "ajax";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());

 $id = $_POST['edit_id'];
 $edit_fname = $_POST['edit_fname'];
 $edit_lname = $_POST['edit_lname'];
 $edit_email = $_POST['edit_email'];
 $edit_mobile = $_POST['edit_mobile'];
 

 $query = "UPDATE registration_form SET firstname='{$edit_fname}',lastname='{$edit_lname}',email='{$edit_email}',mobile='{$edit_mobile}' WHERE id={$id}";

  if(mysqli_query($connect, $query)){
  	echo 1;
  }else {
  	echo 0;
  }
  ?>