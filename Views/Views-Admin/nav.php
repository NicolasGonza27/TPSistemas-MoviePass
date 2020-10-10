<html>
    <div class="container content">
        <div class="col-12">
            <div class="text-right">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo FRONT_ROOT."Cine/Add"?>" method="post">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Cine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="numbre" name="id" class="hide" value=""/>
                        <div class="">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="" value=""/>
                        </div>

                        <div class="">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="" value=""/>
                        </div>

                        <div class="">
                            <label>Capacidad</label>
                            <input type="text" name="capacidad" class="" value=""/>
                        </div>

                        <div class="">
                            <label>Fecha de Apertura</label>
                            <input type="number" name="apertura" class="" value=""/>
                        </div>

                        <div class="">
                            <label>Fecha de Cierre</label>
                            <input type="number" name="cuerre" class="" value=""/>
                        </div>

                        <div class="">
                            <label>Valor de Entrada</label>
                            <input type="numbre" name="valor_entrada" class="" value=""/>
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
