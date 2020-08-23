<?php


if (isset($_POST['shipping_adress_check'])) {
    if ($customer) {
        $customer->first_name = trim($_POST['first_name']);
        $customer->last_name = trim($_POST['last_name']);
        $customer->email = trim($_POST['email']);
        $customer->phone = trim($_POST['phone']);
        $customer->adress = trim($_POST['adress']);
        $customer->postal_code = trim($_POST['postal_code']);
        $customer->city = trim($_POST['city']);
        $customer->region = trim($_POST['region']);
        $customer->country = trim($_POST['country']);
        $customer->shipping_adress = trim($_POST['shipping_adress']);
        $customer->shipping_postal_code = trim($_POST['shipping_postal_code']);
        $customer->shipping_city = trim($_POST['shipping_city']);
        $customer->shipping_region = trim($_POST['shipping_region']);
        $customer->shipping_country = trim($_POST['shipping_country']);
        $customer->save();
    } else {
        $msg = "There was an error updating - check error";
    }
} else {
    if ($customer) {
        $customer->first_name = trim($_POST['first_name']);
        $customer->last_name = trim($_POST['last_name']);
        $customer->email = trim($_POST['email']);
        $customer->phone = trim($_POST['phone']);
        $customer->adress = trim($_POST['adress']);
        $customer->postal_code = trim($_POST['postal_code']);
        $customer->city = trim($_POST['city']);
        $customer->region = trim($_POST['region']);
        $customer->country = trim($_POST['country']);
        $customer->shipping_adress = trim($_POST['adress']);
        $customer->shipping_postal_code = trim($_POST['postal_code']);
        $customer->shipping_region = trim($_POST['region']);
        $customer->shipping_city = trim($_POST['city']);
        $customer->shipping_country = trim($_POST['country']);
        $customer->save();
    } else {
        $msg = "There was an error updating - no check error";
    }
}


?>