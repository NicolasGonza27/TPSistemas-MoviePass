<?php 

    namespace CodigoQR;

    require_once "CodigoQR/qrlib.php";    

    use QRcode;

    class GeneradorQR
    {
        public function generer($contenido,$ruta)
        {
	
        $dir = VIEWS_PATH."temp/";
        
        if (!file_exists($dir))
        {
            mkdir($dir);
        }
        
        $tamaño = 2; //Tamaño de Pixel
        $level = 'Q'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco

        QRcode::png($contenido, $ruta, $level, $tamaño, $framSize); 
        

        }

    }



?>