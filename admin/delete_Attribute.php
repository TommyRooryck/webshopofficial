<?php include ("includes/header.php"); ?>

<?php

$attribute = Attributes::find_by_id($_GET['id']);
$attribute_values = Attribute_values::find_the_key($_GET['id']);

if ($attribute){
    foreach ($attribute_values as $attribute_value){
        $attribute_value->delete();
    }
    $attribute->delete();
    redirect("attributes");
}

?>

<?php include ("includes/footer.php"); ?>
