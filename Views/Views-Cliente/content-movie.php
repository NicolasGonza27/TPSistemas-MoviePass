<?php
   require_once("nav.php");
?>
    <div class="container clear espaciado-sup"> 
        
        <div class="text-left mb-2">
            <button class="btn btn-secondary"><a class="boton-atras" href="<?php echo FRONT_ROOT."Movie/ShowListViewsByDate"?>">&larr; Atras</a></button>
        </div>

        <table class="table text-white" style="font-weight: bold;">
            <thead>
                <th colspan = 3 class="text-center">Movie</th>
            </thead>
            <tbody>     
                            <tr>
                                <td rowspan=6><img src="<?php echo $movie->getImage()?>" alt=""> </td>
                                <td class="text-uppercase">Title</td>
                                <td><?php echo $movie->getTitle()?></td>
                            </tr>
                            
                            <tr>
                                <td class="text-uppercase">Popularity</td>
                                <td><?php echo $movie->getPopularity()?></td>
                            </tr>
                            
                            <tr>
                                <td class="text-uppercase">Vote average</td>
                                <td><?php echo $movie->getVote_average()?></td>
                            </tr>
                                
                            <tr>
                                <td class="text-uppercase">Overview</td>
                                <td><?php echo $movie->getOverview()?></td>
                            </tr>

                            <tr>
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
                Listado de Funciones
            </h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre Del Cine</th>
                        <th>Dirección</th>
                        <th class="text-center">Numero Sala</th>
                        <th class="text-center">Butacas Disponibles</th>
                        <th class="text-center">Hora</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach($listFuncion as $funcion) { ?>
                        <tr>
                            <td class="text-center"><?php echo $funcion->getId_funcion()?></td>
                            <td class="text-center"><?php echo $funcion->getId_sala()?></td>
                            <td class="text-center"><?php echo $funcion->getId_pelicula()?></td>
                            <td class="text-center"><?php echo $funcion->getCant_asistentes()?></td>
                            <td class="text-center"><?php echo $funcion->getFecha_hora()?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  

<!--Tabla de Funciones-->

