<html>  
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" style="background-color: black;">
        <a class="navbar-brand" href="#">Movie-Pass</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav  mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Cine/ShowDashboardView"?>">Lista de Cines</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cartelera
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item font-weight-bold" href="<?php echo FRONT_ROOT."Movie/GetCartelera"?>">Peliculas en Cartelera</a>
                        <div class="text-small">
                            <a class="dropdown-item text-muted" href="<?php echo FRONT_ROOT."Home/ShowFiltersViewsAdminCartelera"?>">Filtrar Cartelera</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="<?php echo FRONT_ROOT."Movie/GetMovieOutCartelera"?>">Peliculas fuera de Cartelera</a>
                        <div class="text-small">
                            <a class="dropdown-item text-muted" href="<?php echo FRONT_ROOT."Home/ShowFiltersViewsAdminOutCartelera"?>">Filtrar Peliculas</a>
                        </div>
                    </div>
                </li>
            </ul>
            <a class="nav-link text-white"  href="<?php echo FRONT_ROOT."Home/Logout"?>" role="button">Cerrar Sesión</a>
        </div>
    </nav>
</html>
