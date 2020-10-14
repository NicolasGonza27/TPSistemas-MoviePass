<?php require_once(VIEWS_PATH."Views-Cliente/nav.php"); ?>
    
<div class="container content espaciado-sup">
    <div class="row">
        <?php foreach($listMovie as $movie) { ?>
            <div class="col-2">
                <form action="<?php echo FRONT_ROOT.'Movie/ShowContentViews';?>" method="post">
                    <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                    <input type="image" class="img-movies" src="<?php echo $movie->getImage();?>" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle();?>">
                </form>
            </div>
        <?php } ?>
    </div>
</div>
   