<?php include ("includes/header.php"); ?>

<?php


$order = Orders::find_by_bestelnummer($_GET['id']);
$order_products = Order_products::find_the_key($order->id);

if ($order->customer_id != $_SESSION['user_id']){
    redirect("access_denied");
}
?>


<?php include("templates/order_details_template.php") ?>

<?php include ("includes/footer.php"); ?>
