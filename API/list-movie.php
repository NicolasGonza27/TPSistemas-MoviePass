<?php
    //require_once(VIEWS_PATH."header.php");
    //require_once(VIEWS_PATH."nav.php");


require_once("API/MovieAPI.php");
use API\MovieAPI as MovieAPI;


$movieAPI = new MovieAPI();
$listMovie = $movieAPI->getAll();

?>
<div class="row">
    <div class="container">
        <div class="content">
            <div class="scrollable">
                <form class="form" action="<?php echo FRONT_ROOT."/"?>" method="post">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>popularity</th>
                                <th>vote_count</th>
                                <th>video</th>
                                <th>adult</th>
                                <th>original_language</th>
                                <th>original_title</th>
                                <th>title</th>
                                <th>overview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listMovie as $movie) 
                            {
                                ?>
                            
                            <tr>
                                <td><?php echo $movie->getPopularity(); ?></td>
                                <td><?php echo $movie->getVote_count(); ?></td>
                                <td><?php echo $movie->getVideo(); ?></td>
                                <td><?php echo $movie->getAdult(); ?></td>
                                <td><?php echo $movie->getOriginal_language(); ?></td>
                                <td><?php echo $movie->getTitle(); ?></td>
                                <td><?php echo $movie->getOverview(); ?></td>
                                <td><button type="submit" name="id" class="btn" value="<?php?>"> Datails </button></td>
                            </tr>
                            
                            <?php
                            }?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
</div>
</div>
<?php
    //require_once(VIEWS_PATH."footer.php");
?>