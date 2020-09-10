<?php

use Mollie\Api\Exceptions\ApiException;


$cookie_name = "order{$_GET['id']}";
$cookie_value = "visited";
$official_cookie_name = str_replace('.', '_', $cookie_name);




include("includes/header.php");

if (isset($_COOKIE["{$official_cookie_name}"])){
    redirect("index");
} else{
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    try {
        require "vendor/mollie/mollie-api-php/examples/initialize.php";
        $order = Orders::find_by_bestelnummer($_GET['id']);
        $customer = Customer::find_by_id($order->customer_id);



        $order_products = Order_products::find_the_key($order->id);
        $payment = $payment = $mollie->payments->get($order->payment_id);

        $status = $payment->status;
        $order->status = $status;
        $order->save();

        if ($order->status == "paid") {
            $order->order_status_id = 1;
        }


        include("templates/order_details_template.php");



        if ($order->status == "paid") {
            $order->order_status_id = 1;
            $order->save();
            $all_products = unserialize($order->products);
            foreach ($all_products as $all_product) {
                $product_id = array_shift($all_product);
                $product = Product::find_by_id($product_id);
                $total_stock = $product->stock - 1;
                $product->stock = $total_stock;
                $product->save();
                foreach ($all_product as $values) {
                    foreach ($values as $value) {
                        $attribute_value = Attribute_values::find_by_id($value);
                        $attribute = Attributes::find_by_id($attribute_value->attribute_id);

                        if ($attribute->name === "Kleur"){
                            $specific_products = Specific_product::find_specific_product_attribute_value($attribute_value->id, $product_id);
                            foreach ($specific_products as $specific_product){
                                $specific_product->quantity = $specific_product->quantity - 1;
                                $specific_product->save();
                            }
                        }
                    }
                }
            }
            include ("templates/mail/order_confirmation_mail.php");
        }

        include("includes/footer.php");




    } catch (ApiException $e) {
        echo "API call failed: " . htmlspecialchars($e->getMessage());
    }

}











