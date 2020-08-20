<?php
include("includes/header.php");

$product = Product::find_by_id($_GET['id']);

$specific_products = Specific_product::find_the_key($product->id);



if (isset($_POST['submit'])){
    if (!isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }

    $order_product = array();
    array_push($order_product, $product->id, $_POST['attribute_value'] );
    $_SESSION["cart"][] = $order_product;
}

?>
<main>
    <div class="product_details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img class="img-fluid" src="<?php echo $product->image_path_and_placeholder_front(); ?>" alt="">
                </div>
                <div class="col-lg-6 pt-6">
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


                                    if ($specific_product->attribute_id != 0){
                                        $attribute = Attributes::find_by_id($specific_product->attribute_id);
                                        $specific_attributes[]= $attribute;
                                    }
                            }



                            foreach ($specific_attributes as $specific_attribute):
                            ?>

                            <tr>
                                <th><?php echo $specific_attribute->name; ?></th>
                                <td>
                                    <select name="attribute_value[]" id="">
                                        <?php foreach ($specific_attributes_values as $specific_attributes_value) : ?>
                                        <?php if ($specific_attributes_value->attribute_id === $specific_attribute->id){
                                            echo "<option value=\"$specific_attributes_value->id\">" . $specific_attributes_value->name . "</option>";
                                            } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <input type="submit" class="btn btn-primary" name="submit" value="Add To Cart">
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>


<?php include("includes/footer.php"); ?>
