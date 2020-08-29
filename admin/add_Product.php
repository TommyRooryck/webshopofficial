<?php include("includes/header.php"); ?>

<?php   include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>

<?php
if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$product = new Product(); //Creëer een niewe instantie van het object user met de naam $user
$message = "";
$placeholder = new Photo();
$attributes = Attributes::find_all();


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



    if (isset($_POST['attribute_value'])){
        $all_values = count($_POST['attribute_value']);
        for ($i = 0; $i < $all_values; $i++) {
            $specific_product = new Specific_product();
            $specific_product->attribute_id = trim($_POST['attribute'][$i]);
            $specific_product->attribute_values_id = trim($_POST['attribute_value'][$i]);
            $specific_product->product_id = $product->id;
            $specific_product->save();

        }
    }

    echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products added to shop!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";

}

?>

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
                            <input type="file" name="placeholder" id="imgInp" class="form-control-file">
                            <img src="#" id="placeholder_img" alt="">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Select category</label>
                            <select name="category" class="form-control">
                                <?php
                                usort($categories, array("Category", "order_by_name"));
                                foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub">Select Sub Category (if needed)</label>
                            <select name="sub" class="form-control">
                                <option value="0">None</option>
                                <?php
                                usort($sub_categories, array("Sub_category", "order_by_name"));
                                foreach ($sub_categories as $sub_category) : ?>
                                    <option value="<?php echo $sub_category->id; ?>"><?php echo $sub_category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="upload[]">More Photos: </label>
                            <input type="file" name="file[]" id="gallery-photo-add" multiple="multiple"
                                   class="form-control-file">
                            <div class="gallery">

                            </div>
                        </div>

                        <?php
                        $y=0;
                        usort($attributes, array("Attributes", "order_by_name"));
                        foreach ($attributes
                                       as $attribute) : ?>
                            <div class="form-group">
                                <label for="attribute[]"><h5><?php echo $attribute->name; ?></h5>
                                </label>
                                <input type="checkbox"
                                       value="<?php echo $attribute->id; ?>"
                                       name="attribute[]" data-toggle="collapse" data-target="#collapse<?php echo $y; ?>"">
                                <div class="row values collapse"  id="collapse<?php echo $y; ?>">
                                    <?php
                                    $attribute_values = Attribute_values::find_the_key($attribute->id);
                                    usort($attribute_values, array("Attribute_values", "order_by_name"));
                                    foreach ($attribute_values

                                             as $attribute_value) :
                                        ?>
                                        <table class="table table-hover">
                                            <tr>
                                                <th class="col-6"><label for="attribute_value[]"><?php echo $attribute_value->name; ?></label></th>
                                                <td class="col-6"><input type="checkbox" name="attribute_value[]" value="<?php echo $attribute_value->id; ?>"></td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php
                        $y++;
                        endforeach; ?>
                        <input type="submit" name="submit" value="Add Product"
                               class="btn btn-primary mb-5 float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>
