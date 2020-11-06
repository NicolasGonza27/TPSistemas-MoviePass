<?php
require_once(VIEWS_PATH . "header.php");
require_once("nav.php");
?>

<div class="container espaciado-sup">
    <div class="content">

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="h3" colspan="6">List of cinemas</th>
                    <th class="text-center" colspan="1"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregar">Add</button></th>
                </tr>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Street</th>
                    <th class="text-center">Number</th>
                    <th class="text-center">Opening Hours</th>
                    <th class="text-center">Closing hours</th>
                    <th class="text-center">Cinema ticket price</th>
                    <th class="text-center">Options</th>
                </tr>
            </thead>
            <tbody class="bg-white">

                <?php if($listaCines){ foreach ($listaCines as $cine) { ?>
                    <tr>
                        <td class="text-center"><?php echo $cine->getNombre() ?></td>
                        <td class="text-center"><?php echo $cine->getCalle() ?></td>
                        <td class="text-center"><?php echo $cine->getNumero() ?></td>
                        <td class="text-center"><?php $ape = explode(":", $cine->getHor_apertura()); echo $ape[0].":".$ape[1]; ?> </td>
                        <td class="text-center"><?php $close = explode(":", $cine->getHor_cierre()); echo $close[0].":".$close[1];?> </td>
                        <td class="text-center"><?php echo $cine->getValor_entrada() ?></td>
                        <td class="text-center row">
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal" . $cine->getId(); ?>">Edit</button>
                            <button type="button" class="btn btn-outline-danger" style="margin-left: 3px;"  data-toggle="modal" data-target="<?php echo "#modalEliminar" .  $cine->getId();?>">Remove</button>
                            <form action="<?php echo FRONT_ROOT . "Sala/ShowSalaDashboardView" ?>" method="post">
                                <input type="text" class="hide" name="id" value="<?php echo $cine->getId() ?>">
                                <button type="submit" class="btn btn-outline-success" style="margin-left: 3px;">Rooms</button>
                            </form>
                        </td>
                    </tr>
                <?php } } else { ?>
                    <td colspan = 7 class="text-center"> <strong>NO CINEMA SAVED IN FILES</strong></td>              

                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>


<?php
foreach ($listaCines as $cine) { ?>
    <!-- This is the modal -->
    <div class="modal fade" id="<?php echo "modal" . $cine->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="signup-form">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="<?php echo FRONT_ROOT . "Cine/ModifyModal" ?>" method="post">


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2>Edit Cinema <?php echo $cine->getNombre() ?></h2>
                        <p>You can edit the cinema, change the text fields that you want modify</p>
                        <hr>

                        <input type="numbre" name="id" class="hide" value="<?php echo $cine->getId() ?>" />

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $cine->getNombre() ?>" required />
                        </div>
                            
                        <div class="form-group">
                            <div class="row">
                                <div class="col"><label for="">Street</label><input type="text" class="form-control" name="calle" value="<?php echo $cine->getCalle() ?>" required="required"></div>
                                <div class="col"><label for="">Number</label><input type="text" class="form-control" name="numero" value="<?php echo $cine->getNumero() ?>" required="required"></div>
                            </div>
                        </div>


                        <input type="text" name="capacidad" class="hide" value="<?php echo $cine->getCapacidad() ?>" />

                        <div class="form-group">
                            <label for="">Opening Hours:</label>
                            <input type="time" name="apertura" class="form-control" value="<?php echo $cine->getHor_apertura() ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="">Closing hours</label>
                            <input type="time" name="cierre" class="form-control" value="<?php echo $cine->getHor_cierre() ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="">Cinema ticket price</label>
                            <input type="number" name="valor_entrada" min="1" class="form-control" step="0.50" value="<?php echo $cine->getValor_entrada() ?>" required />
                        </div>

                       <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="number" class="form-control" disabled value="<?php echo $cine->getCapacidad();?>" required />
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- Modal del boton Remove -->
<?php
foreach ($listaCines as $cine) { ?>
    <div class="modal fade" id="<?php echo "modalEliminar" .  $cine->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo FRONT_ROOT . "Cine/Remove" ?>" method="post">

                    <div class="modal-header">
                        <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong><?php echo $cine->getNombre(); ?></strong> Cinema? </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <input type="number" name="id" value="<?php echo $cine->getId(); ?>" class="hide">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';">Remove</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>



<!-- Modal del boton Remove -->
    <?php
    foreach ($listaCines as $cine) { ?>
    <div class="modal fade" id="<?php echo "modalEliminar" .  $cine->getId();?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                
            <form action="<?php echo FRONT_ROOT . "Cine/Remove" ?>" method="post">

                    <div class="modal-header">
                        <div class="modal-title" id="exampleModalLabel">¿Are you sure to remove <strong><?php echo $cine->getNombre();?></strong> Cinema? </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <input type="number" name="id" value="<?php echo $cine->getId(); ?>" class="hide">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';" >Remove</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php } ?>








<!-- Modal del boton Agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo FRONT_ROOT . "Cine/Add" ?>" method="post">


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Add cinema</h2>
                    <p>You can add cinema, complete the following textfilds</p>
                    <hr>

                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Name" required />
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col"><input type="text" class="form-control" name="calle" placeholder="Street" required="required"></div>
                            <div class="col"><input type="text" class="form-control" name="numero" placeholder="Number" required="required"></div>
                        </div>
                    </div>

                    <input type="text" name="capacidad" class="hide" />

                    <div class="form-group">
                        <label for="Opening-Hours">Opening Hours</label>
                        <input type="time" name="apertura" class="form-control" id="Opening-Hours" placeholder="Opening Hours" required />
                    </div>

                    <div class="form-group">
                        <label for="Closing-hours">Closing hours</label>
                        <input type="time" name="cierre" class="form-control" id="Closing-hours" placeholder="Closing-hours" required />
                    </div>

                    <div class="form-group">
                        <input type="number" name="valor_entrada" min="1" step="0.50" class="form-control" placeholder="Cinema ticket price" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="signup-form">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo FRONT_ROOT . "Usuario/AddNuevoUsuario" ?>" method="post">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2>Edit cinema</h2>
                    <p>Please fill in this form to create an account!</p>
                    <hr>

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

</div>



<?php
require_once("Views/footer.php");
?>

<script>
    $("input[type=text]").keyup(function() {
        leters = $(this).val().replace("  ", "");
        $(this).val(leters);
    });
</script>