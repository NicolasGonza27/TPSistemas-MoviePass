<html>  
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" style="background-color: black;">
        <a class="navbar-brand" href="#">Movie-Pass</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav  mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowDashboardView"?>">Lista de Cines</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cartelera
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT."Funcion/getMovieListConFuncion"?>">Peliculas en Cartelera</a>
                        <a class="dropdown-item" href="<?php echo FRONT_ROOT."Funcion/getMovieListSinFuncion"?>">Peliculas sin funciones</a>
                    </div>
                </li>
            </ul>
            <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/Logout"?>"role="button">Cerrar Sesión</a>
        </div>
    </nav>
</html>
