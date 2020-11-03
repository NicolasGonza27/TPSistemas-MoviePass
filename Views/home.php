<?php
    require_once("header.php");
    if ($error == 1) {
        echo "<script> if(confirm('Los datos que ingresó no corresponden a nungun usuario registrado.')); </script>";
    }
    elseif ($error == 2) {
        echo'<script type="text/javascript"> alert("El correo electronico no esta disponible"); </script>'; 
    }
?>

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

<script>
    $("input[type=text]").keyup(function(){
        leters = $(this).val().replace(" ", "");
        $(this).val(leters);
    });
</script>
