<?php require_once("nav.php"); ?>



<div class="container content espaciado-sup">
    <div class="text-left mb-2">
        <a class="boton-atras" href="<?php echo FRONT_ROOT."Home/ShowFiltersViewsAdminOutCartelera"?>"><button class="btn btn-secondary"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
    </div>
    <table class="table text-white" style="font-weight: bold;">
        <thead class="thead-dark">
            <th colspan=3 class="text-center h3">Select the movie you want to add to the billboard</th>
        </thead>
    </table>

    <div class="cart-fondo">
        <?php if (!empty($movieListRta)) {
            foreach ($movieListRta as $movie) { ?>
                <div class="col-3" style="display:block; margin:auto;">

                    <?php if ($movie->getPoster_path()) { ?>
                        <input type="image" class="img-movies" src="<?php echo $movie->getImage(); ?>" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle(); ?>" data-toggle="modal" data-target="<?php echo "#modal" . $movie->getId() ?>">

                    <?php } else { ?>
                        
                        <div>
                            <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle(); ?>" data-toggle="modal" data-target="<?php echo "#modal" . $movie->getId() ?>">
                            <div class="centrado bg-dark"><?php echo $movie->getTitle(); ?></div>
                        </div>
                    <?php } ?>

                </div>
        <?php }
        } else {
            echo "<script> if(confirm('There are no movies with the specified elements'));";
            echo "window.location = '/dashboard/TPSistemas-MoviePass/Home/ShowFiltersViewsAdminOutCartelera';
                    </script>";
        } ?>
    </div>
</div>

<!--MODAL CONFIRMACION-->
<?php foreach ($movieListRta  as $movie) { ?>
    <div class="modal fade" id="<?php echo "modal" . $movie->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?php echo FRONT_ROOT . 'Movie/AddCartelera' ?>" method="post">

                    <div class="modal-header">

                        <div class="modal-title" id="exampleModalLabel">Do you want to add the movie <strong><?php echo $movie->getTitle(); ?></strong> to the billboard?</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <input type="number" name="id" value="<?php echo $movie->getId(); ?>" class="hide">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Sending…';">Add</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>