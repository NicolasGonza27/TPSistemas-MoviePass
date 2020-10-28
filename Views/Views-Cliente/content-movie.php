<?php
   require_once("nav.php");
?>
    <div class="container clear espaciado-sup"> 
        
        <div class="text-left mb-2">
            <?php if(isset($_SESSION["busquedaDate"])) { ?>
                <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDate"?>">&larr; Atras</a></button>
            <?php } else { 
                if(isset($_SESSION["busquedaGender"])) { ?>
                    <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByGender"?>">&larr; Atras</a></button>
                <?php } ?>
            <?php } ?>
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
                                        <input class="range" disabled value="<?php echo $movie->getVote_average()?>" type="range" step="0.1" min="0" max="10" step="0.01">
                                    </div>
                                </td>
                            </tr>
                                
                            <tr  class="bg-bordo">
                                <td class="text-uppercase">Overview</td>
                                <td><?php echo $movie->getOverview()?></td>
                            </tr>

                            <tr  style="background-color: #6F1E1E;">
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
                        <th colspan=5 class="text-center"> LISTADO DE FUNCIONES </th>
                    </tr>
                    <tr>
                    <th class="text-center">Nombre Del Cine</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Numero Sala</th>
                        <th class="text-center">Butacas Disponibles</th>
                        <th class="text-center">Fecha y Hora</th>
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
                                    <td class="text-center"><?php echo $funcion["nombre_cine"];?></td>
                                    <td class="text-center"><?php echo $funcion["calle"]." ".$funcion["numero"];?></td>
                                    <td class="text-center"><?php echo $funcion["numero_sala"];?></td>
                                    <td class="text-center"><?php echo $funcion["butacas_disp"];?></td>
                                    <td class="text-center"><?php echo $funcion["fecha_hora"];?></td>
                                </tr>

                    <?php   } 
                        }
                        else
                        {
                            ?>
                            <td colspan = 5 class="text-center"> <strong>ESTA PELICULA NO TIENE FUNCIONES DISPONIBLES</strong></td>
                            <?php
                        }
                    ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>  

<!--Tabla de Funciones-->

