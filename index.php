<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
	
	use DAObd\CineDAO as CineDAO;
	use DAObd\FuncionDAO;
	use DAObd\MovieGenderDAO as MovieGenderDAO;
	use DAObd\MovieDAO as MovieDAO;
	use DAObd\SalaDAO as SalaDAO;
	use Models\Cine as Cine;

	Autoload::start();

    session_start();

	require_once(VIEWS_PATH."header.php");

	//Router::Route(new Request());

	$cineDAO = new CineDAO();

	//$cineDAO->Add(new Cine(1,"Algo","Bonito",222,0,'19:20:20','19:22:20',200));
	
	$cineDAO->Modify(4,new Cine("Nada","FEo",222,0,'19:20:20','19:22:20',200));

	var_dump($cineDAO->GetAll());

	/*$movieGenderDAO = new MovieGenderDAO();
	$movieGenderDAO->refresh();
	
	$movieDAO = new MovieDAO();
	$movieDAO->refresh();

	$salasDAO = new SalaDAO();	
	
	$funcionesDAO = new FuncionDAO();*/


    require_once(VIEWS_PATH."footer.php");
?>



