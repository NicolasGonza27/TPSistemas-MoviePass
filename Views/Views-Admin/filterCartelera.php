<?php
require_once(VIEWS_PATH . "header.php");
require_once("nav.php");
?>

<div class="col_57 espaciado-sup">


    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Billboard as administrator</h4>
        <p> This section is for see the movies of Billboard and add their functions. You can filter for search movies</p>
        <hr>
        <p class="mb-0">Below you will find the most popular movies in the billboard.</p>
    </div>




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
                <div class="h5">Filter for Title</div>
            </label>
        </div>
        <!-- <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#genre" role="tab">Filter for gender</a>
        <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#date" role="tab">Filter for date</a> -->
    </div>

    <br>

    <div class="tab-content">

        <div class="tab-pane active" id="genre" role="tabpanel">
            <div style="text-align:center" class="black-box">
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByGenderAdminCartelera" ?>" method="post">
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
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByDateAdminCartelera" ?>" method="post">
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
                <form action="<?php echo FRONT_ROOT . "Movie/ShowListViewsByTituloAdminCartelera" ?>" method="post">
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
<br>
<div class="container content">
    <table class="">
        <thead class="">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Some of the most popular movies that you could add functions</h4>
                <p> Click on the movie for see details</p>
                <hr>
            </div>
        </thead>
    </table>
    <div class="cart-fondo">
        <?php
        if (!empty($listMovie)) {
            foreach ($listMovie as $movie) { ?>
                <div class="col-3" style="display:block; margin:auto;">
                    <form action="<?php echo FRONT_ROOT . 'Funcion/ShowContentMovieFuncionesViews'; ?>" method="post">
                        <?php if ($movie->getPoster_path()) { ?>

                            <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                            <input type="image" class="img-movies" src="<?php echo $movie->getImage(); ?>" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle(); ?>">

                        <?php } else { ?>

                            <div>
                                <input class="hide" name="id" type="text" value="<?php echo $movie->getId(); ?>"></input>
                                <input type="image" class="img-movies img-without-movie" src="\dashboard\TPSistemas-MoviePass\Views\img\sin-Imagen-disponible.jpg" alt="" width="80%" height="80%" title="<?php echo $movie->getTitle(); ?>">
                                <div class="centrado"><?php echo $movie->getTitle(); ?></div>
                            </div>

                        <?php } ?>
                    </form>
                </div>
        <?php }
        } ?>
    </div>
</div>

<?php require_once(VIEWS_PATH . "footer.php"); ?>