<?php
include ("includes/header.php");

$category = Category::find_by_id($_GET['id']);
if ($category){
    $category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
