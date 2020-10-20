<?php
   require_once("nav.php");
?>
<div class="wrapper row4">
    <main class="container clear espaciado-sup"> 
        
        <div class="text-left mb-2">
            <button class="btn btn-secondary"><a class="boton-atras" href="<?=$_SERVER["HTTP_REFERER"]?>/">&larr; Atras</a></button>
        </div>

        <table class="table text-white" style="font-weight: bold;">
            <thead>
                <th colspan = 3 class="text-center">Movie</th>
            </thead>
            <tbody>     
                            <tr>
                                <td rowspan=5><img src="<?php echo $movie->getImage()?>" alt=""></td>
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
                                <td class="text-uppercase">Original language</td>
                                <td><?php echo $movie->getOriginal_language()?></td>
                            </tr>

                            <tr>
                                <td>Overview</td>
                                <td><?php echo $movie->getOverview()?></td>
                            </tr>
                    </tbody>            
            </table>               

    </main>    
</div>
