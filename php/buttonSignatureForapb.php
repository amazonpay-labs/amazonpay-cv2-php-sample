<?php
    include '../vendor/autoload.php';
    require_once 'ap_sample_config.php';

    // $amazonpay_config = array(
    //     'public_key_id' => 'MY_PUBLIC_KEY_ID',
    //     'private_key'   => 'keys/private.pem',
    //     'region'        => 'US',
    //     'sandbox'       => true
    // );

    $client = new Amazon\Pay\API\Client($amazonpay_config);
    //お届け先・お支払い方法を利用する場合(productType: 'PayAndShip')
    //必要に応じて、Payloadの決済情報(paymentDetails)・住所情報(AddressDetails)を変更して下さい。
    $payload = '{"storeId":"amzn1.application-oa2-client.XXXXXXX","webCheckoutDetails":{"checkoutResultReturnUrl":"https://XXXXXXX/php/result_return_apb.php","checkoutMode": "ProcessOrder"},"paymentDetails":{"paymentIntent":"Authorize","chargeAmount":{"amount":"321","currencyCode":"JPY"}},"addressDetails":{"addressLine1":"%E4%BD%8F%E6%89%80%EF%BC%91%E7%9B%AE%E9%BB%92%E5%8C%BA%E4%B8%8B%E7%9B%AE%E9%BB%92%EF%BC%91%EF%BC%8D%EF%BC%98%EF%BC%8D%EF%BC%91","addressLine2": "%E4%BD%8F%E6%89%80%EF%BC%92%E3%82%A2%E3%83%AB%E3%82%B3%E3%80%80%EF%BC%B4%EF%BC%AF%EF%BC%B7%EF%BC%A5%EF%BC%B2","addressLine3":"%E4%BD%8F%E6%89%80%EF%BC%93%E3%81%97%E3%81%91%E3%82%93%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE","name":"%E3%82%A2%E3%83%9E%E3%82%BE%E3%83%B3%E3%80%80%E5%A4%AA%E9%83%8E","stateOrRegion": "%E6%9D%B1%E4%BA%AC%E9%83%BD","countryCode": "JP","postalCode":"153-0064","phoneNumber": "%EF%BC%90%EF%BC%93%EF%BC%91%EF%BC%92%EF%BC%93%EF%BC%94%EF%BC%99%EF%BC%98%EF%BC%97%EF%BC%96"}}';
    //お支払い方法のみの場合(productType: 'PayOnly')
    //住所情報を連携できない為、下記Payloadをご利用下さい。必要に応じて、Payloadの決済情報(paymentDetails)を変更して下さい。
    //$payload = '{"storeId":"amzn1.application-oa2-client.XXXXXXX","webCheckoutDetails":{"checkoutResultReturnUrl":"https://XXXXXXX/php/result_return_apb.php","checkoutMode": "ProcessOrder"},"paymentDetails":{"paymentIntent":"Authorize","chargeAmount":{"amount":"321","currencyCode":"JPY"}}}';
    $signature = $client->generateButtonSignature($payload);
    echo $signature . "\n";
?>