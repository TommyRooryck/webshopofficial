<?php
include ("includes/header.php");

$super_category = Super_category::find_by_id($_GET['id']);
$categories = Category::find_the_key($_GET['id']);

if ($super_category){
    foreach ($categories as $category){
        $sub_categories = Sub_category::find_the_key($category->id);
        foreach ($sub_categories as $sub_category){
            $sub_category->delete();
        }
        $category->delete();
    }
    $super_category->delete();
    redirect("categories.php");
} else{
    redirect("categories.php");
}

?>

<?php include ("includes/footer.php"); ?>
