<?php include ("includes/header.php"); ?>

<?php

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$attribute_value = Attribute_values::find_by_id($_GET['id']);

if ($attribute_value){
    $attribute_value->delete();
    redirect("edit_attribute?id=" . $_GET['attribute']);
}

?>

<?php include ("includes/footer.php"); ?>
