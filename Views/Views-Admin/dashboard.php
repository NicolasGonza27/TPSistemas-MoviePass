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
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaCine as $cine) { ?>
                            <tr>
                                <td><?php echo $cine->getNombre()?></td>
                                <td><?php echo $cine->getDireccion()?></td>
                                <td><?php echo $cine->getHor_apertura()?></td>
                                <td><?php echo $cine->getHor_cierre()?></td>
                                <td><?php echo $cine->getCapacidad()?></td>
                                <td><?php echo $cine->getValor_entrada()?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- This is the modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="cine<?php echo $cine->getId() ?>">
                <div class="">
                    <form action="" method="POST">
                        
                        <div class="">
                            <label for="user">Título</label>
                            <input type="text" name="title" class="" value="<?php echo $cine->getNombre() ?>" />
                        </div>

                        <div class="">
                            <label for="">Direccion</label>
                            <input type="text" name="" class="" value="<?php echo $cine->getDireccion() ?>"/>
                        </div>

                        <div class="">
                            <label for="">Fecha de Apertura</label>
                            <input type="text" name="" class="" value="<?php echo $cine->getHor_apertura() ?>"/>
                        </div>

                        <div class="">
                            <label for="">Fecha de Cierre</label>
                            <input type="text" name="" class="" value="<?php echo $cine->getHor_cierre() ?>"/>
                        </div>

                        <div class="">
                            <label for="">Valor de Entrada</label>
                            <input type="text" name="" class="" value="<?php echo $cine->getValor_entrada() ?>"/>
                        </div>

                        <div class="">
                            <label for="">Capacidad</label>
                            <span><?php echo $cine->getCapacidad() ?>"</span>
                        </div>

                        <button type="submit" class="">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once("Views/footer.php");
?>