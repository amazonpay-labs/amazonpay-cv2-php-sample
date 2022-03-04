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
    //Recurringでフローをご確認する場合は、chargePermissionType、recurringMetadataの設定をpayloadに加える必要があります。
    //http://amazonpay-integration.amazon.co.jp/amazonpay-faq-v2/detail.html?id=QA-82 もご参考にしてください。
    $payload = '{"storeId":"amzn1.application-oa2-client.XXXXXXX","webCheckoutDetails":{"checkoutReviewReturnUrl":"https://XXXXXXX/review_order_page.html","checkoutResultReturnUrl":"https://XXXXXXX/php/result_return.php"},"scopes":["name","email","phoneNumber","postalCode","shippingAddress","billingAddress"]}';
    $signature = $client->generateButtonSignature($payload);
    echo $signature . "\n";
?>