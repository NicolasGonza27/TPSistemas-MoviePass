<?php
    require_once(VIEWS_PATH."header.php");
    require_once("nav.php");
?>

<div class="container espaciado-sup">
    <div class="content">
       
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="h3" colspan="6">Listado de cines</th>
                    <th class="text-center" colspan="1"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregar">Agregar</button></th>
                </tr>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Calle</th>
                    <th class="text-center">Numero</th>
                    <th class="text-center">Horario Apertura</th>
                    <th class="text-center">Horario Cierre</th>
                    <th class="text-center">Valor Entrada</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if($listaCine){ foreach($listaCine as $cine) { ?>
                    <tr>
                        <td class="text-center"><?php echo $cine->getNombre()?></td>
                        <td class="text-center"><?php echo $cine->getCalle()?></td>
                        <td class="text-center"><?php echo $cine->getNumero()?></td>
                        <td class="text-center"><?php $ape = explode(":", $cine->getHor_apertura()); echo $ape[0].":".$ape[1]; ?> </td>
                        <td class="text-center"><?php $close = explode(":", $cine->getHor_cierre()); echo $close[0].":".$close[1];?> </td>
                        <td class="text-center"><?php echo $cine->getValor_entrada()?></td>
                        <form action="<?php echo FRONT_ROOT."Cine/Remove"?>" method="post">
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$cine->getId()?>">Editar</button>
                                <button type="submit" class="btn btn-outline-danger" name="id" value="<?php echo $cine->getId()?>">Borrar</button>
                                <a href="<?php echo FRONT_ROOT."Sala/ShowSalaDashboardView/".$cine->getId()?>">
                                    <button type="button" class="btn btn-outline-dark">Salas</button>
                                </a>
                            </td>
                        </form> 
                    </tr>
                <?php } } else { ?>
                    <td colspan = 7 class="text-center"> <strong>NO TIENE CINES EN EL REGISTRO</strong></td>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
foreach($listaCine as $cine) { ?>
<!-- This is the modal -->
<div class="modal fade" id="<?php echo "modal".$cine->getId()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT."Cine/ModifyModal"?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edición de Cine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <input type="numbre" name="id" class="hide" value="<?php echo $cine->getId()?>"/>
                    <div class="row form-group pr-3">
                        <label class="col-6">Nombre:</label>
                        <input type="text" name="nombre" class="col-6" value="<?php echo $cine->getNombre()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Calle:</label>
                        <input type="text" name="calle" class="col-6" value="<?php echo $cine->getCalle()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Numero:</label>
                        <input type="number" name="numero" min="1" class="col-6" value="<?php echo $cine->getNumero()?>" required/>
                    </div>

                    <input type="text" name="capacidad" class="hide" value="<?php echo $cine->getCapacidad()?>"/>
                    
                    <div class="row form-group pr-3">
                        <label class="col-6">Hora de Apertura:</label>
                        <input type="time" name="apertura" class="col-6" value="<?php echo $cine->getHor_apertura()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Hora de Cierre:</label>
                        <input type="time" name="cierre" class="col-6" value="<?php echo $cine->getHor_cierre()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Valor de Entrada:</label>
                        <input type="number" name="valor_entrada" min="1" class="col-6" step="0.50" value="<?php echo $cine->getValor_entrada()?>" required/>
                    </div>

                    <div class="row pr-3">
                        <label class="col-12">Capacidad: <?php echo $cine->getCapacidad()?> personas.</label>
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
            <form action="<?php echo FRONT_ROOT."Cine/Add"?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo cine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <div class="row form-group pr-3">
                        <label class="col-6">Nombre:</label>
                        <input type="text" name="nombre" class="col-6" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Calle:</label>
                        <input type="text" name="calle" class="col-6" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Numero:</label>
                        <input type="number" name="numero" min="1" class="col-6" required/>
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
                        <input type="number" name="valor_entrada" min="1" step="0.50" class="col-6" required/>
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

<script>
    $("input[type=text]").keyup(function(){
        leters = $(this).val().replace("  ", "");
        $(this).val(leters);
    });
</script>