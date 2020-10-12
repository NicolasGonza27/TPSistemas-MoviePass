<?php
    require_once("nav.php");
?>
<div class="wrapper row4">
    <main class="container clear"> 

        <table class="table">
            <thead>
                <th colspan = 3>Movie</th>
            </thead>

            <tbody>     
                            <tr>
                                <td rowspan=5><img src="<?php echo $movie->getImage()?>" alt=""></td>
                                <td>Title</td>
                                <td><?php echo $movie->getTitle()?></td>
                            </tr>
                            
                            <tr>
                                <td>Popularity</td>
                                <td><?php echo $movie->getPopularity()?></td>
                            </tr>
                            
                            <tr>
                                <td>Vote average</td>
                                <td><?php echo $movie->getVote_average()?></td>
                            </tr>

                            <tr>
                                <td>Original language</td>
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