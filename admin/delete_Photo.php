<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

if (empty($_GET['id'])){
    redirect('photos');
}

$photo = Photo::find_by_id($_GET['id']);
if ($photo){
    $photo->delete_photo();
    redirect('photos');
} else{
    redirect('photos');
}
?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content-top.php"); ?>
<?php include ("includes/footer.php");
