<?php
    require_once(VIEWS_PATH."header.php");
    require_once("nav.php");
?>

<div class="container espaciado-sup">   
    <div class="container content espaciado-sup">
    <div class="text-left mb-2">
        <a class="boton-atras" href="<?php echo FRONT_ROOT."Home/ShowDashboardView" ?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
    </div>
    <div class="content">
        <h3 class="text-white mt-3 mb-3">
        </h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th class="h3" colspan="4">List of Rooms by Cinema <?php echo $cine->getNombre()?></th>
                <th class="text-center " colspan="1"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregar">Add</button></th>

                </tr>
            
                <tr>
                    <th class="text-center">Number</th>
                    <th class="text-center">Room type</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Number of seats</th>
                    <th class="text-center">Options</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach($listaSala as $sala) { ?>
                    <tr>
                        <td class="text-center"><?php echo $sala->getNumero_sala()?></td>
                        <td class="text-center"><?php foreach($listTiposSalas as $tipoSala)
                            {
                                if($tipoSala->getId_tipo_sala() ==  $sala->getId_tipo_sala()) {echo $tipoSala->getNombre_tipo_sala();}
                            } ?></td>
                        <td class="text-center"><?php echo $sala->getNombre_sala()?></td>
                        <td class="text-center"><?php echo $sala->getCant_butacas()?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$sala->getId_sala()?>">Edit</button>
                                <input type="numbre" name="id" class="hide" value="<?php echo $sala->getId_sala()?>"/>
                                <input type="numbre" name="id_cine" class="hide" value="<?php echo $sala->getId_cine()?>"/>
                                <button type="button" class="btn btn-outline-danger"  data-toggle="modal" data-target="<?php echo "#modalEliminar".$sala->getId_sala()?>">Remove</button>
                            </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal del boton Remove -->
<?php
foreach ($listaSala as $sala) { ?>
<div class="modal fade" id="<?php echo "modalEliminar".$sala->getId_sala()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            
        <form action="<?php echo FRONT_ROOT . "Sala/Remove" ?>" method="post">

                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong><?php echo $sala->getNombre_sala();?></strong> Room? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <input type="number" name="id_sala" value="<?php echo $sala->getId_sala(); ?>" class="hide">
                <input type="number" name="id_cine" value="<?php echo $sala->getId_cine(); ?>" class="hide">

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';" >Remove</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php } ?>

<?php foreach($listaSala as $sala) { ?>
<!-- This is the modal -->
<div class="modal fade" id="<?php echo "modal".$sala->getId_sala()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo FRONT_ROOT."Sala/ModifyModal"?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Room Edition<?php echo $sala->getNombre_sala()?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <input type="number" name="id_sala" class="hide" value="<?php echo $sala->getId_sala()?>"/>
                    <input type="number" name="id_cine" class="hide" value="<?php echo $sala->getId_cine()?>"/>
                    <div class="row form-group pr-3">
                        <label class="col-6">Number:</label>
                        <input type="number" name="numero_sala" class="col-6" disabled value="<?php echo $sala->getNumero_sala()?>" required/>
                        <!--Input necesario par el correcto envio de datos (con disabled value no se mandan) -->
                        <input type="number" name="numero_sala" class="hide" value="<?php echo $sala->getNumero_sala()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                    <label class="col-6">Room type</label>
                        <select name="tipo_sala" class="col-6" required>
                            <?php foreach($listTiposSalas as $tipoSala) 
                            { 
                                    if($tipoSala->getId_tipo_sala() == $sala->getId_tipo_sala())
                                    {
                                    ?>
                                    <option selected value="<?php echo $tipoSala->getId_tipo_sala(); ?>"><?php echo $tipoSala->getNombre_tipo_sala(); ?></option>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <option value="<?php echo $tipoSala->getId_tipo_sala(); ?>"><?php echo $tipoSala->getNombre_tipo_sala(); ?></option>
                            <?php   }
                            } ?>
                            
                        </select>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Name:</label>
                        <input type="text" name="nombre_sala" class="col-6" value="<?php echo $sala->getNombre_sala()?>" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Number of seats:</label>
                        <input type="number" min=0 name="cant_butacas" class="col-6" value="<?php echo $sala->getCant_butacas()?>" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add a new room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-3 pr-3">
                    <input type="number" name="id_cine" value="<?php echo $cine->getId()?>" class="hide"/>
                    
                    <div class="row form-group pr-3">
                        <label class="col-6">Number:</label>
                        <input type="number" name="numero_sala" disabled value="<?php echo $lastIdOfSalaByCine + 1;?>" class="col-6" required/>
                        <!--Input necesario par el correcto envio de datos (con disabled value no se mandan) -->
                        <input type="number" name="numero_sala" value="<?php echo $lastIdOfSalaByCine + 1;?>" class="hide"/>
                    </div>
                    
                    <div class="row form-group pr-3">

                    <label class="col-6">Room type:</label>
                        <select name="tipo_sala" class="col-6" required>

                            <option value="" disabled selected>Choose a option</option>
                            
                            <?php foreach($listTiposSalas as $tipoSala) { ?>
                                <option value="<?php echo $tipoSala->getId_tipo_sala(); ?>"><?php echo $tipoSala->getNombre_tipo_sala(); ?></option>
                            <?php } ?>
                            
                        </select>

                    </div>
  
                    <div class="row form-group pr-3">
                        <label class="col-6">Name:</label>
                        <input type="text" name="nombre_sala" class="col-6" required/>
                    </div>

                    <div class="row form-group pr-3">
                        <label class="col-6">Number of seats:</label>
                        <input type="number" name="cant_butacas" class="col-6" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
    require_once("Views/footer.php");
?>