<?php
include('includes/header.php');
require('includes/register_func.php');
require('includes/login_func.php');
?>
  <div class="container">
    <div class="row">
    <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">LogIn</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>
		<div class="login-form">
			<form method="POST">
				<div class="sign-in-htm">
					<div class="group">
						<label for="email" class="label">E-mail</label>
						<input id="email" name="email_login" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" type="password" name="password_login" class="input" data-type="password">
					</div>
					<br />
					<div class="group">
						<input type="submit" name="login" id="login_button" class="button" value="Login">
					</div>
					<div class="hr"></div>
					<p style="color:red;text-align:center;font-size:20px;" id="fill_out_login" class="help-block text-danger">
						<?php echo in_array('Email or password is incorrect.', $login_errors) ?  'Email or password is incorrect. <br />' : ''; 
						      echo in_array('Please fill out both fields.', $login_errors) ?  'Please fill out both fields. <br />' : '';
							  echo in_array('You need to verify your account first.', $login_errors) ?  'You need to verify your account first. <br />' : ''; ?>
					</p>
				</div>
			</form>
			<form method="POST" id="reg_form" >
				<div class="sign-up-htm">
					<div class="group">
						<label for="user" class="label">Name</label>
						<input id="user" name="user_name" type="text" class="input">
					</div>
					<div class="group">
						<label for="email" class="label">Email Address</label>
						<input id="email" name="email" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" name="password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="pass" name="confirm_password" type="password" class="input" data-type="password">
					</div><br />
					<div class="group">
						<button type="submit" class="button" name="register" id="reg_button">Register</button>
					</div>
					<p style="color:red;text-align:center;font-size:20px;" id="fill_out" class="help-block text-danger"><?php echo in_array('Please fill out all fields.', $reg_errors) ? "Please fill out all fields. <br />" : '';
						echo in_array('Please enter valid name.', $reg_errors) ? "Please enter valid name. <br />" : '';  
						echo in_array('Enter valid e-mail address.', $reg_errors) ? "Enter valid e-mail address. <br />" : '';
						echo in_array('E-mail already exists.', $reg_errors) ? "E-mail already exists. <br />" : ''; 
						echo in_array('Password need to have at least 8 characters.', $reg_errors) ? "Password need to have at least 8 characters. <br />" : ''; 
						echo in_array('Passwords needs to match.', $reg_errors) ? "Passwords needs to match. <br />" : ''; 
						?></p>
					<p style="color:green;text-align:center;font-size:20px;" id="success_reg" class="help-block text-danger"><?php echo $success_msg != '' ? $success_msg : ''  ?></p>
					<div class="hr" id="reg_hr"></div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div> 
	<script src="assets/js/modernizr-latest.js"></script> 
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='assets/js/camera.min.js'></script> 
    <script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/custom.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type='application/javascript' src='js/main.js'></script>
    

<?php include('includes/footer.php'); ?>