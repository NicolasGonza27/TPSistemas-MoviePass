
<?php
   
   require_once(VIEWS_PATH."header.php");
   require_once(VIEWS_PATH."Views-Cliente/nav.php");
  

?>

    <br>
    <div class="col_57">
    <div valign = "middle" style="text-align:center">
     <div class="list-group" id="myList" role="tablist">
     <a class="list-group-item list-group-item-action list-group-item-dark active" data-toggle="list" href="#home" role="tab">Filtrar por genero</a>
     <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#profile" role="tab">Filtrar por fecha</a>
    </div>
    </div>

<br>

<div class="tab-content">
  <div class="tab-pane active black-box" id="home" role="tabpanel">
  <form class = "form-control:valid "  action="<?php echo FRONT_ROOT."Home/ShowListMovieView"?>" method="post">
        <div style="text-align:center">
          <h5 class="genero"  id="exampleModalLabel">Seleccione un genero</h5>
        </div>
        
        <div class="modal-body">
          <select name="" class = "col"  >
            <option value="" disabled selected>Elija una opción</option>
            <option value="terror">Terror</option>
            <option value="aventura">Aventura</option>
            <option value="accion">Accion</option>
          </select>
        </div>

        <div  style= "text-align:center">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>  
  
  </div>

  <div class="tab-pane" id="profile" role="tabpanel">    
  <div  style="text-align:center" class="black-box">
      <form action="<?php echo FRONT_ROOT."Home/ShowListMovieView"?>" method="post" >
        <div style="text-align:center">
          <h5 class="genero" id="exampleModalLabel">Seleccione una fecha de estreno</h5>

        </div>
        <div class="modal-body">
           <input type="date" name="date" class="col" >
        </div>

        <div  style= "text-align:center">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
        
      </form> 
   </div>
   </div>

</div>

<script>
  $(function () {
    $('#myList a:last-child').tab('show')
  })
</script>
    </div>


    

<?php

require_once(VIEWS_PATH."footer.php");


?>