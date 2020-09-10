<?php include("includes/header.php"); ?>

<?php


if (isset($_SESSION['user_id'])) {
    $customer = Customer::find_by_id($_SESSION['user_id']);
}

if (!isset($_SESSION['cart'])) {
    redirect("index");
}

$shipping_zones = Shipping::find_all();

$order = new Orders();


if (isset($_POST['submit'])) {
    if ($order) {
        $order->created_at = date("Y/m/d");
        if (isset($_SESSION['username']) && $customer) {
            $order->customer_id = $customer->id;
        }
        $first_name = htmlspecialchars(trim($_POST['first_name']), ENT_QUOTES, 'UTF-8');
        $last_name = htmlspecialchars(trim($_POST['last_name']), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8');
        $adress = htmlspecialchars(trim($_POST['adress']), ENT_QUOTES, 'UTF-8');
        $city = htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');
        $postal_code = htmlspecialchars(trim($_POST['postal_code']), ENT_QUOTES, 'UTF-8');
        $region = htmlspecialchars(trim($_POST['region']), ENT_QUOTES,  'UTF-8');
        $country = htmlspecialchars(trim($_POST['country']), ENT_QUOTES, 'UTF-8');

        $order->products = serialize($_SESSION['cart']);
        $order->first_name = $first_name;
        $order->last_name = $last_name;
        $order->email = $email;
        $order->phone = $phone;
        $order->adress = $adress;
        $order->city = $city;
        $order->postal_code = $postal_code;
        $order->region = $region;
        $order->country = $country;

        if (isset($_POST['shipping_adress_check'])) {
            $shipping_adress = htmlspecialchars(trim($_POST['shipping_adress']), ENT_QUOTES, 'UTF-8');
            $shipping_city = htmlspecialchars(trim($_POST['shipping_city']), ENT_QUOTES, 'UTF-8');
            $shipping_postal_code = htmlspecialchars(trim($_POST['shipping_postal_code']), ENT_QUOTES, 'UTF-8');
            $shipping_region = htmlspecialchars(trim($_POST['shipping_region']), ENT_QUOTES, 'UTF-8');
            $shipping_country = htmlspecialchars(trim($_POST['shipping_country']));

            $order->shipping_adress = $shipping_adress;
            $order->shipping_city = $shipping_city;
            $order->shipping_postal_code = $shipping_postal_code;
            $order->shipping_region = $shipping_region;
            $order->shipping_country = $shipping_country;
        } else {
            $order->shipping_adress = $adress;
            $order->shipping_city = $city;
            $order->shipping_postal_code = $postal_code;
            $order->shipping_region = $region;
            $order->shipping_country = $country;
        }

        $order->save();


        $total_price = 0.00;

        foreach ($_SESSION['cart'] as $cart_product) {

            $product_id = array_shift($cart_product);
            $product = Product::find_by_id($product_id);

            $total_price += $product->price;

            foreach ($cart_product as $values) {
                foreach ($values as $value) {
                    $order_products = new Order_products();

                    $order_products->order_id = $order->id;
                    $order_products->product_id = $product_id;
                    $attribute_value = Attribute_values::find_by_id($value);
                    $attribute = Attributes::find_by_id($attribute_value->attribute_id);

                    $order_products->attribute_id = $attribute->id;
                    $order_products->attribute_values_id = $attribute_value->id;

                    $order_products->save();

                }
            }

            $order->total_price = $total_price;
            $order->bestelcode = uniqid(date("Ymd"), true);

            $order->save();


        }

        $products_total_price = $order->total_price + 0.00;

        if ( isset($_SESSION['username']) && $customer && $customer->shipping_country || isset($_SESSION['shipping_country'])) :
            $zone_array = array();
            $price_array = array();
            foreach ($shipping_zones as $shipping_zone) {
                $zone = strtolower($shipping_zone->shipping_zone);
                $price = $shipping_zone->shipping_price;
                array_push($zone_array, $zone);
                array_push($price_array, $price);
            }

            if (isset($_SESSION['username']) && $customer && $customer->shipping_country) {
                $shipping_zone = strtolower($customer->shipping_country);
            } else {
                $shipping_zone = strtolower($_SESSION['shipping_country']);
            }


            $zone_key = array_search($shipping_zone, $zone_array);
            if ($zone_key !== false):
                $price = $price_array[$zone_key];
                $products_total_price += $price + 0.00;
            endif;
        endif;

        $order->total_price = $products_total_price;
        $order->save();

        unset($_SESSION['cart']);

    }

    if (isset($_POST['remember_me'])){
        include ("includes/add_customer_details.php");
    }

    redirect("checkout.php?id=" . $order->id);
}


?>

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <h1>Checkout</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">Voornaam</label>
                        <input type="text" required class="form-control" name="first_name"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->first_name;
                               } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Familienaam</label>
                        <input type="text" required class="form-control" name="last_name"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->last_name;
                               } ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" required class="form-control" name="email"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->email;
                               } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Telefoonnummer</label>
                        <input type="text" class="form-control" name="phone"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->phone;
                               } ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="billing_adress">Adres</label>
                        <input type="text" required class="form-control" name="adress"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->adress;
                               } ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="postal_code">Postcode</label>
                        <input type="text" required class="form-control" name="postal_code"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->postal_code;
                               } ?>">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="city">Stad</label>
                        <input type="text" required class="form-control" name="city"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->city;
                               } ?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="region">Regio</label>
                        <input type="text" required class="form-control" name="region"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->region;
                               } ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">Land</label>
                        <input type="text" required class="form-control" name="country"
                               value="<?php if (isset($_SESSION['username']) && $customer) {
                                   echo $customer->country;
                               } ?>">
                    </div>

                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="shipping_adress_check" id="shipping_adress_check">
                        <label class="form-check-label" for="shipping_adress_check">
                            Ander bezorg adres?
                        </label>
                    </div>
                </div>


                <div id="shipping_adress_form" class="d-none">

                    <div class="row">

                        <div class="form-group col-md-5">
                            <label for="shipping_adress">Adres</label>
                            <input type="text" class="form-control" name="shipping_adress"
                                   value="<?php if (isset($_SESSION['username']) && $customer) {
                                       echo $customer->shipping_adress;
                                   } ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="shipping_postal_code">Postcode</label>
                            <input type="text" class="form-control" name="shipping_postal_code"
                                   value="<?php if (isset($_SESSION['username']) && $customer) {
                                       echo $customer->shipping_postal_code;
                                   } ?>">
                        </div>


                        <div class="form-group col-md-5">
                            <label for="shipping_city">Stad</label>
                            <input type="text" class="form-control" name="shipping_city"
                                   value="<?php if (isset($_SESSION['username']) && $customer) {
                                       echo $customer->shipping_city;
                                   } ?>">
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="shipping_region">Regio</label>
                            <input type="text" class="form-control" name="shipping_region"
                                   value="<?php if (isset($_SESSION['username']) && $customer) {
                                       echo $customer->shipping_region;
                                   } ?>">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="shipping_country">Land</label>
                            <input type="text" class="form-control" readonly name="shipping_country"
                                   value="<?php if ( isset($_SESSION['username']) && $customer) {
                                       echo $customer->shipping_country;
                                   } elseif (isset($_SESSION['shipping_country'])) {
                                       echo $_SESSION['shipping_country'];
                                   } ?>">
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['username']) && $customer) : ?>
                <div class="form-group float-right">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="remember_me" id="remember_me">
                        <label class="form-check-label" for="remember_me">
                            Save info
                        </label>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <table class="table table-hover">
                            <tr>
                                <th colspan="2" >Product</th>
                                <th>Price</th>
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
                                    <td colspan="2">
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

                                        ?></td>
                                </tr>

                                <?php
                                $i++;
                            endforeach; ?>
                            <?php
                            if ( isset($_SESSION['username']) && $customer && $customer->shipping_country || isset($_SESSION['shipping_country'])) :
                                $zone_array = array();
                                $price_array = array();
                                foreach ($shipping_zones as $shipping_zone) {
                                    $zone = strtolower($shipping_zone->shipping_zone);
                                    $price = $shipping_zone->shipping_price;
                                    array_push($zone_array, $zone);
                                    array_push($price_array, $price);
                                }

                                if (isset($_SESSION['username']) && $customer && $customer->shipping_country) {
                                    $shipping_zone = strtolower($customer->shipping_country);
                                } else {
                                    $shipping_zone = strtolower($_SESSION['shipping_country']);
                                }


                                $zone_key = array_search($shipping_zone, $zone_array);
                                if ($zone_key !== false):
                                    $price = $price_array[$zone_key];
                                    ?>
                                    <td> Shipping Price:</td>
                                    <td> Jouw Zone: <br>
                                        <?php if (isset($_SESSION['username']) && $customer->shipping_country){
                                            echo $customer->shipping_country;
                                        } elseif (isset($_SESSION['shipping_country'])){
                                            echo $_SESSION['shipping_country'];
                                        }?>
                                    </td>
                                    <td><?php echo "€" . number_format($price,2); ?></td>
                                    <?php
                                    $total_price += $price;
                                endif;
                            endif;
                            ?>


                            <tr>
                                <th colspan="2" class="text-right">Total Price:</th>
                                <td>
                                    <?php
                                    echo "<b>" . "€" . number_format($total_price,2) . "</b>";
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <div class="float-right mb-3">
                            <input type="submit" name="submit" class="btn save-button" value="Bestellen">
                        </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>

