<?php

include("includes/header.php");


if (!$session->is_signed_in()) {
    redirect("login.php");
}

$product = new Product(); //Creëer een niewe instantie van het object user met de naam $user
$message = "";
$placeholder = new Photo();



$categories = Category::find_all();
$sub_categories = Sub_category::find_all();

if (isset($_POST['submit'])) {
    $product->name = trim($_POST['name']);
    $product->description = trim($_POST['desc']);
    $product->price = trim($_POST['price']);
    $product->stock = trim($_POST['stock']);
    $product->created_at = date("Y/m/d");
    $product->category_id = trim($_POST['category']);
    $product->sub_category_id = trim($_POST['sub']);
    $product->set_file($_FILES['placeholder']);
    $product->create_image();
    $product->save();



    Photo::set_files_product($_FILES['file'], $product->id);

    redirect("products");


}

?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <h1 class="pt-5">Add Product</h1>
            <form action="add_Product.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="placeholder">Product Image</label>
                            <input type="file" name="placeholder" id="imgInp" class="form-control">
                            <img src="#" id="placeholder_img" alt="">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" name="stock" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Select category</label>
                            <select name="category">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub">Select Sub Category (if needed)</label>
                            <select name="sub">
                                <option value="0">None</option>
                                <?php foreach ($sub_categories as $sub_category) : ?>
                                    <option value="<?php echo $sub_category->id; ?>"><?php echo $sub_category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="upload[]">More Photos: </label>
                            <input type="file" name="file[]" id="gallery-photo-add" multiple="multiple" class="form-control-file">
                            <div class="gallery">

                            </div>
                        </div>
                        <input type="submit" name="submit" value="Add Product" class="btn btn-primary mb-5 float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
