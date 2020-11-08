<?php
    // SDK de Mercado Pago
    require __DIR__.'/vendor/autoload.php';

    MercadoPago\SDK::setAccessToken('APP_USR-5779767445691294-110217-54ba346de7601f77d5b33c6216dbd1b9-265345871');
    // Crea un objeto de preferencia
    
    $preference = new MercadoPago\Preference();
    $item = new MercadoPago\Item();
    $item->title = 'Ticket/s for '.$movie->getTitle();
    $item->quantity = 1;
    $item->unit_price = $cine->getValor_entrada();

    $preference->items = array($item);
    $preference->back_urls = array(
        "success" => "localhost/dashboard/TPSistemas-MoviePass/Views/Views-Cliente/home-client.php",
        "failure" => "localhost/dashboard/TPSistemas-MoviePass/Funcion/ShowBuyTicketsView?id_function=".$id_funcion."&quantity=".$quantity,
        "pending" => "localhost/dashboard/TPSistemas-MoviePass/Funcion/ShowBuyTicketsView?id_function=".$id_funcion."&quantity=".$quantity
    );
    $preference->payment_methods = array(
        "excluded_payment_types" => array(
            array("id" => "ticket"),
            array("id" => "debit_card")
        )
    );
    $preference->auto_return = "approved";
    $preference->save();


?>