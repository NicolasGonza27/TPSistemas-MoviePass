<?php
require_once("header.php");
?>

<!--<div class="mx-auto">
 
        <form class="text-center" action="<?php echo FRONT_ROOT . "Home/Login" ?>" method="post">
            <h1 class="mt-5 text-white">MOVIE-PASS</h1>
                <div class="mt-5 black-bg mx-auto">
                        
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@<?php echo " "; ?></span>
                            </div>
                            <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Username" name="userName" aria-describedby="basic-addon1" required>
                        </div>        

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">🔑</span>
                            </div>
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>                          
                            
                        <button class="btn btn-dark btn-block btn-lg" type="submit">Log in</button>
                </div>
        </form>
</div>-->
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	font-family: 'Varela Round', sans-serif;
}
.modal-login {
	color: #636363;
	width: 350px;
}
.modal-login .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-login .modal-header {
	border-bottom: none;
	position: relative;
	justify-content: center;
}
.modal-login h4 {
	text-align: center;
	font-size: 26px;
}
.modal-login  .form-group {
	position: relative;
}
.modal-login i {
	position: absolute;
	left: 13px;
	top: 11px;
	font-size: 18px;
}
.modal-login .form-control {
	padding-left: 40px;
}
.modal-login .form-control:focus {
	border-color: #00ce81;
}
.modal-login .form-control, .modal-login .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-login .hint-text {
	text-align: center;
	padding-top: 10px;
}
.modal-login .close {
	position: absolute;
	top: -5px;
	right: -5px;
}
.modal-login .btn, .modal-login .btn:active {	
	border: none;
	background: #00ce81 !important;
	line-height: normal;
}
.modal-login .btn:hover, .modal-login .btn:focus {
	background: #00bf78 !important;
}
.modal-login .modal-footer {
	background: #ecf0f1;
	border-color: #dee4e7;
	text-align: center;
	margin: 0 -20px -20px;
	border-radius: 5px;
	font-size: 13px;
	justify-content: center;
}
.modal-login .modal-footer a {
	color: #999;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Member Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="/examples/actions/confirmation.php" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" placeholder="Username" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Password" required="required">					
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
		</div>
    </div>  -->


<body>

    <div class="login-form">
        <h1 class="mt-5 text-white text-center bg-dark">MOVIE-PASS</h1>
        <form action="<?php echo FRONT_ROOT . "Home/Login" ?>" method="post">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <i class="fa fa-user .input-icono"></i>
                <input type="email" class="form-control" name="username" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <i class="fa fa-lock .input-icono"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary login-btn btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                <a href="#" class="float-right">Forgot Password?</a>
            </div>
            <div class="or-seperator"></div>
            <p class="text-center">Login with your social media account</p>
            <div class="text-center social-btn">
                <a href="#" class="btn btn-secondary"><div class="fa fa-facebook"></div>&nbsp; Facebook</a>
                <a href="#" class="btn btn-info"><div class="fa fa-twitter"></div>&nbsp; Twitter</a>
                <a href="#" class="btn btn-danger"><div class="fa fa-google"></div>&nbsp; Google</a>
            </div>
        </form>
    </div>
</body>
<?php
require_once("signUp.php");
require_once("footer.php");
?>