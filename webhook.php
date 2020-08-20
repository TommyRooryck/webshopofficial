<?php
/*
 * Example 2 - How to verify Mollie API Payments in a webhook.
 */

use Mollie\Api\Exceptions\ApiException;

include  ("admin/includes/init.php");



try {
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/dashboard/settings/profiles
     */
    require "vendor/mollie/mollie-api-php/examples/initialize.php";

    /*
     * Retrieve the payment's current state.
     */


    $payment = $mollie->payments->get($_POST["id"]);
    if (!$payment){
        redirect("index");
    }
    $orderId = $payment->metadata->order_id;

    $order = Orders::find_by_bestelnummer($orderId);


    $order->payment_id = $payment;
    $order->save();

    if ($payment->isPaid()) {
        $order->status = "Paid";

    } elseif ($payment->isOpen()) {
        $order->status = "Open";

    } elseif ($payment->isPending()) {
        $order->status = "Pending";

    } elseif ($payment->isFailed()) {
        $order->status = "Failed";

    } elseif ($payment->isExpired()) {
        $order->status = "Expired";

    } elseif ($payment->isCanceled()) {
        $order->status = "Canceled";

    }

    $order->save();



} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}


