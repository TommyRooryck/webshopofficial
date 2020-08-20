<?php include ("includes/header.php");?>

<?php

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$category = Category::find_by_id($_GET['id']);
$msg = "";


if (isset($_POST['edit'])){
    if ($category){
        $category->name = trim($_POST['category_name']);
        $category->description = trim($_POST['category_description']);
        $category->save();
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
            <h1 class="text-center pt-5">Category</h1>
            <hr>
            <div>
                <h5 class="text-danger"><?php $msg; ?></h5>
            </div>
            <form method="post" action="edit_Category.php?id=<?php echo $category->id; ?>">
                <div class="form-group">
                    <label for="sub_category_name">Sub Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="<?php echo $category->name; ?>">
                </div>
                <div class="form-group">
                    <label for="sub_category_description">Sub Category Name</label>
                    <textarea name="category_description" cols="30" rows="10" class="form-control"><?php echo $category->description; ?></textarea>
                </div>
                <button type="submit" name="edit" class="btn btn-success float-right">Edit Category</button>
            </form>
        </div>
    </div>

    <?php include ("includes/footer.php");?>

