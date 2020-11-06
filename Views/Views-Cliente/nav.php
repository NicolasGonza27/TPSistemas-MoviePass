 
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
      $user = $_SESSION["userLogged"];
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" style="background-color: black;">
    <a class="navbar-brand" href="#">Movie-Pass</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class = "nav-item">
              <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowHomeClientViews"?>"> Index </a>
            </li>
            <li class = "nav-item">  
              <a class="nav-link"  href= "<?php echo FRONT_ROOT."Home/ShowFiltersViews"?>" id="navbarDropdownMenuLink" role="button">
                Billboard
              </a>
            </li>
            <li class = "nav-item">
              <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowMyPurcheses"?>">My purchases </a>
            </li>

            <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class= "dropdown-item  bg-secondary text-white" href= "<?php echo FRONT_ROOT."Home/form"?>">Genero</a>           
            <a class= "dropdown-item  bg-secondary text-white">Fecha</a>  
            </div>-->  
        </ul>

        <form class="form-inline my-2 my-lg-0" action="<?php echo FRONT_ROOT."Movie/ShowListViewsByTitle"?>" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Title of movie" name="title" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <a class="nav-link text-white"> Welcome <span class="font-weight-bold"><?php if(isset($user))echo ucfirst($user->getNombre_usuario())."!";?></span></a>
        <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/Logout"?>" >Log out</a>
    </div>
</nav>






 







