<div class="container mt-3" style="text-align: center">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
    <span class="text-wight">Don't have an account? Sign up here!</span>
  </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="number" class="form-control" name="dni" placeholder="DNI" required="required">
          </div>
          
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
          </div>

          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          </div>

          <div class="form-group">
            <label id="fecha_nac" style="color: #737373;">Birthday</label>
            <input class="form-control" type="date" id="fecha_nac" name="fecha_nac" min="1910-01-01" max="<?php echo date("Y") . '-' . date("m") . '-' . (date("d") - 1); ?>" class="col-6" required />
          </div>

          <!--<div class="form-group">
            <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
          </div>-->
          
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
          </div>
        
        </form>

      </div>
    </div>
  </div>

</div>
