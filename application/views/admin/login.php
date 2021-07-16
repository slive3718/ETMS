<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="text-center">
	<form class="form-signin">

		<div class="container" style="margin-top: 10%; max-width: 500px">
			<form>
				<div class="jumbotron">
					<h1 class="text-center text-dark">Admin Login</h1>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control" id="email" aria-describedby="emailHelp">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="password">
				</div>
				<div class="form-group form-check">
<!--					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1" id="accetpTerms">Accept Terms and Services</label>-->
				</div>
				<button type="submit" class="btn btn-primary" id="loginBtn">Submit</button>
			</form>
		</div>
	</form>
</body>
<script>
	$('#loginBtn').on('click', function(e){
		e.preventDefault();
		let email = $('#email').val();
		let password = $('#password').val();
			if($('#email').val() !== '' && $('#password').val()!==''){


				$.post("<?=base_url()?>admin/login/validate/",
						{
							'email':email,
							'password':password
						},
						function(response){
					if(response==='success'){
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Login Success',
								showConfirmButton: false,
								timer:1500
							});
						window.setTimeout(function(){
							window.location.href= '<?=base_url()?>admin/home';
						} ,1000);


					}else{
						Swal.fire({
							position: 'center',
							icon: 'error',
							title: 'Invalid Email or Password',
							showConfirmButton: true,
							timer: 1500
						});
					}
						}, 'json')
			}else{
				toastr['error']('Email and Password required!')
			}

	})
</script>
