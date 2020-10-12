<div class="container mt-3" style="text-align: center">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
    <span class = "text-wight">¿Todavia no te registraste?</span>
  </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo FRONT_ROOT."Usuario/AddNuevoUsuario"?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Creando Cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row form-group pr-3">
            <label class="col-6">Nombre Completo</label>
            <input type="text" name="nombreYApellido" class="col-6" required/>
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
            <input type="text" name="fecha_nac" class="col-6" required/>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Inscribirse</button>
        </div>
      </form>  
    </div>
  </div>
</div>
