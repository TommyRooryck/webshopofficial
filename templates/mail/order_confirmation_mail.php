<?php
$shipping_zones = Shipping::find_all();
$order = Orders::find_by_bestelnummer($_GET['id']);
$all_products = unserialize($order->products);
$total_price = 0;
$i = 0;

if ($order->customer_id){
    $customer = Customer::find_by_id($order->customer_id);
}

$email = $order->email;
$email_subject = "Order Confirmation: $order->bestelcode";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";


$message = "
<html>
<body style='text-align: center'>
<h2 style='text-align: center'>Order Confirmation</h2>
<h5 style='text-align: center'>Billing and Shipping Details</h5>
<table rules='all' style='border-color: #666666;' cellpadding='10'>
<tr style='background: #eeeeee;'>
<th>Besteldatum</th>
<th>Factuuradres</th>
<th>Afleveradres</th>
<th>Status</th>
</tr>
<tr>
<td> $order->created_at </td>
<td>
$order->first_name $order->last_name <br>
$order->adress <br>
$order->postal_code $order->city <br>
$order->region $order->country
</td>
<td>
$order->first_name $order->last_name <br>
$order->shipping_adress <br>
$order->shipping_postal_code $order->shipping_city <br>
$order->shipping_region $order->shipping_country
</td>
<td>
$order->status
</td>
</tr>
</table>
<h5 style='text-align: center'>Order Details</h5>
<table rules='all' style='border-color: #666666' cellpadding='10'>
<tr style='background: #eeeeee'>
<th colspan='2'>Product</th>
<th>Price</th>
</tr>
";

foreach ($all_products as $all_product){
    $product_id = array_shift($all_product);
    $product = Product::find_by_id($product_id);

    $message .=
        "<tr>
            <td colspan='2'>
                $product->name <br>
        ";
    foreach ($all_product as $values){
        foreach ($values as $value){
            $attribute_value = Attribute_values::find_by('name', $value);
            $attribute = Attributes::find_by_id($attribute_value->attribute_id);

            $message .= "
            $attribute->name : $attribute_value->name <br>
            ";
        }
        $message .= "<br>";
    }
    $message .= "
    </td>
    <td>
    €
    ";

    $message .=  number_format($product->price,2);
    $total_price += $product->price;

    $message .= "
    </td>
    ";

    $key = array_search("$product->id", $all_product);

    $message .= "</tr>";

    $i++;
}

$message .= "<tr>";

if ($customer && $customer->shipping_country || isset($_SESSION['shipping_country'])){
    $zone_array = array();
    $price_array = array();
    foreach ($shipping_zones as $shipping_zone) {
        $zone = strtolower($shipping_zone->shipping_zone);
        $price = $shipping_zone->shipping_price;
        array_push($zone_array, $zone);
        array_push($price_array, $price);
    }

    if ($customer && $customer->shipping_country) {
        $shipping_zone = strtolower($customer->shipping_country);
    } else {
        $shipping_zone = strtolower($_SESSION['shipping_country']);
    }

    $zone_key = array_search($shipping_zone, $zone_array);

    if ($zone_key !== false){
        $price = $price_array[$zone_key];
        $message .= "<td colspan='2'> Shipping Price: <br> Zone: $order->shipping_country </td> <td>€ ";
        $message .= number_format($price,2);
        $message .= "</td>";
        $total_price += $price;
    }
}

$message .= "
</tr>
<tr>
<th colspan='2' class='text-right'>Total Price:</th>
<td><b>€";

$message .= number_format($total_price,2);

$message .= "
</b></td>
</tr>
</body>
</html>
";



mail($email, $email_subject, $message, $headers);
?>
