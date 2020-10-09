<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	require_once(VIEWS_PATH."header.php");

	Router::Route(new Request());

	require_once(VIEWS_PATH."footer.php");
?>

<?php/*
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
?>*/?>