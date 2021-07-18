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
							<?= print_r($this->session->userdata);?>
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
										<button class="btn btn-primary float-right mr-5" id="create-task-btn"><i class="fas fa-plus"></i> Create Task</button>
									</div>
								</div>
							</div>
							<table class="table  table-striped" id="employee-task-table">
								<thead>
								<th>#</th>
								<th>Task Name</th>
								<th>Date Created</th>
								<th>Deadline</th>
								<th>Option</th>
								</thead>
								<tbody id="employee-task-body">

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


<!-- Create Task Modal -->
<div class="modal fade" id="create-task-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formTask">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">Task Name</div>
						</div>
						<input type="text" name="task_name" class="form-control" id="task_name" value="">
					</div>
					<div class="form-group mb-2">
							<div class="form-control text-center">Task Description</div>
						<textarea type="text" name="task_description" class="form-control" id="task_description" rows="5" value=""></textarea>
					</div>
					<div class="form-group">
						<input type="file" name="upload_file" id="task_file" class="form-control">
					</div>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">Deadline</div>
						</div>
						<input type="datetime-local" name="task_deadline" class="form-control" id="task_deadline" value="">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="saveTaskBtn">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script>

	$(function(){


		loadTaskList();


		$('#create-task-btn').on('click', function(){
			$('#create-task-modal').modal('show');
		})

		$('#saveTaskBtn').on('click', function(){
			var formData;
			formData = new FormData(document.getElementById('formTask'));

			$.ajax({
				url: '<?=base_url()?>manager/users/addEmployeeTask',
				data: formData,
				processData: false,
				contentType: false,
				dataType: "json",
				type: 'POST',
				success: function (data) {
					console.log(data);
				}
			});

		})
	})

	function loadTaskList(){
		$.post('<?=base_url()?>manager/users/viewTaskList', function(){

		}).done(function(data){
			data = JSON.parse(data);
				$('#employee-task-body').html('');
			$.each(data, function(i, value){

				var manageBtn =
				console.log(value);
				$('#employee-task-body').append('' +
					'<tr>' +
					'<td>'+(i+1)+'</td>' +
					'<td>'+value.name+'</td>' +
					'<td>'+value.description+'</td>' +
					'<td>'+value.date_time+'</td>' +
					'<td>'+value.deadline+'</td>' +
					'</tr>')
			})
		})
	}

</script>
