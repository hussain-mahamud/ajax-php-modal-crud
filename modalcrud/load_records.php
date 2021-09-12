<?php 

  include('config/db.php');

  $query = "SELECT * FROM registration_form";
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
				        <th>Action</th>
				        
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
				        <td><button class='btn btn-danger delete_btn' data-id='{$row["id"]}'>Delete</button>
				        <button type='button' class='btn btn-primary edit_btn' data-eid='{$row["id"]}'>Edit</button></td>
				      </tr>
				    </tbody>";
				    $number++;
				 }
		$output .= '</table>';
		mysqli_close($connect);
		echo $output;
  }

 ?>