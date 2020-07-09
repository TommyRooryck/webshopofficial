<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login');
}

if (empty($_GET['id'])){
    redirect('photos');
}

$photo = Photo::find_by_id($_GET['id']);
$product_id = $_GET['product'];

if ($photo){
    $photo->delete_photo();
    redirect("edit_Product.php?id=$product_id");
}
?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content-top.php"); ?>
<?php include ("includes/footer.php");
