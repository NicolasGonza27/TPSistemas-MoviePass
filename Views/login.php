<?php
require_once("header.php");
require_once(VIEWS_PATH . "nav-not-login.php");

if(isset($_SESSION["error"])) 
{   
    $error = $_SESSION["error"];

    if ($error == 1) {
        echo "<script> if(confirm('The data you have enter does not exist, try again or create another user.')); </script>";
        $_SESSION["error"] = 0;
    }
    elseif ($error == 2) {
        echo'<script type="text/javascript"> alert("The email is not available"); </script>';
        $_SESSION["error"] = 0; 
    }   
}

require_once(ROOT.'FacebookLogin.php');

?>
<div class="container content espaciado-sup">

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
                </div>
                <div class="or-seperator"></div>
                <p class="text-center">Login with your social media account</p>
                <div class="text-center social-btn">

                    <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn btn-primary btn-block"
                    ><div class="fa fa-facebook"></div>&nbsp; Log in with Facebook</a>
                </div>

                </div>
            </form>
        </div>
    </body>
</div>
<?php
require_once("signUp.php");
require_once("footer.php");
?>

<script>
    $("input[type=text]").keyup(function() {
        leters = $(this).val().replace(" ", "");
        $(this).val(leters);
    });
</script>