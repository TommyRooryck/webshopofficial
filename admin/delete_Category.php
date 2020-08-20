<?php
include ("includes/header.php");

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$category = Category::find_by_id($_GET['id']);
$sub_categories = Sub_category::find_the_key($_GET['id']);
if ($category){
    foreach ($sub_categories as $sub_category){
        $sub_category->delete();
    }
    $category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
