<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	
</head>
<body>

	<div class="container">
		<!-- first heading -->
		<div class="header mt-3 d-flex justify-content-between">
			<div class="heading"><h1 class="text-primary">Employee Management</h1></div>
			
			<div class="form-group d-flex align-items-center">
			    <input type="search" class="form-control" placeholder="Search.." id="search">
			</div>
		</div>
		
<!-- open modal btn -->
		<div class="d-flex justify-content-end ">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
			  Registration Form
			</button>
		</div>
		<!-- end open modal btn -->
		<!-- all records part -->
		<div>
			<h2 class="text-gray-dark">All Records</h2>
			<div id="records_content">
				<table id="load_table" class="table table-striped">
				    
				 </table>
			</div>

		</div>
		<!-- end all records part -->
		
		<!-- open modal interface for insert data -->
		<div>
			<!-- The Modal -->
			<div class="modal" id="myModal">
			  <div class="modal-dialog">
			    <div class="modal-content">

			      <!-- Modal Header -->
			      <div class="modal-header">
			        <h4 class="modal-title">Registration Form</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>

			      <!-- Modal body -->
			      <div class="modal-body">
			      	<form id="add_form" action="">
			      	<div class="form-group">
					    <label for="fname">First Name:</label>
					    <input type="text" class="form-control" placeholder="Enter First Name" id="fname" required>
					</div>
					 <div class="form-group">
					    <label for="lname">Last Name:</label>
					    <input type="text" class="form-control" placeholder="Enter Last Name" id="lname" required>
					</div>
					<div class="form-group">
						 <label for="designation">Select Designation</label>
						<br>
						<select class="js-example-basic-single form-control" name="designation" id="mySelect2">
						  <option disabled="true">Select......</option>
						  <option value="1">Assistant General Manager</option>
						  <option value="2">Deputy General Manager</option>
						  <option value="3">Senior Project Manager</option>
						  
						</select>
					</div>
			        <div class="form-group">
					    <label for="email">Email address:</label>
					    <input type="email" class="form-control" placeholder="Enter email" id="email" required>
					</div>
					 <div class="form-group">
					    <label for="mobile">Mobile Number:</label>
					    <input type="text" class="form-control" placeholder="Enter Mobile Number" id="mobile" required>
					</div>
					<div class="form-check">
					  <input class="form-check-input gender" type="radio" name="gender" id="exampleRadios1" value="1" checked>
					  <label class="form-check-label" for="exampleRadios1">
					    Male
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input gender" type="radio" name="gender" id="exampleRadios2" value="0">
					  <label class="form-check-label" for="exampleRadios2">
					    Female
					  </label>
					</div>
					</form>
			      </div>

			      <!-- Modal footer -->
			      <div class="modal-footer">
			        <button type="button" id="save_btn" class="btn btn-primary" data-dismiss="modal">Save</button>
			        <button type="button" id="close_btn"  class="btn btn-danger" data-dismiss="modal">Close</button>
			      </div>

			    </div>
			  </div>
			</div>
		</div>
		<!-- end modal interface for insert data -->
		<!-- show error msg on page -->
		<div id="error_msg"></div>
		<!-- show success msg on page -->
		<div id="success_msg"></div>
		<!-- open the edit form that records i want to update -->
		<div id="edit_modal">
			<div id="edit_modal_form">
				<div class="modal" id="update_modal">
			  	
				</div>
			</div>
		</div>
		<!-- end open the edit form that records i want to update -->
	</div>
	

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script>
		$(document).ready(function(){
			$(".js-example-basic-single").select2({
			  tags: true
			});
			$('#mySelect2').select2({
			  dropdownParent: $('#myModal')
			});
			// load all records
			function loadRecords(){
				$.ajax({
					url: "load_records.php",
					type: "POST",
					success: function(data,status){
						$("#load_table").html(data);
					}
				});
			}
			loadRecords();//load all records on the page

			// insert records
			$("#save_btn").on("click",function(e){

				e.preventDefault();

				var fname = $("#fname").val();
				var lname = $("#lname").val();
				var email = $("#email").val();
				var designation = $("#mySelect2").val();
				var mobile = $("#mobile").val();
				var gender = $("input[name='gender']:checked").val();

				if(fname =="" || lname == "" || email == "" || mobile == "" ||designation == ""||gender == ""){
					$('#error_msg').html("All fields are required.").slideDown();
					$('#success_msg').slideUp();
					setTimeout(function(){
									$('#error_msg').fadeOut("slow");
								},4000);
				}
				else{
						$.ajax({
						url: "insert.php",
						type: "POST",
						data: {
							first_name:fname,
							last_name:lname,
							email:email,
							designation:designation,
							gender:gender,
							mobile:mobile},

						success:function(data){
							if(data){
								loadRecords();
								$('#add_form').trigger("reset");
								$('#success_msg').html("Data Inserted Successfully.").slideDown(2000);
								$('#error_msg').slideUp();
								setTimeout(function(){
									$('#success_msg').fadeOut("slow");
								},4000);
							}
							else{
								$('#error_msg').html("can\'t save record.").slideDown();
								$('#success_msg').slideUp();
								setTimeout(function(){
									$('#error_msg').fadeOut("slow");
								},4000);
							}
						}
					});
				}
				
			});
			//Delete records
			//for create the selector of delete operation it's changes the syntax like

			$(document).on("click",".delete_btn",function(){

				if(confirm("Do you really want to delete this record ?")){
					var student_id = $(this).data("id");
					var element = this;
					$.ajax({
						url: "delete.php",
						type: "POST",
						data: {id: student_id},
						success: function(data){
							if(data == 1){
								$(element).closest("tr").fadeOut();
								$('#success_msg').html("Data Deleted Successfully.").slideDown(1000);
								$('#error_msg').slideUp();
								setTimeout(function(){
									$('#success_msg').fadeOut("slow");
								},4000);
							}
							else{
								$('#error_msg').html("can\'t delete record.").slideDown();
								$('#success_msg').slideUp();
								setTimeout(function(){
									$('#error_msg').fadeOut("slow");
								},4000);
							}
						}
					});
				}
				

			});
			// update records which selector is same as delete operation

			// show update modal box

			$(document).on("click",".edit_btn",function(){

				$("#update_modal").show();
				var s_id = $(this).data("eid");

				$.ajax({
					url: "load_update_data.php",
					type: "POST",
					data: {eid: s_id},
					success: function(data){
						$("#update_modal").html(data);
						// hide update modal box
						$("#update_close_btn").on("click", function(e){
							$("#update_modal").hide();
						});
					}
				});
			});

			
			// $("#update_close_btn").on("click", function(e){
			// 	$("#update_modal").hide();
			// });

			// change and successfully update records in db and table

			$(document).on("click","#update_save_btn",function(){
				// pick records every value from the load update form
				var s_id = $("#update_id").val();
				var f_name = $("#update_fname").val();
				var l_name = $("#update_lname").val();
				var email = $("#update_email").val();
				var mobile = $("#update_mobile").val();

				$.ajax({
					url: "update.php",
					type: "POST",
					data: {
						edit_id: s_id,
						edit_fname: f_name,
						edit_lname: l_name,
						edit_email: email,
						edit_mobile: mobile
					},
					success: function(data){
						// if the query run successfully then data == will be 1
						if(data == 1){
							$("#update_modal").hide();//hide modal box
							loadRecords();//call the loadRecords function for see the proper updated records
							$('#success_msg').html("Data Updated Successfully.").slideDown(1000);
							$('#error_msg').slideUp();
							setTimeout(function(){
									$('#success_msg').fadeOut("slow");
								},4000);
						}
						else{
							$('#error_msg').html("can\'t update record.").slideDown();
							$('#success_msg').slideUp();
							setTimeout(function(){
									$('#error_msg').fadeOut("slow");
								},4000);
						}
					}
				});

			});

			//Live search option

			$("#search").on("keyup", function(){
				var search_term = $(this).val();

				$.ajax({
					url: "search.php",
					type: "POST",
					data: {
						search_term: search_term
					},
					success: function(data){
						$("#load_table").html(data);
					}
				});
			});


		});
	</script>
</body>
</html>