<div class="container" style="text-align: center">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><p class = "text-wight">¿Todavia no te registraste?</p>
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
    </svg> 
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
        
          <div class="uk-margin">
              <label for="" class="col-form-label">Nombre Completo</label>
              <input type="text" name="nombreYApellido" class="" required/>
          </div>

          <div class="uk-margin">
              <label for="" class="col-form-label">Dni</label>
              <input type="text" name="dni" class="uk-input" required/>
          </div>

          <div class="uk-margin">
              <label for="" class="col-form-label">Email</label>
              <input type="email" name="email" class="uk-input" required/>
          </div>

          <div class="uk-margin">
              <label for="" class="col-form-label">Password</label>
              <input type="password" name="password" class="uk-input" required/>
          </div>

          <div class="uk-margin">
              <label for="" class="col-form-label">Fecha de Nacimiento </label>
              <input type="text" name="fecha_nac" class="uk-input" required/>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>  
    </div>
  </div>
</div>
