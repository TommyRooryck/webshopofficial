<?php
include ("includes/header.php");

$sub_category = Sub_category::find_by_id($_GET['id']);
if ($sub_category){
    $sub_category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
