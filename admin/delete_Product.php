<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

if (empty($_GET['id'])){
    redirect('users.php');
}

$product = Product::find_by_id($_GET['id']);
$photos = Photo::find_the_key($_GET['id']);
$specific_products = Specific_product::find_the_key($_GET['id']);
if ($product){
     $product->delete_product();
    foreach ($photos as $photo){
        $photo->delete_photo();
    }
    foreach ($specific_products as $specific_product){
        $specific_product->delete();
    }
     redirect('products');
} else{
    redirect('products');
}
?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content_top.php"); ?>
    <h1>Welkom delete pagina</h1>
<?php include ("includes/footer.php");
