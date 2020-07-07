<?php
include ("includes/header.php");

$super_category = Super_category::find_by_id($_GET['id']);
if ($super_category){
    $super_category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
