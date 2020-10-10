<?php
    require_once("Views/header.php");
    require_once("nav.php");

    use Models\Cine as Cine;
    use DAO\ICineDAO as ICineDAO;
    use DAO\CineDAO as CineDAO;

    $cineDao = new CineDAO();
    //$cine1 = new Cine(0,"Aldrei","Calle","100",12,12,12);
    
    //$cineDao->Add($cine1);
    $listaCine = $cineDao->GetAll();
    
?>

<div class="container">
    <div class="content">
        <div class="scrollable">
            <form class="form" action="" method="post">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Descripción</th>
                            <th>Dirección</th>
                            <th>Horario Apertura</th>
                            <th>Horario Cierre</th>
                            <th>Capacidad</th>
                            <th>Valor Entrada</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaCine as $cine) { ?>
                            <tr>
                                <td><?php echo $cine->getNombre()?></td>
                                <td><?php echo $cine->getDireccion()?></td>
                                <td class="text-right"><?php echo $cine->getHor_apertura()?></td>
                                <td class="text-right"><?php echo $cine->getHor_cierre()?></td>
                                <td class="text-right"><?php echo $cine->getCapacidad()?></td>
                                <td class="text-right"><?php echo $cine->getValor_entrada()?></td>
                                <form action="<?php echo FRONT_ROOT."Cine/Remove"?>" method="post">
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="<?php echo "#modal".$cine->getId()?>">Editar</button>
                                        <button type="submit" class="btn btn-outline-danger" name="id" value="<?php echo $cine->getId()?>">Borrar</button>
                                    </td>
                                </form> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php foreach($listaCine as $cine) { ?>
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
                <div class="modal-body">
                    <input type="numbre" name="id" class="hide" value="<?php echo $cine->getId()?>"/>
                    <div class="">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="" value="<?php echo $cine->getNombre()?>"/>
                    </div>

                    <div class="">
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="" value="<?php echo $cine->getDireccion()?>"/>
                    </div>

                    <div class="">
                        <label>Capacidad</label>
                        <input type="text" name="capacidad" class="" value="<?php echo $cine->getCapacidad()?>"/>
                    </div>

                    <div class="">
                        <label>Fecha de Apertura</label>
                        <input type="number" name="apertura" class="" value="<?php echo $cine->getHor_apertura()?>"/>
                    </div>

                    <div class="">
                        <label>Fecha de Cierre</label>
                        <input type="number" name="cuerre" class="" value="<?php echo $cine->getHor_cierre()?>"/>
                    </div>

                    <div class="">
                        <label>Valor de Entrada</label>
                        <input type="numbre" name="valor_entrada" class="" value="<?php echo $cine->getValor_entrada()?>"/>
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

<?php
    require_once("Views/footer.php");
?>