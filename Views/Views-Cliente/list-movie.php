<?php require_once(VIEWS_PATH."Views-Cliente/nav.php"); ?>
    
<div class="container content espaciado-sup">
    <div class="row">
        
        <?php 

        if(!empty($listMovie))
        {
            foreach($listMovie as $movie) { ?>
                <div class="col-2">
                    <form action="<?php echo FRONT_ROOT.'Movie/ShowContentViews';?>" method="post">
                        <?php if( $movie->getPoster_path()) {?>
                        
                            <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                            <input type="image" class="img-movies" src="<?php echo $movie->getImage();?>" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle();?>">
                        
                        <?php } else { ?>
                            
                        <div>
                            <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                            <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle();?>">
                            <div class="centrado"><?php echo $movie->getTitle();?></div>
                        </div>
                       
                        <?php }?>
                    </form>
                </div>
            <?php } 
        
        }
        else
        {
            
            echo "<script> if(confirm('No hay peliculas con  los requisitos especificados'));";
            echo "window.location = '/dashboard/TPSistemas-MoviePass/Home/ShowFiltersViews';
                </script>";
               
        }
        ?>
    </div>
</div>
   