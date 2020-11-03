<div class="container mt-3" style="text-align: center">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
    <span class="text-wight">Don't have an account? Sign up here!</span>
  </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <!--<div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php //echo FRONT_ROOT."Usuario/AddNuevoUsuario"
                    ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Creando Cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">-->

  <!--<div class="row form-group pr-3">
            <label class="col-6">Nombre</label>
            <input type="text" name="nombre" class="col-6" required/>
          </div>

          <div class="row form-group pr-3">
            <label class="col-6">Apellido</label>
            <input type="text" name="apellido" class="col-6" required/>
          </div>

          <div class="row form-group pr-3">
            <label class="col-6">Dni</label>
            <input type="text" name="dni" class="col-6" required/>
          </div>
          
          <div class="row form-group pr-3">
            <label class="col-6">Email</label>
            <input type="email" name="email" class="col-6" required/>
          </div>
          
          <div class="row form-group pr-3">
            <label class="col-6">Password</label>
            <input type="password" name="password" class="col-6" required/>
          </div>
          
          <div class="row form-group pr-3">
            <label class="col-6">Fecha de Nacimiento </label>
            <input type="date" id="fecha_nac" name="fecha_nac" min="1910-01-01" max="<?php echo date("Y") . '-' . date("m") . '-' . (date("d") - 1); ?>" class="col-6" required/>
          </div>

        </div>-->

  <div class="signup-form">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo FRONT_ROOT . "Usuario/AddNuevoUsuario" ?>" method="post">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h2>Sign Up</h2>
          <p>Please fill in this form to create an account!</p>
          <hr>
          <div class="form-group">
            <div class="row">
              <div class="col"><input type="text" class="form-control" name="nombre" placeholder="First Name" required="required"></div>
              <div class="col"><input type="text" class="form-control" name="apellido" placeholder="Last Name" required="required"></div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="dni" placeholder="DNI" required="required">
          </div>
          <div class="form-group">
            <label id="fecha_nac" style="color: #737373;">Birthday</label>
            <input class="form-control" type="date" id="fecha_nac" name="fecha_nac" min="1910-01-01" max="<?php echo date("Y") . '-' . date("m") . '-' . (date("d") - 1); ?>" class="col-6" required />
          </div>

          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          </div>


          <div class="form-group">
            <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!--<div class="modal-footer">
        <button class="btn btn-secondary " data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Registrarme</button>
        </div>
      </form>  
    </div>
  </div>-->
</div>