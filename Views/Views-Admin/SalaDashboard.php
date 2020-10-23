<?php
    require_once(VIEWS_PATH."header.php");
    require_once("nav.php");
?>

<div class="container espaciado-sup">
    <div class="content">
        <h3 class="text-white mt-3 mb-3">
            Listado de Salas del Cine <?php echo $cine->getNombre()?>
            <button type="button" class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
        </h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Numero</th>
                    <th>Nombre</th>
                    <th class="text-center">Cantidad de Butacas</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach($listaSala as $sala) { ?>
                    <tr>
                        <td><?php echo $sala->getNumero_sala()?></td>
                        <td><?php echo $sala->getNombre_sala()?></td>
                        <td><?php echo $sala->getCant_butacas()?></td>
                        <form action="<?php echo FRONT_ROOT."Sala/Remove"?>" method="post">
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$sala->getId_sala()?>">Editar</button>
                                <input type="numbre" name="id" class="hide" value="<?php echo $sala->getId_sala()?>"/>
                                <input type="numbre" name="id_cine" class="hide" value="<?php echo $sala->getId_cine()?>"/>
                                <button type="submit" class="btn btn-outline-danger">Borrar</button>
                            </td>
                        </form> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach($listaSala as $sala) { ?>
<!-- This is the modal -->
<div class="modal fade" id="<?php echo "modal".$sala->getId_sala()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT."Sala/ModifyModal"?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Sala <?php echo $sala->getNombre_sala()?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <input type="numbre" name="id_sala" class="hide" value="<?php echo $sala->getId_sala()?>"/>
                    <input type="numbre" name="id_cine" class="hide" value="<?php echo $sala->getId_cine()?>"/>
                    <div class="row form-group pr-3">
                        <label class="col-6">Numero:</label>
                        <input type="number" name="numero_sala" class="col-6" value="<?php echo $sala->getNumero_sala()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Nombre:</label>
                        <input type="text" name="nombre_sala" class="col-6" value="<?php echo $sala->getNombre_sala()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Cantidad de butacas:</label>
                        <input type="number" name="cant_butacas" class="col-6" value="<?php echo $sala->getCant_butacas()?>" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal del boton Agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT."Sala/Add"?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar una nueva sala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <input type="numbre" name="id_sala" class="hide"/>
                    <input type="numbre" name="id_cine" value="<?php echo $cine->getId()?>" class="hide"/>
                    <div class="row form-group pr-3">
                        <label class="col-6">Numero:</label>
                        <input type="number" name="numero_sala" class="col-6" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Nombre:</label>
                        <input type="text" name="nombre_sala" class="col-6" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Cantidad de butacas:</label>
                        <input type="number" name="cant_butacas" class="col-6" required/>
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

<?php
    require_once("Views/footer.php");
?>