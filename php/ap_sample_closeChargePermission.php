<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $charge_permission_id = $_POST['charge_permission_id'];
    $closure_reason = $_POST['closure_reason'];
    $cancel_pending_charges = $_POST['cancel_pending_charges'];

    $payload = array(
        'closureReason' => $closure_reason,
        'cancelPendingCharges' => $cancel_pending_charges
    );

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->closeChargePermission($charge_permission_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }