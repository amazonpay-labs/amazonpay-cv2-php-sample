<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $charge_permission_id = $_POST['charge_permission_id'];
    $merchant_metadata_merchantReferenceId = $_POST['merchant_metadata_merchantReferenceId'];
    $merchant_metadata_merchantStoreName = $_POST['merchant_metadata_merchantStoreName'];
    $merchant_metadata_noteToBuyer = $_POST['merchant_metadata_noteToBuyer'];
    $merchant_metadata_customInformation = $_POST['merchant_metadata_customInformation'];
    $recurringMetadata_frequency_unit = $_POST['recurringMetadata_frequency_unit'];
    $recurringMetadata_frequency_value = $_POST['recurringMetadata_frequency_value'];
    $recurringMetadata_amount_amount = $_POST['recurringMetadata_amount_amount'];
    $recurringMetadata_amount_currencyCode = $_POST['recurringMetadata_amount_currencyCode'];
    $platform_id = $_POST['platform_id'];

    $payload = array(
        'merchantMetadata' => array(
            'merchantReferenceId' => $merchant_metadata_merchantReferenceId,
            'merchantStoreName' => $merchant_metadata_merchantStoreName,
            'noteToBuyer' => $merchant_metadata_noteToBuyer,
            'customInformation' => $merchant_metadata_customInformation
        )

    );
    if (null != $recurringMetadata_frequency_unit) {
        $payload = array_merge($payload, array(
            'recurringMetadata' => array(
                'frequency' => array(
                    'unit' => $recurringMetadata_frequency_unit,
                    'value' => $recurringMetadata_frequency_value
                )
            )
        ));
    }
    if (null != $recurringMetadata_amount_amount) {
        $payload = array_merge($payload, array(
        'recurringMetadata' => array(
                'amount' => array(
                    'amount' => $recurringMetadata_amount_amount,
                    'currencyCode' => $recurringMetadata_amount_currencyCode
                )
            )
        ));
    }

    if (null != $platform_id) {
        $payload = array_merge($payload, array("platformId" => $platform_id));
    }

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->updateChargePermission($charge_permission_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }