<?php

namespace Controllers;

use API\MovieAPI as MovieAPI;
use API\MovieGenderAPI as MovieGenderAPI;


use DAObd\CompraDAO;


use DAObd\MovieDAO as MovieDAO;
use DAObd\UsuarioDAO as UsuarioDAO;
use DAObd\FuncionDAO as FuncionDAO;
use DAObd\CineDAO as CineDAO;
use Exception;

class HomeController
{
    private $usuarioDAO;
    private $cineDAO;
    private $movieGenderAPI;
    private $funcionDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
        $this->cineDAO = new CineDAO();
        $this->movieGenderAPI = new MovieGenderAPI();
        $this->funcionDAO = new FuncionDAO();
    }

    public function Index($message = "")
    {

        try
        {
            if (isset($_SESSION["userLogged"])) 
            {
                $user = $_SESSION["userLogged"];

                if ($user->getId_tipo_usuario() == 1) 
                {
                    $this->ShowDashboardView();
                } elseif ($user->getId_tipo_usuario() == 2) 
                {
                    $this->ShowHomeClientViews();
                }
            } 
            else 
            {
                $this->ShowFiltersNotLogin();
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

    }

    public function ShowDashboardView()
    {
        try
        {
            $listaCines = $this->cineDAO->GetAllWithCapacity();
            require_once(VIEWS_PATH . "Views-Admin/dashboard.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowListMovieView()
    {   
        try
        {
            $listMovie =
            require_once(VIEWS_PATH . "Views-Cliente/list-movie.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowHomeClientViews()
    {
        try
        {
            require_once(VIEWS_PATH . "Views-Cliente/home-client.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowMyPurcheses()
    {
        try
        {
            $user = $_SESSION["userLogged"];
            $comprasDAO = new CompraDAO();
            $listCompras = $comprasDAO->GetAllByUser($user->getId_usuario());
            require_once(VIEWS_PATH . "Views-Cliente\list-compras.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowFiltersViews()
    {
        try
        {
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAllMostPopularity(500);
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH . "Views-Cliente/filters.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

    }

    public function ShowFiltersViewsAdminCartelera()
    {
        try
        {
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAllMostPopularity(500);
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH . "Views-Admin/filterCartelera.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

    }

    public function ShowQuantityTickets()
    {
        try
        {
            $listaCine = $this->cineDAO->GetAllWithCapacity();
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAll();
            $listFunciones = $this->funcionDAO->GetAllInfoFunctions();
            $entradasVendidasXcine = $this->funcionDAO->GetAllEntradasXcine();
            $entradasVendidasXfuncion = $this->funcionDAO->GetAllEntradasXfuncion();
            $entradasVendidasXpeliculas = $this->funcionDAO->GetAllEntradasXpelicula();
            require_once(VIEWS_PATH."Views-Admin/quantityTickets.php"); 
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowTicketsPrice()
    {
        try
        {
            $listaCine = $this->cineDAO->GetAllWithCapacity();
            $movieDAO = new MovieDAO();
            $listMovie = $movieDAO->GetAll();
            $listFunciones = $this->funcionDAO->GetAllInfoFunctions();
            $entradasVendidasXcinePesos = $this->funcionDAO->GetAllEntradasXcinePesos();
            $entradasVendidasXpeliculasPesos = $this->funcionDAO->GetAllEntradasXpeliculaPesos();
            require_once(VIEWS_PATH."Views-Admin/ticketSales.php"); 
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }

    }



    public function ShowFiltersViewsAdminOutCartelera()
    {
        try
        {
            $movieAPI = new MovieAPI();
            $listMovie = $movieAPI->GetAllMostPopularityOutCartelera();
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH . "Views-Admin/filterOutCartelera.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowFiltersNotLogin()
    {
        try
        {
            $movieAPI = new MovieAPI();
            $_SESSION["backbutton"] = "BusquedaMostPopularity";
            $listMovie = $movieAPI->GetAllMostPopularityOutCartelera();
            $listMovieGender = $this->movieGenderAPI->GetAll();
            require_once(VIEWS_PATH."/home.php");
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function Login($email, $password)
    {
        try
        {
            $user = $this->usuarioDAO->GetOneByEmail($email);

            if ($user) 
            {
                if ($user->GetPassword() == $password) 
                {
                    $_SESSION["userLogged"] = $user;

                    if ($user->getId_tipo_usuario() == 1) 
                    {
                        $this->ShowDashboardView();
                    } 
                    elseif ($user->getId_tipo_usuario() == 2) 
                    {
                        require_once(VIEWS_PATH . "Views-Cliente/home-client.php");
                    }
                } 
                else 
                {
                    $_SESSION["error"] = 1;
                    $this->StartLogin();
                }
            } 
            else 
            {
                $_SESSION["error"] = 1;
                $this->StartLogin();
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function StartLogin()
    {
        require_once(VIEWS_PATH."/login.php");
    }

    public function Logout()
    {
        session_destroy();
        session_start();
        session_destroy();
        $this->Index();
    }

    public function DescargarImage($Views, $temp, $fileName)
    {
        header("Content-type: image/png");
        header("Location: http://localhost/dashboard/TPSistemas-MoviePass/$Views/$temp/$fileName");
    }
}
