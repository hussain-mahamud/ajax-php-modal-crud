<?php 


  $hostname = "localhost";
  $username = "root";
  $password = "";
  $databaseName = "ajax";

  // connect to mysql database using mysqli
  $connect = mysqli_connect($hostname, $username, $password, $databaseName) or die("Connection failed." . mysqli_connect_error());

 $id = $_POST['eid'];
 

  $query = "SELECT * FROM registration_form WHERE id = {$id}";
  $result = mysqli_query($connect, $query) or die("Query unsuccessful.");
  $output = "";
  if(mysqli_num_rows($result) > 0 ){
  	while ($row = mysqli_fetch_assoc($result)) {
  	    $output = "
					
					<div class='modal-dialog'>
			    	<div class='modal-content'>
			    	<!-- Modal Header -->
				      <div class='modal-header'>
				        <h4 class='modal-title'>Update Your Information</h4>
				        <button type='button' id='update_close_btn'  class='close' data-dismiss='modal'>&times;</button>
				      </div>

			      

			      <!-- Modal body -->
			      <div class='modal-body'>
			      	<form id='update_form'>
			      	<div class='form-group'>
					    <label for='update_fname'>First Name:</label>
					    <input type='text' class='form-control' placeholder='Enter First Name' id='update_fname' required value='{$row['firstname']}'>
					    <input type='text' class='form-control' placeholder='Enter First Name' id='update_id' required hidden value='{$row['id']}'>
					</div>
					 <div class='form-group'>
					    <label for='update_lname'>Last Name:</label>
					    <input type='text' class='form-control' placeholder='Enter Last Name' id='update_lname' required value='{$row['lastname']}'>
					</div>
					<div class='form-group'>
						 <label for='designation'>Select Designation</label>
						<br>
						<select class='js-example-basic-single form-control' name='designation' id='mySelect2'>";
					if($row['designation']==1){
						$output .="echo '<option value='1' selected='selected'>Assistant General Manager</option>';
							echo '<option value='2'>Deputy General Manager</option>';
							echo '<option value='3'>Senior Project Manager</option>'";
					}
					else if($row['designation']==2){
						$output .="echo '<option value='2' selected='selected'>Deputy General Manager</option>';
							echo '<option value='1'>Assistant General Manager</option>';
							echo '<option value='3'>Senior Project Manager</option>'";
					}
					else if($row['designation']==3){
						$output .="echo '<option value='3' selected='selected'>Senior Project Manager</option>';
						echo '<option value='1'>Assistant General Manager</option>';
						echo '<option value='2'>Deputy General Manager</option>';";
					}
					$output .="</select>
					</div>";
					
			       $output .="<div class='form-group'>
					    <label for='update_email'>Email address:</label>
					    <input type='email' class='form-control' placeholder='Enter email' id='update_email' required value='{$row['email']}'>
					</div>
					 <div class='form-group'>
					    <label for='update_mobile'>Mobile Number:</label>
					    <input type='text' class='form-control' placeholder='Enter Mobile Number' id='update_mobile' required value='{$row['mobile']}'>
					</div>
					</form>
			      </div>";

			      if($row['gender']==1){
			      	$output .="<div class='form-check' style='margin-left:20px;'>
			        <input class='form-check-input gender' type='radio' name='gender' id='exampleRadios1' value='1' checked>
			        <label class='form-check-label' for='exampleRadios1'>
			          Male
			        </label>
			      </div>
			      <div class='form-check' style='margin-left:20px;'>
			        <input class='form-check-input gender' type='radio' name='gender' id='exampleRadios2' value='0'>
			        <label class='form-check-label' for='exampleRadios2'>
			          Female
			        </label>
			      </div>";
			      }
			      if($row['gender']==0){
			      		$output .="<div class='form-check'>
			      	  <input class='form-check-input gender' type='radio' name='gender' id='exampleRadios2' value='0' checked>
			      	  <label class='form-check-label' for='exampleRadios2'>
			      	    Female
			      	  </label>
			      	</div>
			      	<div class='form-check'>
			      	  <input class='form-check-input gender' type='radio' name='gender' id='exampleRadios1' value='1'>
			      	  <label class='form-check-label' for='exampleRadios1'>
			      	    Male
			      	  </label>
			      	</div>
			      	";
			      }
			     $output .="<!-- Modal footer -->
			      <div class='modal-footer'>
			        <button type='button' id='update_save_btn' class='btn btn-primary' data-dismiss='modal'>Save</button>
			      </div>

			    </div>
			  </div>
  	    		";
  	}
  	mysqli_close($connect);
  	echo $output;
  }


  ?>