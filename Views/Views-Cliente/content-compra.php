<?php

require_once(VIEWS_PATH . "Views-Cliente/nav.php");

require_once "CodigoQR/qrlib.php";

$dir = VIEWS_PATH . "temp/";

if (!file_exists($dir)) {
    mkdir($dir);
}

$tamaño = 2; //Tamaño de Pixel
$level = 'Q'; //Precisión Baja
$framSize = 3; //Tamaño en blanco


?>

<div class="container espaciado-sup">
    <div class="text-left mb-2">
        <a class="boton-atras" href="<?php echo FRONT_ROOT . "Home/ShowMyPurcheses" ?>"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"> Back</i></button></a>
    </div>
    <div class="content">
        <div class="scrollable">
            <h3 class="text-white mt-3 mb-3">

            </h3>
            <table class="table" style="font-size: 20px;">
                <thead class="thead-dark">
                    <tr>
                        <th colspan=5 class="text-center"> List tickets </th>
                    </tr>
                    <tr>
                        <th class="text-center">Ticket number</th>
                        <th class="text-center">Movie name</th>
                        <th class="text-center">Cinema</th>
                        <th class="text-center">Room number</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php

                    if (!empty($listEntradas)) {

                        foreach ($listEntradas as $entrada) {

                            $contenido = "Movie: " . $entrada["titulo_pelicula"] . " - " .
                                "Ticket number: " . $entrada["numero_entrada"] . " - " .
                                "Cinema: " . $entrada["nombre_cine"] . " - " .
                                "Seat number: " . $entrada["numero_sala"];

                            $filename = $entrada["numero_entrada"] . 'test.png';
                            $ruta = $dir . $filename;

                            QRcode::png($contenido, $ruta, $level, $tamaño, $framSize);

                    ?>

                            <tr>
                                <td class="text-center table-secondary"><?php echo $entrada["numero_entrada"]; ?></td>
                                <td class="text-center table-secondary"><?php echo $entrada["titulo_pelicula"]; ?></td>
                                <td class="text-center table-secondary"><?php echo $entrada["nombre_cine"]; ?></td>
                                <td class="text-center table-secondary"><?php echo $entrada["numero_sala"]; ?></td>
                                <td class="text-center table-secondary"><a type="button" class="btn btn-success btn-lg" href="http://localhost/dashboard/TPSistemas-MoviePass/Views/temp/<?php echo $filename ?>" download="<?php echo $filename; ?>"><i class="fa fa-download">QR</i></a></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
                </form>
            </table>
        </div>
    </div>
</div>