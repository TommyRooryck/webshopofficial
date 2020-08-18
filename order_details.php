<?php

use Mollie\Api\Exceptions\ApiException;

include  ("admin/includes/init.php");





try {
    require "vendor/mollie/mollie-api-php/examples/initialize.php";
    $order = Orders::find_by_id($_GET['id']);
    $payment =  $payment = $mollie->payments->get($order->payment_id);
    $status = $payment->status;
    $order->status = $status;
    $order->save();


    echo "<p>Your payment status is '" . htmlspecialchars($status) . "'.</p>";


} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}







