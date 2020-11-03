<?php
   require_once(VIEWS_PATH."header.php");
   require_once("nav.php");
?>

<br>
<div class="col_57 espaciado-sup">
    <div valign="middle" class="text-center">

        <div class="btn-group btn-group-toggle list-group" id="myList" role="tablist" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input class="list-group-item" type="radio" name="options" id="option1" checked data-toggle="list" href="#genre" role="tab">
                <div class="h5">Filter for gender</div>
            </label>
            <label class="btn btn-secondary">
                <input class="list-group-item" type="radio" name="options" id="option2" data-toggle="list" href="#date" role="tab">
                <div class="h5">Filter for date</div>
            </label>
            <label class="btn btn-secondary">
                <input class="list-group-item" type="radio" name="options" id="option3" data-toggle="list" href="#title" role="tab">
                <div class="h5">Filter for title</div>
            </label>
        </div>

        <!-- <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#genre" role="tab">Filter for gender</a>
        <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#date" role="tab">Filter for date</a> -->
    </div>
    <br>
    <br>

    <div class="tab-content">

        <div class="tab-pane active" id="genre" role="tabpanel">
            <div style="text-align:center" class="black-box">
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByGenderAdminOutCartelera" ?>" method="post">
                    <h5 class="text-white">Select a gender</h5>
                    <div class="modal-body">
                        <select name="gender" class="col form-control form-control-sm">
                            <option value="" disabled selected>Choose a option</option>
                            <?php foreach ($listMovieGender as $movieGender) { ?>
                                <option value="<?php echo $movieGender->getId(); ?>"><?php echo $movieGender->getName(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Filter</button>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="date" role="tabpanel">
            <div style="text-align:center" class="black-box">
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByDateAdminOutCartelera" ?>" method="post">
                    <h5 class="text-white">Select a release date</h5>
                    <div class="modal-body">
                        <input type="date" name="date" class="col form-control form-control-sm" max="<?php echo date("Y") . '-' . date("m") . '-' . date("d"); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Filter</button>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="title" role="tabpanel">
            <div style="text-align:center" class="black-box">
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByTitleAdminOutCartelera" ?>" method="post">
                    <h5 class="text-white">Enter title</h5>
                    <div class="modal-body">
                        <input type="text" name="title" class="col form-control form-control-sm">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Filter</button>
                </form>
            </div>
        </div>

    </div>
</div>

    <div class="container content espaciado-sup">
    <table class="table text-white" style="font-weight: bold;">
        <thead class="thead-dark">
            <th colspan=3 class="text-center h3">Some of the most popular movies that you could add to the billboard</th>
        </thead>
    </table>

    <div class="cart-fondo">
        <?php if (!empty($listMovie)) {
            foreach ($listMovie as $movie) { ?>
                <div class="col-3">

                    <?php if ($movie->getPoster_path()) { ?>
                        <input type="image" class="img-movies" src="<?php echo $movie->getImage(); ?>" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle(); ?>" data-toggle="modal" data-target="<?php echo "#modal" . $movie->getId() ?>">

                    <?php } else { ?>
                        
                        <div>
                            <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="200px" height="300px" title="<?php echo $movie->getTitle(); ?>" data-toggle="modal" data-target="<?php echo "#modal" . $movie->getId() ?>">
                            <div class="centrado bg-dark"><?php echo $movie->getTitle(); ?></div>
                        </div>
                    <?php } ?>

                </div>
        <?php } }  ?>
    </div>
</div>

<!--MODAL CONFIRMACION-->
<?php foreach ($listMovie  as $movie) { ?>
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





<?php require_once(VIEWS_PATH . "footer.php"); ?>