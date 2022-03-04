<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $charge_permission_id = $_POST['charge_permission_id'];
    $charge_amount = $_POST['charge_amount'];
    $charge_currency_code = $_POST['charge_currency_code'];
    $capture_now = $_POST['capture_now'];
    $can_handle_pending_authorization = $_POST['can_handle_pending_authorization'];
    $soft_descriptor = $_POST['soft_descriptor'];
    $merchant_metadata_merchantReferenceId = $_POST['merchant_metadata_merchantReferenceId'];
    $idempotency_key = $_POST['idempotency_key'];

    $payload = array(
        'chargePermissionId' => $charge_permission_id,
        'chargeAmount' => array( 
            'amount' => $charge_amount,
            'currencyCode' => $charge_currency_code
        ),
        'captureNow' => $capture_now,
        'canHandlePendingAuthorization' => $can_handle_pending_authorization
    );
    if (null != $merchant_metadata_merchantReferenceId) {
        $payload = array_merge($payload, array(
            "merchantMetadata" => array(
                "merchantReferenceId"=> $merchant_metadata_merchantReferenceId
                )
            )
        );
    }
    if (null != $soft_descriptor) {
        $payload = array_merge($payload, array("softDescriptor" => $soft_descriptor));
    }

    try {
        $headers = array('x-amz-pay-Idempotency-Key' => $idempotency_key);
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->createCharge($payload, $headers);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }