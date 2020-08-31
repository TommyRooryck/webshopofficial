<?php

$first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8');
$last_name = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
$adress = htmlspecialchars(trim($_POST['adress']), ENT_QUOTES, 'UTF-8');
$city = htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');
$postal_code = htmlspecialchars(trim($_POST['postal_code']), ENT_QUOTES, 'UTF-8');
$region = htmlspecialchars(trim($_POST['region']), ENT_QUOTES,  'UTF-8');
$country = htmlspecialchars(trim($_POST['country']), ENT_QUOTES, 'UTF-8');

if ($customer){
    $customer->first_name = $first_name;
    $customer->last_name = $last_name;
    $customer->email = $email;
    $customer->phone = $phone;
    $customer->adress = $adress;
    $customer->postal_code = $postal_code;
    $customer->city = $city;
    $customer->region = $region;
    $customer->country = $country;

    if (isset($_POST['shipping_adress_check'])){
        $shipping_adress = htmlspecialchars(trim($_POST['shipping_adress']), ENT_QUOTES, 'UTF-8');
        $shipping_city = htmlspecialchars(trim($_POST['shipping_city']), ENT_QUOTES, 'UTF-8');
        $shipping_postal_code = htmlspecialchars(trim($_POST['shipping_postal_code']), ENT_QUOTES, 'UTF-8');
        $shipping_region = htmlspecialchars(trim($_POST['shipping_region']), ENT_QUOTES, 'UTF-8');
        $shipping_country = htmlspecialchars(trim($_POST['shipping_country']));

        $customer->shipping_adress = $shipping_adress;
        $customer->shipping_postal_code = $shipping_city;
        $customer->shipping_city = $shipping_postal_code;
        $customer->shipping_region = $shipping_region;
        $customer->shipping_country = $shipping_country;

    } else{
        $customer->shipping_adress = $adress;
        $customer->shipping_postal_code = $postal_code;
        $customer->shipping_city = $city;
        $customer->shipping_region = $region;
        $customer->shipping_country = $country;
    }

    $customer->save();
} else{
    $msg = "There was an error updating - check error";
}


?>