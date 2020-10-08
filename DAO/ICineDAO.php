<?php
    namespace DAO;

    use Models\Cine as Cine;

    interface ICineDAO
    {

        function Add(Cine $cellPhone);
        function GetAll();
        function Remove($id);


    }

    

?>