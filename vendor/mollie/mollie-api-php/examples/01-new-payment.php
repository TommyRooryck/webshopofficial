<?php
/*
 * How to prepare a new payment with the Mollie API.
 */

include ("../../../../admin/includes/init.php");

$order = Orders::find_by_id($_GET['id']);



use Mollie\Api\Exceptions\ApiException;

try {
    /*
     * Initialize the Mollie API library with your API key.
     *
     * See: https://www.mollie.com/dashboard/settings/profiles
     */
    require "./initialize.php";

    /*
     * Generate a unique order id for this example. It is important to include this unique attribute
     * in the redirectUrl (below) so a proper return page can be shown to the customer.
     */
    $orderId = $order->id;


    /*
     * Determine the url parts to these example files.
     */
    /*
     * Payment parameters:
     *   amount        Amount in EUROs. This example creates a € 10,- payment.
     *   description   Description of the payment.
     *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
     *   webhookUrl    Webhook location, used to report when the payment changes state.
     *   metadata      Custom metadata that is stored with the payment.
     */
    $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "{$order->total_price}"
        ],
        "description" => "Order #{$orderId}",
        "redirectUrl" => "{$protocol}://{$hostname}{$path}/orders/03-return-page.php?order_id={$orderId}",
    ]);

    /*
     * In this example we store the order with its payment status in a database.
     */
    $order->payment_id = $payment->id;

    /*
     * Send the customer off to complete the payment.
     * This request should always be a GET, thus we enforce 303 http response code
     */
    header("Location: " . $payment->getCheckoutUrl(), true, 303);
} catch (ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

/*
 * NOTE: This example uses a text file as a database. Please use a real database like MySQL in production code.
 */
function database_write($orderId, $status)
{
    $orderId = intval($orderId);
    $database = dirname(__FILE__) . "/orders/order-{$orderId}.txt";

    file_put_contents($database, $status);
}
