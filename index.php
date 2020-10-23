<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
	

	Autoload::start();

    session_start();

	require_once(VIEWS_PATH."header.php");

	Router::Route(new Request());

    require_once(VIEWS_PATH."footer.php");
?>


<?php 
/*	
	use DAObd\CineDAO as CineDAO;
	use DAObd\FuncionDAO as FuncionDAO;
	use DAObd\MovieDAO as MovieDAO;
	use DAObd\SalaDAO as SalaDAO;
	use Models\Cine as Cine;
	use Models\Funcion as Funcion;
	use Models\Sala as Sala;

	$movieDAO = new MovieDAO();
	$movieDAO->refresh();

	
	$cineDAO = new CineDAO();

	$cineDAO->Add(new Cine(null,"Ambasador","Calle",123,"200",'19:00:00','23:00:00',200));
	$cineDAO->Add(new Cine(null,"Aldrey","Calle 2",456,"400",'19:00:00','00:00:00',500));
	$cineDAO->Add(new Cine(null,"Shopping peatonal","Calle 3",789,"400",'15:00:00','21:00:00',500));
	$cineDAO->Add(new Cine(null,"Paseo Diagonal","Calle 5",426,"400",'20:00:00','01:00:00',500));

	
	$salaDAO = new SalaDAO;

	$salaDAO->Add(new Sala(null,1,1,"Sala 1",200));
	$salaDAO->Add(new Sala(null,1,2,"Sala 2",100));
	$salaDAO->Add(new Sala(null,2,1,"Sala 1",150));
	$salaDAO->Add(new Sala(null,2,2,"Sala 2",100));
	$salaDAO->Add(new Sala(null,3,1,"Sala 1",200));
	$salaDAO->Add(new Sala(null,3,2,"Sala 2",150));
	$salaDAO->Add(new Sala(null,4,1,"Sala 1",120));
	$salaDAO->Add(new Sala(null,4,2,"Sala 2",160));


	$funcionDAO	= new FuncionDAO();

	$funcionDAO->Add(new Funcion(null,11423,1,100,"2020-12-08 19:00:00"));
	$funcionDAO->Add(new Funcion(null,337401,2,50,"2020-12-09 19:00:00"));
	$funcionDAO->Add(new Funcion(null,340102,3,100,"2020-12-08 19:00:00"));
	$funcionDAO->Add(new Funcion(null,399363,4,80,"2020-12-09 19:00:00"));
	$funcionDAO->Add(new Funcion(null,405177,5,120,"2020-12-12 19:00:00"));
	$funcionDAO->Add(new Funcion(null,412546,6,100,"2020-12-11 19:00:00"));
	$funcionDAO->Add(new Funcion(null,413518,7,110,"2020-12-15 19:00:00"));
	$funcionDAO->Add(new Funcion(null,425001,8,105,"2020-12-14 19:00:00"));

*/
?>
