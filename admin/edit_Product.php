<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<?php

if (!$session->is_signed_in()) {
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied");
}

if (empty($_GET['id'])) {
    redirect("products");
}

$product = Product::find_by_id($_GET['id']);
$category = Category::find_by_id($product->category_id);
$sub_category = Sub_category::find_by_id($product->sub_category_id);
$categories = Category::find_all();
$sub_categories = Sub_category::find_all();
$attributes = Attributes::find_all();

$specific_products = Specific_product::find_the_key($product->id);


if (isset($_POST['submit'])) {

    $all_color_quantity= array();
    $all_color_quantity = array_filter($_POST['color_quantity']);
    $all_color_quantity = array_values($all_color_quantity);
    if (array_sum($all_color_quantity) == trim($_POST['stock'])){
        $product->name = trim($_POST['name']);
        $product->description = trim($_POST['desc']);
        $product->price = trim($_POST['price']);
        $product->stock = trim($_POST['stock']);
        $product->created_at = date("Y/m/d");
        $product->category_id = trim($_POST['category']);
        $product->sub_category_id = trim($_POST['sub']);
        $product->save_image();
        $product->save();
        Photo::set_files_product($_FILES['file'], $product->id);


        foreach ($specific_products as $specific_product) {
            $specific_product->delete();
        }

        if (isset($_POST['attribute_value'])) {
            $all_values = count($_POST['attribute_value']);
            $all_attributes = array();
            $all_attributes = $_POST['attribute'];

            for ($i = 0; $i < $all_values; $i++) {
                $specific_product = new Specific_product();

                if (array_key_exists($i,$all_attributes)) {
                    $specific_product->attribute_id = trim($_POST['attribute'][$i]);
                }
                $specific_product->attribute_values_id = trim($_POST['attribute_value'][$i]);
                $specific_product->product_id = $product->id;

                if (array_key_exists($i,$all_color_quantity)) {
                    $specific_product->quantity = $all_color_quantity[$i];
                }

                $specific_product->save();
            }
        }

        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products successfully edited!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } elseif (empty($all_color_quantity)){
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


        if (isset($_POST['attribute_value'])) {
            $all_values = count($_POST['attribute_value']);
            $all_attributes = array();
            $all_attributes = $_POST['attribute'];

            for ($i = 0; $i < $all_values; $i++) {
                $specific_product = new Specific_product();

                if (array_key_exists($i,$all_attributes)) {
                    $specific_product->attribute_id = trim($_POST['attribute'][$i]);
                }
                $specific_product->attribute_values_id = trim($_POST['attribute_value'][$i]);
                $specific_product->product_id = $product->id;

                if (array_key_exists($i,$all_color_quantity)) {
                    $specific_product->quantity = $all_color_quantity[$i];
                }

                $specific_product->save();
            }
        }

        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products successfully edited!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } else{
        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
                    <strong>Color quantity does not match total product quantity!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    }
//    redirect("products");

}
?>



<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <h1 class="text-center">Edit Product</h1>
            <form action="edit_Product.php?id=<?php echo $product->id; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $product->name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control" cols="30"
                                      rows="10"><?php echo $product->description; ?> </textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="placeholder">Product Image</label> <br>
                            <img src=" <?php echo $product->image_path_and_placeholder(); ?>" id="placeholder_img"
                                 alt="">
                            <input type="file" name="placeholder" id="imgInp" class="form-control-file pt-3">

                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $product->price; ?>">
                        </div>


                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control"
                                   value="<?php echo $product->stock; ?>">
                        </div>

                        <div class="form-group">
                            <label for="category">Select category</label>
                            <select name="category" class="form-control">
                                <option value="<?php echo $category->id ?>"
                                        style='background: #cfe3f1'><?php echo $category->name; ?></option>
                                <?php foreach ($categories as $category_option) : ?>
                                    <option value="<?php echo $category_option->id; ?>"><?php echo $category_option->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub">Select Sub Category (if needed)</label>
                            <select name="sub" class='form-control'>
                                <?php
                                if ($sub_category->id == 0) {
                                    echo "   <option value=\"0\">None</option>";
                                } else {
                                    echo " <option value=\"$sub_category->id>\"  style='background: #cfe3f1'> $sub_category->name </option>";
                                }
                                ?>
                                <option value="0">None</option>
                                <?php foreach ($sub_categories as $sub_category_option) : ?>
                                    <option value="<?php echo $sub_category_option->id; ?>"><?php echo $sub_category_option->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <?php
                            $y = 0;
                            usort($attributes, array("Attributes", "order_by_name"));
                            foreach ($attributes

                            as $attribute) :
                            $specific_attribute = Specific_product::find_specific_product_attribute($attribute->id, $product->id);
                            ?>
                            <div class="form-group">
                                <?php if ($attribute->name === "Text"): ?>
                                    <label for="attribute[]"><h5><?php echo $attribute->name; ?></h5>
                                    </label>
                                    <input type="checkbox"
                                           value="<?php echo $attribute->id; ?>"
                                           name="attribute[]"
                                        <?php
                                        if ($specific_attribute) {
                                            echo "checked";
                                        }
                                        ?> >

                                <?php else: ?>

                                <label for="attribute[]"><h5><?php echo $attribute->name; ?></h5>
                                </label>
                                <input type="checkbox"
                                       value="<?php echo $attribute->id; ?>"
                                       name="attribute[]"
                                    <?php
                                    if ($specific_attribute) {
                                        echo "checked";
                                    }
                                    ?> data-toggle="collapse" data-target="#collapse<?php echo $y; ?>"">
                                <div
                                        class="
                                            row
                                            values
                                            collapse
                                             <?php
                                        if ($specific_attribute) {
                                            echo "show";
                                        }
                                        ?>
                                            "
                                        id="collapse<?php echo $y; ?>">
                                    <?php
                                    $attribute_values = Attribute_values::find_the_key($attribute->id);
                                    usort($attribute_values, array("Attribute_values", "order_by_name"));

                                    foreach ($attribute_values

                                    as $attribute_value) :
                                    $specific_attribute_value = Specific_product::find_specific_product_attribute_value($attribute_value->id, $product->id);

                                    ?>
                                    <?php if ($attribute->name === "Kleur") : ?>
                                    <table class="table table-hover">
                                        <tr>
                                            <th class="col-4"><label
                                                        for="attribute_value[]"><?php echo $attribute_value->name; ?></label>
                                            </th>
                                            <td class="col-4">
                                                <?php if ($specific_attribute_value): ?>
                                                <?php foreach ($specific_attribute_value as $specific_product) :?>
                                                        <input type="number" name="color_quantity[]" min="0"
                                                               value="<?php
                                                               echo $specific_product->quantity;  ?>" >
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                    <input type="number" min="0" name="color_quantity[]">
                                                <?php endif; ?>
                                            </td>

                                            <td class="col-4">
                                                <input
                                                        type="checkbox"
                                                        name="attribute_value[]"
                                                        value="<?php echo $attribute_value->id; ?>"
                                                    <?php

                                                    if ($specific_attribute_value) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                >
                                            </td>
                                        </tr>
                                    </table>
                                    <?php else: ?>
                                    <table class="table table-hover">
                                        <tr>
                                            <th class="col-6"><label
                                                        for="attribute_value[]"><?php echo $attribute_value->name; ?></label>
                                            </th>
                                            <td class="col-6">
                                                <input
                                                        type="checkbox"
                                                        name="attribute_value[]"
                                                        value="<?php echo $attribute_value->id; ?>"
                                                    <?php

                                                    if ($specific_attribute_value) {
                                                        echo "checked";
                                                    }
                                                    ?>
                                                >
                                            </td>
                                        </tr>
                                    </table>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php
                        $y++;
                        endif;
                        endforeach; ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 d-flex flex-wrap">
                                <?php
                                $photos = Photo::find_the_key($product->id);
                                foreach ($photos as $photo) :
                                    ?>
                                    <div class="col-lg-4 col-md-4 col-6 text-center">
                                        <img src="<?php echo $photo->picture_path(); ?>"
                                             class="p-3 img-fluid preview-img" alt="">
                                        <a onclick=""
                                           href="delete_Photo_Product.php?id=<?php echo $photo->id; ?>&product=<?php echo $product->id; ?>"><i
                                                    class="far fa-trash-alt fa-lg"></i></a>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="upload[]">More Photos: </label>
                            <input type="file" name="file[]" id="gallery-photo-add" multiple="multiple"
                                   class="form-control-file">
                            <div class="gallery">

                            </div>
                        </div>
                        <input type="submit" name="submit" value="Update Product"
                               class="btn btn-primary mb-5 float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
