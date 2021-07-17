<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Maintenance</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="">Admin</a></li>
						<li class="breadcrumb-item active">Maintenance</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-md-12 col-sm-6">
					<div class="m-auto">
						<div class="row my-5">
							<div class="col">
								<div class="wy-text-right text-right">
									<button class="btn btn-primary float-right mr-5" id="create-account-btn"><i class="fas fa-plus"></i> Create Account</button>
									<button class="btn btn-success float-right mr-2" id="import-account-btn"><i class="fas fa-upload"></i> Import Accounts</button>
								</div>
							</div>
						</div>
						<table class="table  wy-table-striped" id="user_list_table">
							<thead>
								<th>#</th>
								<th>Email</th>
								<th>Name</th>
								<th>Account Type</th>
								<th>Option</th>
							</thead>
							<tbody id="user_list_body">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>


<!-- Modal Add User -->
<div class="modal fade" id="create-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form id="form-add-user">

					<div class="row justify-content-md-center">
						<div class="col-md-6">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Employee ID</div>
								</div>
								<input type="text" name="user_id" class="form-control" id="user_id" value="" style="display: block">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Account Type</div>
								</div>
								<select name="account_type" class="form-control" id="account_type" value="">
									<option value="null"> </option>
									<option value="1"> Admin </option>
									<option value="2"> Manager </option>
									<option value="3"> Technician </option>
									<option value="4"> Employee </option>
								</select>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">First Name</div>
								</div>
								<input type="text" name="first_name" class="form-control" id="first_name" value="">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Middle Name</div>
								</div>
								<input type="text" name="middle_name" class="form-control" id="middle_name" value="">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Last Name</div>
								</div>
								<input type="text" name="last_name" class="form-control" id="last_name" value="">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Contanct #</div>
								</div>
								<input type="number" name="contact" class="form-control" id="contact" value="">
							</div>

						</div>
						<div class="col-md-6">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">City</div>
								</div>
								<input type="text" name="city" class="form-control" id="city" value="">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Province</div>
								</div>
								<input type="text" name="province" class="form-control" id="province" value="">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Country</div>
								</div>
								<input type="text" name="country" class="form-control" id="country" value="Philippines">
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text"> Civil Status</div>
								</div>
								<select name="status" class="form-control" id="status" value="">
									<option></option>
									<option>Single</option>
									<option>Married</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row justify-content-md-center">
						<div class="col-md-6">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Email</div>
								</div>
								<input type="text" name="email" class="form-control" id="email" value="">
							</div>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Password</div>
								</div>
								<input type="password" name="password" class="form-control" id="password" value="">
								<div class="input-group-prepend" id="show-password" style="cursor: pointer">
									<div class="input-group-text" ><i class="fas fa-eye"></i></div>
								</div>
							</div>
						</div>
					</div>
					<input type="button" class="btn btn-success float-right" id="add-user" value="Add User">
					<input type="button" class="btn btn-success float-right" id="update-user" value="Update User" style="display: none">
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>


<!-- Modal Upload Excel -->
<div class="modal fade" id="upload-account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="upload-modal-title">Upload Account Data (xlxs)</h5><br>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="file" name="upload_file" id="upload_file" class="form-control">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" id="doUploadBtn">Upload</button>
			</div>
		</div>
	</div>
</div>

<!-- DataTables  & Plugins -->
<link rel="stylesheet" href="<?=base_url()?>vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>vendor/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
	$(function(){
		getUserList();


		$('#user_list_table').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"responsive": false,
			"order": [[ 0, "desc" ]],
			"destroy": true
		});


		$('#create-account-btn').on('click', function(){
			$('#create-account-modal').modal('show');
			$('#modal-title').html('<strong>Create Account</strong>');
			$('#update-user').val('Update Account').css('display','none');
			$('#add-user').val('Add Account').css('display','block');
			$('#first_name').val('');
			$('#last_name').val('');
			$('#middle_name').val('');
			$('#email').val('');
			$('#password').val('');
			$('#city').val('');
			$('#province').val('');
			$('#country').val('');
			$('#contact').val('');
			$('#status').val('');
			$('#account_type').val('');
		});

		$('#create-account-modal #add-user').on('click', function(e){
			e.preventDefault();


			if($('#email').val()==='' ){
				toastr['warning']('Email required');
				return false;
			}else if($('#password').val()===''){
				toastr['warning']('Password required');
				return false;
			}else if($('#account_type :selected').text()===''){
				toastr['warning']('Account type required');
				return false;
			}
			// else if($('#first_name').val()===''){
			// 	toastr['warning']('First Name type required');
			// 	return false;
			// }else if($('#last_name').val()===''){
			// 	toastr['warning']('Last Name type required');
			// 	return false;
			// }

			formData = new FormData(document.getElementById('form-add-user'));

			Swal.fire({
				title: 'Continue to save',
				text: "You won't be able to revert this!",
				icon: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'continue'
			}).then((result) => {
				if (result.isConfirmed) {
					swal.showLoading();

					$.ajax({
						url: '<?=base_url()?>admin/users/addUser',
						data: formData,
						processData: false,
						contentType: false,
						dataType: "json",
						type: 'POST',
						success: function ( data ) {

							console.log(data);
							if(data==='success'){
								Swal.fire(
									'Saved!',
									'Your file has been saved.',
									'success'
								);
								getUserList();
							}else if(data==='duplicate'){
									Swal.fire(
										'Duplicate Entry',
										'Email is already taken!',
										'error'
									);
								}else{
									Swal.fire(
										'Error',
										'Something went wrong!',
										'error'
									);
							}
						}
					});

					swal.close();

				}
			})
		})

		$('#user_list_table').on('click', '#edit-user-btn', function(e){
			e.preventDefault();
			var user_id = $(this).attr("data-user_id");
			$('#modal-title').html('<strong>Manage Account</strong>');
			$('#user_id').val(user_id);
			$('#password').attr('type', 'password');
			getUser(user_id);
		})

		$('#user_list_table').on('click', '#delete-user-btn', function(e){
			e.preventDefault();
			var user_id = $(this).attr("data-user_id");

			Swal.fire({
				title: 'Are you sure',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Delete it'
			}).then((result) => {
				if (result.isConfirmed) {
						$.post('<?=base_url()?>admin/users/addToDeletedUsers',
								{
									'user_id':user_id
								}
								, function(response){
							if(response==='success'){
								Swal.fire(
										'Success!',
										'Account removed successfully.',
										'success'
								);
								getUserList();
							}else if(response==='exist'){
								Swal.fire(
										'Warning!',
										'Account already removed, please reload!',
										'error'
								);
								getUserList();
							} else{
								toastr['error']('Something went wrong, please contact administrator');
							}

						},'json')
				}
			});


		});

		$('#update-user').on('click', function(e) {
			e.preventDefault();

			if($('#email').val()==='' ) {
				toastr['warning']('Email required');
				return false;
			} else if($('#account_type :selected').text()===''){
				toastr['warning']('Account type required');
				return false;
			}
			// else if($('#first_name').val()===''){
			// 	toastr['warning']('Account type required');
			// 	return false;
			// }else if($('#last_name').val()===''){
			// 	toastr['warning']('Account type required');
			// 	return false;
			// }

			if(!check_valid_email($('#email').val())){
				return false;
			}

			formData = new FormData(document.getElementById('form-add-user'));
			$.ajax({
				url: '<?=base_url()?>admin/users/updateUserData',
				data: formData,
				processData: false,
				contentType: false,
				dataType: "json",
				type: 'POST',
				success: function (data) {
					// console.log(data);
					if(data==='success'){
						Swal.fire(
								'Data Saved!',
								'Account has been updated.',
								'success'
						);
						getUserList();
					}else if(data==='duplicate'){
						Swal.fire(
								'Error',
								'Email already in use',
								'error'
						);
						getUserList();
					} else{
						Swal.fire(
								'Error',
								'No changes made',
								'error'
						);
					}
					getUserList();
				}, error: function(){
					Swal.fire(
							'Warning',
							'No changes made',
							'warning'
					);
				}
			});
			getUserList();
		})

		$('#create-account-modal #show-password').on('click', function(){
			// alert();
			if($('#password').attr('type')==='password'){
				$('#password').attr('type', 'text');
			}else{
				$('#password').attr('type', 'password');
			}

		})
	})

	function getUserList(){
		$.post('<?=base_url()?>admin/users/getUserList',
			function(){

			}).done(function(response){

			response = JSON.parse(response);
				$('#user_list_body').html('');

			if ($.fn.DataTable.isDataTable('#user_list_table'))
			{
				$('#user_list_table').dataTable().fnClearTable();
				$('#user_list_table').dataTable().fnDestroy();
			}


			$.each(response, function (i, data){
				// console.log(data);
				// console.log(data);
				var deleteBtn = '<a href="" class="btn btn-danger btn-sm mx-1" id="delete-user-btn" data-user_id="'+data.id+'">Remove</a>';
				var editBtn = '<a href="" class="btn btn-primary btn-sm mx-1" id="edit-user-btn" data-user_id="'+data.id+'">Manage</a>';

				$('#user_list_body').append('' +
					'<tr>' +
					'<td>'+(i+1)+'</td>' +
					'<td>'+data.email+'</td>' +
					'<td>'+data.first_name+data.last_name+'</td>' +
					'<td>'+data.user_account_type+'</td>' +
					'<td>'+editBtn+deleteBtn+'</td>' +

					'</tr>')
			})
			$('#user_list_table').DataTable({
				"paging": true,
				"lengthChange": true,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": true,
				"responsive": false,
				"order": [[ 0, "desc" ]],
				"destroy": true
			});

		})

	}

	function getUser(user_id){
		$.post('<?=base_url()?>admin/users/getUserById',
			{
				'id':user_id
			}, function(result){

		}).done(function(data){
			data = JSON.parse(data);

		 		// console.log(data)
			$('#first_name').val(data.first_name);
			$('#last_name').val(data.last_name);
			$('#middle_name').val(data.middle_name);
			$('#email').val(data.email);
			$('#password').val('');
			$('#city').val(data.city);
			$('#province').val(data.province);
			$('#country').val(data.country);
			$('#contact').val(data.contact_number);
			$('#status').val(data.status);
			$('#account_type').val(data.account_type);
			$('#update-user').val('Update Account').css('display','block');
			$('#add-user').val('Update Account').css('display','none');

		})

		$('#create-account-modal').modal('show');
		// $('#create-account-modal #first_name').val('')
	}

	function check_valid_email(email){
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(!emailReg.test(email)){
			toastr['error']('Email address not supported');
			return false
		}else{
			return true;
		}
	}


	$(function(){
		$('#import-account-btn').on('click', function(){
			$('#upload-account-modal').modal('show');
		})

		$('#doUploadBtn').on('click', function(){
			let formData = new FormData();
			formData.append('file', $('#upload_file')[0].files[0]);
			$.ajax({
				url: "<?=base_url('admin/users/importUsers')?>",
				type: "POST",
				data:  formData,
				contentType: false,
				cache: false,
				processData:false,
				dataType: "json",
				success: function(data){
					console.log(data);
					if(data.status==='success'){
						Swal.fire(
								'Success!',
								'<p class="text-primary">'+data.message+'<br><i class="text-danger">duplicate rows:</i>'+data.duplicateRows+'</p>',
								'success'
						);
						getUserList();
					}else if(data.status==='failed'){
						Swal.fire(
								'Warning!',
								'<p class="text-primary">'+data.message+'<br><i class="text-danger">duplicate rows:</i>'+data.duplicateRows+'</p>',
								'warning'
						);
						getUserList();
					}else{
						Swal.fire(
								'Error!',
								'<p class="text-primary">'+data.message+'<br><i class="text-danger">duplicate rows:</i>'+data.duplicateRows+'</p>',
								'error'
						);
					}
				}
			});
		})
	})

</script>
