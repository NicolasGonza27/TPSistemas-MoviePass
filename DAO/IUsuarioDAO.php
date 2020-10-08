<?php

    namespace DAO;
    use Models\Usuario as Usuario;

    interface IUsuarioDAO
        {
            function Add(Usuario $user);
            function GetAll();
        }
    

?>