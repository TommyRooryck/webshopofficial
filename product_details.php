<?php
include("includes/header.php");

$product = Product::find_by_id($_GET['id']);

$specific_products = Specific_product::find_the_key($product->id);


if (isset($_POST['submit'])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    if ($_POST['text']){
        $text_attribute = Attributes::find_by('name', 'Text');
        $new_attribute_value = new Attribute_values();
        $new_attribute_value->name = $_POST['text'];
        $new_attribute_value->attribute_id = $text_attribute->id;
        $new_attribute_value->save();

        array_push($_POST['attribute_value'], $new_attribute_value->id);
    }

    $quantity = $_POST['quantity'];
    $y = 0;
    for ($x = 0; $x < $quantity; $x++) {
        $order_product = array();

        array_push($order_product, $product->id, $_POST['attribute_value']);
        $_SESSION["cart"][] = $order_product;
        $y++;
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
                        <img class="img-fluid product-details-image" src="<?php echo $product->image_path_and_placeholder_front(); ?>" alt="">
                    </div>
                    <div class="col-12">
                        <div class="col-lg-6 m-auto">
                            Description: <br>
                            <?php
                            if ($product->description){
                                echo $product->description;
                            } else{
                                echo "No description available";
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 text-center pt-6 m-auto">
                    <h1><?php echo $product->name; ?></h1>
                    <h3>€<?php echo $product->price; ?></h3>
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
                                    <td>
                                        <select name="attribute_value[]" class="form-control" id="">
                                            <?php foreach ($specific_attributes_values as $specific_attributes_value) : ?>
                                                <?php if ($specific_attributes_value->attribute_id === $specific_attribute->id) {
                                                    echo "<option value=\"$specific_attributes_value->id\">" . $specific_attributes_value->name . "</option>";
                                                } ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                    <?php endif; ?>

                            <?php endforeach; ?>
                            <tr>
                                <th><label for="quantity">Quantity</label></th>
                                <td><input type="number" name="quantity" class="form-control" min="<?php if ($product->stock > 0){echo "1";} else{echo "0";} ?>" max="<?php echo $product->stock; ?>" value="<?php if ($product->stock > 0){echo "1";} else{echo "0";} ?>" ></td>
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
