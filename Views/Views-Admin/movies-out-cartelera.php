<?php require_once("nav.php"); ?>
    
    <div class="container content espaciado-sup">
    <table class="table text-white" style="font-weight: bold;">
            <thead class="thead-dark">
                <th colspan = 3 class="text-center h3">Seleccione la pelicula que desea agregar a Cartelera</th>
            </thead>
    </table>      
        
        <div class="cart-fondo">
            <?php if(!empty($movieListRta)) {
                foreach($movieListRta as $movie) { ?>
                    <div class="col-3">
             
                            <?php if($movie->getPoster_path()) {?>
                            

                                <input type="image" class="img-movies" src="<?php echo $movie->getImage();?>" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle();?>"  data-toggle="modal" data-target="<?php echo "#modal".$movie->getId()?>">
                            
                               

                            <?php } else { ?>
                            <div>
                                <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle();?>" data-toggle="modal" data-target="<?php echo "#modal".$movie->getId()?>">
                                <div class="centrado bg-dark"><?php echo $movie->getTitle();?></div>
                            </div>
                            <?php }?>

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

    <!--MODAL CONFIRMACION-->
    <?php foreach($movieListRta  as $movie) { ?>
    <div class="modal fade" id="<?php echo "modal".$movie->getId()?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form action="<?php echo FRONT_ROOT.'Movie/AddCartelera'?>" method="post">
                
                <div class="modal-header">
                    
                    <div class="modal-title" id="exampleModalLabel">¿Desea agregar la pelicula <strong><?php echo $movie->getTitle();?></strong> a cartelera? </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body pl-3 pr-3">
                    <input type="number" name="id" value="<?php echo $movie->getId(); ?>" class="hide">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';" >Agregar</button>
                </div>

            </form>
        </div>
    </div>
</div>
    <?php } ?>
