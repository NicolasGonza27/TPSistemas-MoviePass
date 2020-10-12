<?php
    require_once("header.php");
?>
<form class="container text-center" action="<?php echo FRONT_ROOT."Home/Login"?>" method="post">
    <h1 class="mt-5 text-white">MOVIE-PASS</h1>
    <div class="mt-5">
        <small class="text-white">INICIAR SESIÓN:</small>
        <div class="row">
            <div class="col-6 mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Correo</span>
                    </div>
                    <input type="text" class="userName form-control"  name="userName" required>
                </div>
            </div>
            <div class="col-6 mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contraseña</span>
                    </div>
                    <input type="password" class="userName form-control" name="password" required>
                </div>
            </div>
            <div class="container" style="text-align: center">
                <button class="btn btn-info btn-rounded" type="submit">Ingresar</button>
            </div>
        </div>
    </div>
</form>
<?php
    require_once("signUp.php");
    require_once("footer.php");
?>