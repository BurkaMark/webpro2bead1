<?php
    include __DIR__ . "/mnb_soap.php";

    $valid = new MNBSoap();

    /*if($valid->ValidateCurrencies("USD") == true)
    {
        echo "Van";
    }
    else
    {
        echo "nincs";
    }*/

    $valid->GetExchange('HUF','USD');
?>