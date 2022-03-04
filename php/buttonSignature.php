<?php
    include '../vendor/autoload.php';
    require_once 'ap_sample_config.php';
    
    $client = new Amazon\Pay\API\Client($amazonpay_config);
    $payload = $_POST['payload'];
    $signature = $client->generateButtonSignature($payload);
    echo $signature;

