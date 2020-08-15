<?php include("includes/header.php"); ?>


<?php

if (isset($_POST['clear_cart'])) {
    unset($_SESSION["cart"]);
}

if (isset($_GET['delete'])){
    unset($_SESSION['cart'][$_GET['delete']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
        redirect("cart");
}

if (isset($_SESSION["cart"])) :

?>


<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <table class="table table-hover">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Delete</th>
                </tr>

                <?php
                $i = 0;
                $total_price = 0;
                foreach ($_SESSION['cart'] as $cart_product):
                echo "<br>";
                $product_id = array_shift($cart_product);
                $product = Product::find_by_id($product_id);
                ?>

                <tr>
                    <td>
                        <?php
                            echo $product->name . "<br>";
                            foreach ($cart_product as $values){
                                foreach ($values as $value){
                                    $attribute_value = Attribute_values::find_by_id($value);
                                    $attribute = Attributes::find_by_id($attribute_value->attribute_id);

                                    echo $attribute->name . " : " . $attribute_value->name . "<br>";
                                }


                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        echo "€" . $product->price;
                        $total_price += $product->price + 0;
                        ?>

                    </td>
                    <?php
                    $key = array_search("$product_id", $cart_product);
                    ;?>
                    <td><a href="?delete=<?php echo $i?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php
                $i++;
                endforeach; ?>
                <tr>
                    <th>Total Price: </th>
                    <td>
                        <?php echo "€" . $total_price; ?>
                    </td>
                </tr>
            </table>

            <div class="row justify-content-around">

                <form action="" method="post">
                    <input type="submit" name="clear_cart" class="btn btn-danger" value="Empty Cart">

                </form>

                <a href="checkout" class="btn-primary btn">Go To Checkout</a>
            </div>

        </div>
    </div>
</div>

<?php endif; ?>

<?php

if (!isset($_SESSION["cart"])) :

?>

<div class="container pt-5">
<div class="row justify-content-center">
<div class="col-lg-6 text-center">
    <h1>Cart is empty, add products first!</h1>
</div>
</div>

</div>

<?php endif; ?>

<?php include("includes/footer.php"); ?>
