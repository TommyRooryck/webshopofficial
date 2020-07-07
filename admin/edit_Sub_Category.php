<?php include ("includes/header.php");?>

<?php

$sub_category = Sub_category::find_by_id($_GET['id']);
$msg = "";


if (isset($_POST['edit'])){
    if ($sub_category){
        $sub_category->name = trim($_POST['sub_category_name']);
        $sub_category->description = trim($_POST['sub_category_description']);
        $sub_category->save();
        redirect("categories.php");
    } else{
        $msg = "Update Failed";
    }
}
?>

<?php include "includes/sidebar.php"; ?>
<?php include "includes/content_top.php"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="text-center pt-5"> Sub Category</h1>
            <hr>
            <div>
                <h5 class="text-danger"><?php $msg; ?></h5>
            </div>
            <form method="post">
                <div class="form-group">
                    <label for="sub_category_name">Sub Category Name</label>
                    <input type="text" name="sub_category_name" class="form-control" value="<?php echo $sub_category->name; ?>">
                </div>
                <div class="form-group">
                    <label for="sub_category_description">Sub Category Name</label>
                    <textarea name="sub_category_description" cols="30" rows="10" class="form-control"><?php echo $sub_category->description; ?></textarea>
                </div>
                <button type="submit" name="edit" class="btn btn-success float-right">Edit Sub Category</button>
            </form>
        </div>
    </div>

<?php include ("includes/footer.php");?>

