<?php
include("includes/header.php");

$product_id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
$photos = Photo::find_the_key($product_id);

if (Product::find_by_id($product_id)) {
    $product = Product::find_by_id($product_id);
    $specific_products = Specific_product::find_the_key($product->id);
} else {
    redirect('shop');
}

if (isset($_POST['submit'])) {


    if (isset($_POST['text'])) {
        $text_attribute = Attributes::find_by('name', 'Text');
        $text = htmlspecialchars(trim($_POST['text']), ENT_QUOTES, 'UTF-8');
        $new_attribute_value = new Attribute_values();
        $new_attribute_value->name = $text;
        $new_attribute_value->attribute_id = $text_attribute->id;
        $new_attribute_value->save();

        array_push($_POST['attribute_value'], $new_attribute_value->id);
    }

    $quantity = $_POST['quantity'];
    $y = 0;
    $safe_array = array();

    foreach ($_POST['attribute_value'] as $value) {
        $safe_value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        if (Attribute_values::find_by('id', $safe_value)) {
            array_push($safe_array, $safe_value);
        } else {
            redirect('shop');
        }
    }

    $total_attributes = count($_POST['attribute_value']);
    $total_safe_attributes = count($safe_array);


    if ($total_attributes == $total_safe_attributes) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        for ($x = 0; $x < $quantity; $x++) {
            $order_product = array();
            array_push($order_product, $product->id, $safe_array);
            $_SESSION["cart"][] = $order_product;
            $y++;
        }
    } else {
        redirect('shop');
    }


    if ($y == $_POST['quantity']) {
        $message = "Items added to cart";
        echo "
         <div class='row align-content-center justify-content-center w-100'>
             <div class='col-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products added to cart!</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } else {

        echo "
        <div class='alert alert-danger alert-dismissible fade show text-center w-50' role='alert'>
        <strong>Failed to add products to cart. Please try again or contact support. </strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        </div>
        ";

    }

}

?>
<main>
    <div class="product_details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="col-12 text-center">
                        <img id="placeholder" class="img-fluid product-details-image"
                             src="<?php echo $product->image_path_and_placeholder(); ?>" alt="">
                        <img id="expandedImg" class="img-fluid product-details-image">
                    </div>
                    <div class="col-12">
                        <div class="row m-auto">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="col-lg-1">
                                    <img class="img-gallery" onclick="myFunction(this);" src=" <?php echo $product->image_path_and_placeholder();?>" alt="">
                                </div>
                            <?php foreach ($photos as $photo) : ?>
                            <div class="col-lg-1">
                                <img class="img-gallery" onclick="myFunction(this);" src=" <?php echo $photo->picture_path();?>" alt="">
                            </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 m-auto">
                                Description: <br>
                                <?php
                                if ($product->description) {
                                    echo $product->description;
                                } else {
                                    echo "No description available";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center pt-6 m-auto">
                    <h1><?php echo $product->name; ?></h1>
                    <h3>€<?php echo number_format($product->price, 2) ?></h3>
                    <form action="" method="post">
                        <table class="table table-hover">
                            <?php

                            $specific_attributes_values = array();
                            $specific_attributes = array();

                            foreach ($specific_products as $specific_product) {
                                $attribute_value = Attribute_values::find_by_id($specific_product->attribute_values_id);
                                $specific_attributes_values[] = $attribute_value;


                                if ($specific_product->attribute_id != 0) {
                                    $attribute = Attributes::find_by_id($specific_product->attribute_id);
                                    $specific_attributes[] = $attribute;
                                }
                            }


                            foreach ($specific_attributes as $specific_attribute):
                                ?>
                                <?php if ($specific_attribute->name == 'Text') : ?>
                                <tr>
                                    <th><?php echo $specific_attribute->name; ?></th>
                                    <td>
                                        <textarea name="text" class="form-control" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                <th><?php echo $specific_attribute->name; ?></th>
                                <?php if ($specific_attribute->name === "Kleur"): ?>
                                    <td>
                                        <select name="attribute_value[]" class="form-control" id="">
                                            <?php foreach ($specific_attributes_values as $specific_attributes_value) : ?>
                                                <?php if ($specific_attributes_value->attribute_id === $specific_attribute->id): ?>
                                                  <?php  $specific_products = Specific_product::find_specific_product_attribute_value($specific_attributes_value->id, $product_id); ?>
                                                    <option <?php foreach ($specific_products as $specific_product) {if ($specific_product->quantity == 0){echo "disabled";}} ?>
                                                            value="<?php echo $specific_attributes_value->id ?>"> <?php echo $specific_attributes_value->name ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <select name="attribute_value[]" class="form-control" id="">
                                            <?php foreach ($specific_attributes_values as $specific_attributes_value) : ?>
                                                <?php if ($specific_attributes_value->attribute_id === $specific_attribute->id): ?>
                                                    $specific_product = Specific_product::find_specific_product_attribute_value($specific_attributes_value->id, $product_id);
                                                    <option <?php ?>
                                                            value="<?php echo $specific_attributes_value->id ?>"> <?php echo $specific_attributes_value->name ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <tr>
                                <th><label for="quantity">Quantity</label></th>
                                <td><input type="number" name="quantity" class="form-control"
                                           min="<?php if ($product->stock > 0) {
                                               echo "1";
                                           } else {
                                               echo "0";
                                           } ?>" max="<?php echo $product->stock; ?>"
                                           value="<?php if ($product->stock > 0) {
                                               echo "1";
                                           } else {
                                               echo "0";
                                           } ?>"></td>
                            </tr>
                        </table>
                        <?php if ($product->stock > 0): ?>
                            <input type="submit" class="btn btn-primary float-right" name="submit" value="Add To Cart">
                        <?php else: ?>
                            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                                <strong>Sorry, product is out of stock</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>


<?php include("includes/footer.php"); ?>
