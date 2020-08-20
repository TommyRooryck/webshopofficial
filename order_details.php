<?php

use Mollie\Api\Exceptions\ApiException;

include ("includes/header.php");





try {
    require "vendor/mollie/mollie-api-php/examples/initialize.php";
    $order = Orders::find_by_bestelnummer($_GET['id']);
    $customer = Customer::find_by_id($order->customer_id);
    if (isset($_SESSION['user_id'])){
        if ($_SESSION['user_id'] !== $customer->id){
            redirect("access_denied");

        }
    }

    $order_products = Order_products::find_the_key($order->id);

    $payment =  $payment = $mollie->payments->get($order->payment_id);

    $status = $payment->status;
    $order->status = $status;
    $order->save();

    include ("templates/order_details_template.php");


} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}




include ("includes/footer.php");








