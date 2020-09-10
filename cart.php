<?php include("includes/header.php"); ?>


<?php

$customer = "";

if (isset($_SESSION['user_id'])) {
    $customer = Customer::find_by_id($_SESSION['user_id']);
    if (isset($_SESSION['shipping_country'])){
        unset($_SESSION['shipping_country']);
    }

}

$shipping_zones = Shipping::find_all();


if (isset($_POST['clear_cart'])) {
    unset($_SESSION["cart"]);
}

if (isset($_GET['delete'])) {
    unset($_SESSION['cart'][$_GET['delete']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    redirect("cart");
}

if (isset($_POST['update'])) {
    if (Shipping::find_by('shipping_zone', htmlspecialchars(trim($_POST['shipping_country'])))){
        if ($customer) {
            $customer->shipping_country = htmlspecialchars(trim($_POST['shipping_country']), ENT_QUOTES, 'UTF-8');
            $customer->save();
        } elseif ($customer && isset($_SESSION['shipping_country'])){
            unset($_SESSION['shipping_country']);
        } elseif (isset($_SESSION['shipping_country'])){
            unset($_SESSION['shipping_country']);
            $_SESSION['shipping_country'] = htmlspecialchars(trim($_POST['shipping_country']), ENT_QUOTES, 'UTF-8');
        } else {
            $_SESSION['shipping_country'] = htmlspecialchars(trim($_POST['shipping_country']), ENT_QUOTES, 'UTF-8');
        }
    }else{
        redirect('cart');
    }

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
                    $total_price = 0;
                    $i = 0;
                    foreach ($_SESSION['cart'] as $cart_product):
                        $product_id = array_shift($cart_product);
                        $product = Product::find_by_id($product_id);
                        ?>

                        <tr>
                            <td>
                                <?php
                                echo $product->name . "<br>";
                                foreach ($cart_product as $values) {
                                    foreach ($values as $value) {
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
                                echo "€" . number_format($product->price,2);
                                $total_price += $product->price;
                                ?>

                            </td>
                            <?php
                            $key = array_search("$product_id", $cart_product);; ?>
                            <td><a href="?delete=<?php echo $i ?>" class="btn btn-danger"><i
                                            class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    <tr>
                        <?php

                        if ($customer && $customer->shipping_country || isset($_SESSION['shipping_country'])) :
                            $zone_array = array();
                            $price_array = array();
                            foreach ($shipping_zones as $shipping_zone) {
                                $zone = strtolower($shipping_zone->shipping_zone);
                                $price = $shipping_zone->shipping_price;
                                array_push($zone_array, $zone);
                                array_push($price_array, $price);
                            }

                            if ($customer && $customer->shipping_country) {
                                $shipping_zone = strtolower($customer->shipping_country);
                            } else {
                                $shipping_zone = strtolower($_SESSION['shipping_country']);
                            }


                            $zone_key = array_search($shipping_zone, $zone_array);
                            if ($zone_key !== false):
                                $price = $price_array[$zone_key];
                                ?>
                                <td> Shipping Price:</td>
                                <td> Jouw Zone: <br> <small class="text-muted">(wordt ingevuld als land in je afleveringsadres)</small> <br>

                                    <form action="cart.php" method="post">
                                        <select name="shipping_country" id="">
                                            <option
                                                    value="<?php
                                                    if ($customer && $customer->shipping_country) {
                                                        echo $customer->shipping_country;
                                                    } elseif (isset($_SESSION['shipping_country'])) {
                                                        echo $_SESSION['shipping_country'];
                                                    } else {
                                                        foreach ($shipping_zones as $shipping_zone) {
                                                            echo $shipping_zone->shipping_zone;
                                                        }
                                                    }
                                                    ?>">
                                                <?php
                                                if ($customer && $customer->shipping_country) {
                                                    echo $customer->shipping_country;
                                                } elseif (isset($_SESSION['shipping_country'])) {
                                                    echo $_SESSION['shipping_country'];
                                                } else {
                                                    foreach ($shipping_zones as $shipping_zone) {
                                                        echo $shipping_zone->shipping_zone;
                                                    }
                                                }
                                                ?>
                                            </option>
                                            <?php foreach ($shipping_zones as $shipping_zone) : ?>
                                            <?php if ($customer && $customer->shipping_country && $shipping_zone->shipping_zone !== $customer->shipping_country) : ?>
                                            <option value="<?php echo $shipping_zone->shipping_zone; ?>">
                                                <?php echo $shipping_zone->shipping_zone; ?>
                                            </option>
                                            <?php elseif (isset($_SESSION['shipping_country']) && $_SESSION['shipping_country'] !== $shipping_zone->shipping_zone) : ?>
                                                    <option value="<?php echo $shipping_zone->shipping_zone; ?>">
                                                        <?php echo $shipping_zone->shipping_zone; ?>
                                                    </option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <br>
                                        <input type="submit" name="update" class="btn btn-success mt-2" value="Update">
                                    </form>
                                </td>
                                <td><?php echo "€" . number_format($price,2); ?></td>
                                <?php
                                $total_price += $price;
                            endif;
                            ?>


                        <?php else : ?>

                            <td>Shipping Price:</td>
                            <td>
                                Jouw Zone: <br>
                                <form action="cart" method="post">
                                    <select name="shipping_country" id="">
                                        <?php foreach ($shipping_zones as $shipping_zone) : ?>
                                            <option value="<?php echo $shipping_zone->shipping_zone ?>"><?php echo $shipping_zone->shipping_zone ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <br>
                                    <input type="submit" name="update" class="btn btn-success mt-2" value="Update">
                                </form>
                            </td>

                        <?php endif; ?>


                    </tr>
                    <tr>
                        <th colspan="2" class="text-right">Total Price:</th>
                        <td>
                            <?php echo "<b>" . "€" . number_format($total_price,2) . "</b>"; ?>
                        </td>
                    </tr>
                </table>

                <div class="row justify-content-around">

                    <form action="" method="post">
                        <input type="submit" name="clear_cart" class="btn btn-danger" value="Empty Cart">

                    </form>

                    <?php
                    if ($customer && $customer->shipping_country || isset($_SESSION['shipping_country'])) :
                    ?>
                    <a href="checkout_form.php" class="btn-primary btn">Go To Checkout</a>
                    <?php else: ?>
                    <p class="btn btn-warning">Please select a shipping zone</p>
                    <?php endif; ?>
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
