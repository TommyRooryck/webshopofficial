<?php
/*
 * How to prepare a new payment with the Mollie API.
 */

include ("admin/includes/init.php");

$order = Orders::find_by_id($_GET['id']);

if (!$order){
    redirect("index");
}



use Mollie\Api\Exceptions\ApiException;

try {
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/dashboard/settings/profiles
     */
    require "vendor/mollie/mollie-api-php/examples/initialize.php";


    $total_price = number_format($order->total_price, 2);

    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "{$total_price}"
        ],
        "description" => "Order {$order->bestelcode}",
        "redirectUrl" => "http://littleblessings.test/order_details?id=" . $order->bestelcode,
        "webhookUrl" =>  " http://b26c09ad5214.ngrok.io/?order_id={$order->bestelcode}",
        "metadata" => [
            "order_id" => $order->bestelcode
    ]
    ]);

    /*
     * In this example we store the order with its payment status in a database.
     */


    $order->payment_id = $payment->id;
    $order->status = $payment->status;
    $order->save();

    /*
     * Send the customer off to complete the payment.
     * This request should always be a GET, thus we enforce 303 http response code
     */
    header("Location: " . $payment->getCheckoutUrl(), true, 303);
} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}


