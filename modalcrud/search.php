<?php 


  $hostname = "localhost";
  $username = "root";
  $password = "";
  $databaseName = "ajax";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());

  $search_term = $_POST['search_term'];

  $query = "SELECT * FROM registration_form WHERE firstname LIKE '%{$search_term}%' 
  				OR lastname LIKE '%{$search_term}%' OR id LIKE '%{$search_term}%'";
  $result = mysqli_query($connect, $query) or die("Query unsuccessful.");
  $output = "";
  if(mysqli_num_rows($result) > 0 ){

  	$output = '<table class="table table-hover">
				    <thead class="bg-success">
				      <tr>
				      	<th>S.No</th>
				      	<th>User ID</th>
				        <th>Name</th> 
				        <th>Email</th>
				        <th>Mobile</th>
				        <th>Delete Action</th>
				        <th>Edit Action</th>
				      </tr>
				    </thead>';
				    $number = 1;

				 while ($row = mysqli_fetch_assoc($result)) {
				     $output .= "<tbody>
				      <tr>
				        <td>$number</td>
						<td>{$row["id"]}</td>
				        <td>{$row["firstname"]} {$row["lastname"]}</td>
				        
				        <td>{$row["email"]}</td>
				        <td>{$row["mobile"]}</td>
				        <td><button class='btn btn-danger delete_btn' data-id='{$row["id"]}'>Delete</button></td>
				        <td><button type='button' class='btn btn-primary edit_btn' data-eid='{$row["id"]}'>Edit</button></td>
				      </tr>
				    </tbody>";
				    $number++;
				 }
		$output .= '</table>';
		mysqli_close($connect);
		echo $output;
  }

 ?>