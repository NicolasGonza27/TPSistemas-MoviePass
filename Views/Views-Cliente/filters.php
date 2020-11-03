
<?php
   require_once(VIEWS_PATH."header.php");
   require_once(VIEWS_PATH."Views-Cliente/nav.php");
?>

<br>
<div class="col_57 espaciado-sup">
  <div valign="middle" class="text-center">
    <div class="list-group" id="myList" role="tablist">
        <a class="list-group-item list-group-item-action list-group-item-dark active" data-toggle="list" href="#title" role="tab">Filtrar por titulo</a>
        <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#genre" role="tab">Filtrar por genero</a>
        <a class="list-group-item list-group-item-action list-group-item-dark" data-toggle="list" href="#date" role="tab">Filtrar por fecha</a>
    </div>
  </div>
  <br>
  <div class="tab-content">
    <div class="tab-pane active" id="title" role="tabpanel">
        <div  style="text-align:center" class="black-box">
            <form action="<?php echo FRONT_ROOT."Movie/ShowListViewsByTitle"?>" method="post">
                <h5 class="text-white">Introduzca el Titulo</h5>
                <div class="modal-body">
                    <input type="text" name="title" class="col" >
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="tab-pane" id="genre" role="tabpanel">
        <div  style="text-align:center" class="black-box">
            <form action="<?php echo FRONT_ROOT."Movie/ShowListViewsByGender"?>" method="post">
                <h5 class="text-white">Seleccione un genero</h5>
                <div class="modal-body">
                    <select name="gender" class="col">
                        <option value="" disabled selected>Elija una opción</option>
                        <?php foreach($listMovieGender as $movieGender) { ?>
                            <option value="<?php echo $movieGender->getId(); ?>"><?php echo $movieGender->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="tab-pane" id="date" role="tabpanel">    
        <div  style="text-align:center" class="black-box">
            <form action="<?php echo FRONT_ROOT."Movie/ShowListViewsByDate"?>" method="post" >
                <h5 class="text-white">Seleccione una fecha de estreno</h5>
                <div class="modal-body">
                    <input type="date" name="date" class="col" max="<?php echo date("Y").'-'.date("m").'-'.date("d");?>">
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form> 
        </div>
    </div>
  </div>
</div>

<script>
  $(function () {

    $('#myList a:last-child').tab('show')

  })
</script>

<?php require_once(VIEWS_PATH."footer.php"); ?>