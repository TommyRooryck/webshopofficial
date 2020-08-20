<?php
include ("includes/header.php");

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$sub_category = Sub_category::find_by_id($_GET['id']);
if ($sub_category){
    $sub_category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
