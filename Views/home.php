<?php
    require_once("header.php");
?>
<form class="container" action="<?php echo FRONT_ROOT."Home/Login"?>" method="post">
    <h1 style="text-align: center">MOVIE-PASS</h1>
    <small class="text-uppercase">Iniciar Sesión:</small>
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
</form>



<?php
    require_once("signUp.php");
?>
  


<?php
    require_once("footer.php");
?>