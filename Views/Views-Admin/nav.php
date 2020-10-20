<html>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <a class="navbar-brand" href="#">Movie-Pass</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowDashboardView"?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link "  href= "<?php echo FRONT_ROOT."Home/form"?>"role="button">Filtrar Por</a>
                </li> -->
            </ul>
            <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/Logout"?>"role="button">Cerrar Sesión</a>
            <button type="button" class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
        </div>
    </nav>

    

    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT."Cine/Add"?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo cine</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-3 pr-3">
                        <input type="numbre" name="id" class="hide"/>
                        <div class="row form-group pr-3">
                            <label class="col-6">Nombre:</label>
                            <input type="text" name="nombre" class="col-6" required/>
                        </div>

                        <div class="row form-group pr-3">
                            <label class="col-6">Dirección:</label>
                            <input type="text" name="direccion" class="col-6" required/>
                        </div>

                        <input type="text" name="capacidad" class="hide"/>
                    
                        <div class="row form-group pr-3">
                            <label class="col-6">Hora de Apertura:</label>
                            <input type="time" name="apertura" class="col-6" required/>
                        </div>

                        <div class="row form-group pr-3">
                            <label class="col-6">Hora de Cierre:</label>
                            <input type="time" name="cierre" class="col-6" required/>
                        </div>

                        <div class="row form-group pr-3">
                            <label class="col-6">Valor de Entrada:</label>
                            <input type="number" name="valor_entrada" step="0.50" class="col-6" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>
