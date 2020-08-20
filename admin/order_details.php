<?php require_once("includes/header.php"); ?>
<?php require_once("includes/sidebar.php"); ?>
<?php require_once("includes/content_top.php"); ?>

<?php

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}


$order = Orders::find_by_bestelnummer($_GET['id']);
$order_products = Order_products::find_the_key($order->id);
?>

<?php include ("../templates/order_details_template.php")?>

<?php require_once("includes/footer.php"); ?>
