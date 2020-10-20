 
<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id ="navbar-examle2">
  <a class="navbar-brand" href="#">Movie-Pass</a>
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowHomeClientViews"?>"> Inicio </a>
      </li>

      <li class="nav-item">
        <a class="nav-link "  href= "<?php echo FRONT_ROOT."Home/ShowFiltersViews"?>">
          Filtrar Por
        </a>
       </li> 
       
       <li class = "nav-item">
        <a class="nav-link"  href= "<?php echo FRONT_ROOT."Home/Logout"?>"  >
          Cerrar Sesión
        </a>
        </li>-->
       <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class= "dropdown-item  bg-secondary text-white" href= "<?php echo FRONT_ROOT."Home/form"?>">Genero</a>           
         <a class= "dropdown-item  bg-secondary text-white">Fecha</a>  
        </div>-->  
      
   <!-- </ul>
  
</nav>-->
<?php  
if(isset($_SESSION["userLogged"])){ 
  $user=$_SESSION["userLogged"];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <a class="navbar-brand" href="#">Movie-Pass</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class = "nav-item">
                <a class="nav-link text-white"> Welcome <span class="font-weight-bold"><?php echo ucfirst($user->getNombreYApellido())."!";?></span> </a>
                </li>
                       <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                       <a class= "dropdown-item  bg-secondary text-white" href= "<?php echo FRONT_ROOT."Home/form"?>">Genero</a>           
                       <a class= "dropdown-item  bg-secondary text-white">Fecha</a>  
                       </div>-->  
            </ul>
            <a class="nav-link text-white" href="<?php echo FRONT_ROOT."Home/ShowHomeClientViews"?>"> Inicio </a>
            <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/ShowFiltersViews"?>" id="navbarDropdownMenuLink" role="button">
                  Filtrar Por
            </a>
            <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/Logout"?>" >Cerrar Sesion</a>
        </div>
    </nav>






 







