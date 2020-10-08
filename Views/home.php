<?php
    require_once("header.php");
?>
<div class="row">
    <div class="col-sm-12">
        <h1>MOVIE-PASS</h1>
        <form action="<?php echo FRONT_ROOT."Home/Login"?>" method="post">
            <div class="col-6">
                <span class="col-6">Usuario</span>
                <input class="col-6 input-login" type="text" name="userName" placeholder="Nombre Usuario" required>
            </div>
            <div class="col-sm-6">
                <span class="col-6">Contraseña</span>
                <input class="col-6 input-login" type="password" name="password" placeholder="Contraseña" required >
            </div>
            <button class="btn btn-info btn-rounded" type="submit" name="btnLogin">Ingresar</button>
        </form>
    </div>
</div>
<?php
    require_once("Views-Cliente/content-movie.php");
    require_once("footer.php");
?>