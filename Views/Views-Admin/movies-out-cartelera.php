<?php require_once("nav.php"); ?>
    
    <div class="container content espaciado-sup">
    <table class="table text-white" style="font-weight: bold;">
            <thead class="thead-dark">
                <th colspan = 3 class="text-center ">Seleccione la pelicula que desea agregar a Cartelera</th>
            </thead>
    </table>      
        
        <div class="cart-fondo">
            <?php if(!empty($movieListRta)) {
                foreach($movieListRta as $movie) { ?>
                    <div class="col-3">
                        <form action="<?php echo FRONT_ROOT.'Movie/AddCartelera'?>" method="post">
                            <?php if($movie->getPoster_path()) {?>
                            
                                <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                                <input type="image" class="img-movies" src="<?php echo $movie->getImage();?>" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle();?>">
                            
                            <?php } else { ?>
                            <div>
                                <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                                <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle();?>">
                                <div class="centrado bg-dark"><?php echo $movie->getTitle();?></div>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                <?php } 
            }
            else {
                echo "<script> if(confirm('No hay peliculas con  los requisitos especificados'));";
                echo "window.location = '/dashboard/TPSistemas-MoviePass/Home/ShowFiltersViewsAdminOutCartelera';
                    </script>";
            } ?>
        </div>
    </div>