<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}

if (empty($_GET['id'])){
    redirect('users.php');
}

$product = Product::find_by_id($_GET['id']);
$photos = Photo::find_the_key($_GET['id']);
if ($product){
     $product->delete_product();
    foreach ($photos as $photo){
        $photo->delete_photo();
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
