<?php include("includes/header.php"); ?>

<?php

$order = new Orders();
$order_products = new Order_products();

if (isset($_POST['submit'])) {
    if ($order) {
        $order->created_at = date("Y/m/d");
        $order->status = 'Waiting for payment';
        $order->first_name = trim($_POST['first_name']);
        $order->last_name = trim($_POST['last_name']);
        $order->email = trim($_POST['email']);
        $order->phone = trim($_POST['phone']);
        $order->adress = trim($_POST['adress']);
        $order->city = trim($_POST['city']);
        $order->postal_code = trim($_POST['postal_code']);
        $order->region = trim($_POST['region']);
        $order->country = trim($_POST['country']);

        if (isset($_POST['shipping_adress_check'])) {
            $order->shipping_adress = trim($_POST['shipping_adress']);
            $order->shipping_city = trim($_POST['shipping_city']);
            $order->shipping_postal_code = trim($_POST['shipping_postal_code']);
            $order->shipping_region = trim($_POST['shipping_region']);
            $order->shipping_country = trim($_POST['shipping_country']);
        } else {
            $order->shipping_adress = trim($_POST['adress']);
            $order->shipping_city = trim($_POST['city']);
            $order->shipping_postal_code = trim($_POST['postal_code']);
            $order->shipping_region = trim($_POST['region']);
            $order->shipping_country = trim($_POST['country']);
        }

        $order->save();


        $total_price = 0;
        foreach ($_SESSION['cart'] as $cart_product) {

            $order_products->order_id = $order->id;

            $product_id = array_shift($cart_product);
            $product = Product::find_by_id($product_id);

            $total_price += $product->price;

            $order_products->product_id = $product_id;
            foreach ($cart_product as $values) {
                foreach ($values as $value) {
                    $attribute_value = Attribute_values::find_by_id($value);
                    $attribute = Attributes::find_by_id($attribute_value->attribute_id);

                    $order_products->attribute_id = $attribute->id;
                    $order_products->attribute_values_id = $attribute_value->id;

                }
            }

            $order_products->save();

            $order->total_price = $total_price;

            $order->save();

            unset($_SESSION['cart']);

            redirect('order_details.php?id=' . $order->id);
        }
    }

}

if (isset($_SESSION['username'])) {
    $customer = Customer::check_customer_exist($_SESSION ['username']);
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
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->first_name;
                               } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Familienaam</label>
                        <input type="text" required class="form-control" name="last_name"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->last_name;
                               } ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" required class="form-control" name="email"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->email;
                               } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Telefoonnummer</label>
                        <input type="text" class="form-control" name="phone"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->phone;
                               } ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="billing_adress">Adres</label>
                        <input type="text" required class="form-control" name="adress"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->adress;
                               } ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="postal_code">Postcode</label>
                        <input type="text" required class="form-control" name="postal_code"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->postal_code;
                               } ?>">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="city">Stad</label>
                        <input type="text" required class="form-control" name="city"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->city;
                               } ?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="region">Regio</label>
                        <input type="text" required class="form-control" name="region"
                               value="<?php if (isset($_SESSION['username'])) {
                                   echo $customer->region;
                               } ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">Land</label>
                        <input type="text" required class="form-control" name="country"
                               value="<?php if (isset($_SESSION['username'])) {
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
                                   value="<?php if (isset($_SESSION['username'])) {
                                       echo $customer->shipping_adress;
                                   } ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="shipping_postal_code">Postcode</label>
                            <input type="text" class="form-control" name="shipping_postal_code"
                                   value="<?php if (isset($_SESSION['username'])) {
                                       echo $customer->shipping_postal_code;
                                   } ?>">
                        </div>


                        <div class="form-group col-md-5">
                            <label for="shipping_city">Stad</label>
                            <input type="text" class="form-control" name="shipping_city"
                                   value="<?php if (isset($_SESSION['username'])) {
                                       echo $customer->shipping_city;
                                   } ?>">
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="shipping_region">Regio</label>
                            <input type="text" class="form-control" name="shipping_region"
                                   value="<?php if (isset($_SESSION['username'])) {
                                       echo $customer->shipping_region;
                                   } ?>">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="shipping_country">Land</label>
                            <input type="text" class="form-control" name="shipping_country"
                                   value="<?php if (isset($_SESSION['username'])) {
                                       echo $customer->shipping_country;
                                   } ?>">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <table class="table table-hover">
                            <tr>
                                <th>Product</th>
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
                                        echo "€" . $product->price;

                                        $total_price += $product->price + 0;

                                        ?></td>
                                </tr>

                                <?php
                                $i++;
                            endforeach; ?>
                            <tr>
                                <th>Total Price:</th>
                                <td>
                                    <?php
                                    echo "€" . $total_price;
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

