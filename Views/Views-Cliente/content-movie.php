<?php
   require_once("nav.php");
?>
<div class="container clear espaciado-sup"> 
        
    <div class="text-left mb-2">
        <?php if(isset($_SESSION["backbutton"])) { ?>
            <?php $backButton = $_SESSION["backbutton"];?>
            <?php if($backButton == "busquedaTitle") { ?>
                <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByTitle"?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
            <?php } elseif($backButton == "busquedaDate") { ?>
                <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDate"?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
            <?php } elseif($backButton == "busquedaGender") { ?>
                <a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByGender"?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
            <?php } elseif($backButton == "BusquedaMostPopularity") { ?>
                <a class="boton-atras" href="<?php echo FRONT_ROOT."Home/ShowHomeClientViews"?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
        <?php } }  ?>


       
    </div>

    <table class="table text-white" style="font-weight: bold;">
        <thead class="thead-dark">
            <th colspan = 3 class="text-center">MOVIE</th>
        </thead>
        <tbody>     
            <tr>
                <td  class="text-center bg-dark" rowspan=6><img src="<?php echo $movie->getImage()?>" alt="" width=70% height=70%> </td>
                <td class="text-uppercase bg-bordo">Title</td>
                <td class="bg-bordo"><?php echo $movie->getTitle()?></td>
            </tr>
            
            <tr  class="bg-bordo">
                <td class="text-uppercase">Popularity</td>
                <td><?php echo $movie->getPopularity()?></td>
            </tr >
            
            <tr  class="bg-bordo">
                <td class="text-uppercase">Vote average</td>
                <td>
                    <div>
                        <input class="range form-control-range" disabled value="<?php echo $movie->getVote_average()?>" type="range" step="0.1" min="0" max="10" step="0.01">
                    </div>
                </td>
            </tr>
                
            <tr  class="bg-bordo">
                <td class="text-uppercase">Overview</td>
                <td><?php echo $movie->getOverview()?></td>
            </tr>

            <tr  class="bg-bordo">
                <td class="text-uppercase">Runtime</td>
                <td><?php echo $movie->getRuntime()?></td>
            </tr>
        </tbody>            
    </table> 
</div>

<div class="container espaciado-sup">
    <div class="content">
        <div class="scrollable">
            <h3 class="text-white mt-3 mb-3">
               
            </h3>
            <table class="table" >
                <thead class="thead-dark">
                    <tr>
                        <th colspan=6 class="text-center"> List of functions </th>
                    </tr>
                    <tr>
                    <th class="text-center">Name</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Number room</th>
                        <th class="text-center">Seats available</th>
                        <th class="text-center">Date and Time</th>
                        <?php if(!empty($infoFunciones)) { ?>
                        <th class="text-center"></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php 

                        if(!empty($infoFunciones)) 
                        {

                            foreach($infoFunciones as $funcion) 
                            {     
                            ?>
                                <tr>
                                    <td class="text-center table-secondary"><?php echo $funcion["nombre_cine"];?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["calle"]." ".$funcion["numero"];?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["numero_sala"];?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["butacas_disp"];?></td>
                                    <td class="text-center table-secondary"><?php echo $funcion["fecha_hora"];?></td>
                                    <td class="text-center table-secondary">
                                        <form action="<?php echo FRONT_ROOT . "Funcion/ShowBuyTicketsView" ?>" method="post">
                                            <input type="text" class="hide" name="id" value="<?php echo $funcion["id_funcion"];?>">
                                            <button type="submit" class="<?= $funcion["butacas_disp"] ? 'btn btn-outline-success' : 'hide' ?>">Buy Ticket</button>
                                            <label class="<?= $funcion["butacas_disp"] ? 'hide' : '' ?>">No Tickets Available</label>
                                        </form>
                                    </td>
                                </tr>

                    <?php   } 
                        }
                        else
                        {
                            ?>
                            <td colspan = 5 class="text-center"> <strong>THIS MOVIE HAS NO FUNCTION AVAILABLE</strong></td>
                            <?php
                        }
                    ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>  

<!--Tabla de Funciones-->

