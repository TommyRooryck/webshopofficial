<?php

$shipping_zones = Shipping::find_all();
$order = Orders::find_by_bestelnummer($_GET['id']);

if (isset($order->customer_id)){
    $customer = Customer::find_by_id($order->customer_id);
}

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center p-lg-5 pt-5">
            <h1>Bestelling <?php echo $order->bestelcode; ?> </h1>
        </div>
    </div>

    <div class="row ">
        <div class="col-12">
            <div class="table-responsive d-none d-md-block">
                <table class="table-hover table">
                    <tr>
                        <th>Besteldatum</th>
                        <th>Factuuradres</th>
                        <th>Afleveradres</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td> <?php echo $order->created_at; ?> </td>
                        <td>
                            <?php
                            echo $order->first_name . " " . $order->last_name . "<br>" .
                                $order->adress . "<br>" .
                                $order->postal_code . " , " . $order->city . "<br>" .
                                $order->region . " , " . $order->country;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $order->first_name . " " . $order->last_name . "<br>" .
                                $order->shipping_adress . "<br>" .
                                $order->shipping_postal_code . " , " . $order->shipping_city . "<br>" .
                                $order->shipping_region . " , " . $order->shipping_country;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $order->status;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row d-md-none">
        <div class="col-12">
            <table class="table table-hover">
                <tr>
                    <th>Created At:</th>
                    <td><?php echo $order->created_at; ?></td>
                </tr>
                <tr>
                    <th>Billing:</th>
                    <td> <?php
                        echo $order->first_name . " " . $order->last_name . "<br>" .
                            $order->adress . "<br>" .
                            $order->postal_code . " , " . $order->city . "<br>" .
                            $order->region . " , " . $order->country;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Shipping:</th>
                    <td>
                        <?php
                        echo $order->first_name . " " . $order->last_name . "<br>" .
                            $order->shipping_adress . "<br>" .
                            $order->shipping_postal_code . " , " . $order->shipping_city . "<br>" .
                            $order->shipping_region . " , " . $order->shipping_country;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td><?php echo $order->status; ?></td>
                </tr>
            </table>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="col-12 text-center">
                <h4 class="pt-5">Factuur</h4>
            </div>
            <!--            <table class="table table-borderless mt-5">-->
            <!--                <tr>-->
            <!--                    <th>Products</th>-->
            <!--                    <th>Attributes</th>-->
            <!--                    <th>Price</th>-->
            <!--                </tr>-->
            <!--                --><?php
            //                $array = array();
            //                $products = array();
            //                $products_and_attributes_array = array();
            //                foreach ($order_products as $order_product) :
            //                    ?>
            <!--                    --><?php
            //                    $product = Product::find_by_id($order_product->product_id);
            //                    $attribute = Attributes::find_by_id($order_product->attribute_id);
            //                    $attribute_values = Attribute_values::find_by_id($order_product->attribute_values_id);
            //
            //                    array_push($products_and_attributes_array, $product, $attribute, $attribute_values);
            //
            //                    array_push($products, $products_and_attributes_array);
            //                    ?>
            <!---->
            <!--                    <tr class="border-0">-->
            <!--                        <td>--><?php //if (!in_array($product->id, $array)) {
            //                                echo $product->name;
            //                            } ?><!--</td>-->
            <!--                        <td>-->
            <?php //echo $attribute->name . ' : ' . $attribute_values->name; ?><!--</td>-->
            <!--                        <td>--><?php //if (!in_array($product->id, $array)) {
            //                                echo "€" . $product->price;
            //                                array_push($array, $product->id);
            //                            } ?><!--</td>-->
            <!--                    </tr>-->
            <!--                --><?php //endforeach; ?>
            <!---->
            <!---->
            <!--                --><?php
            //                $customer = Customer::find_by_id($order->customer_id);
            //                if ( isset($_SESSION['username']) && $customer && $customer->shipping_country || isset($_SESSION['shipping_country'])) :
            //                    $zone_array = array();
            //                    $price_array = array();
            //                    foreach ($shipping_zones as $shipping_zone) {
            //                        $zone = strtolower($shipping_zone->shipping_zone);
            //                        $price = $shipping_zone->shipping_price;
            //                        array_push($zone_array, $zone);
            //                        array_push($price_array, $price);
            //                    }
            //
            //                    if (isset($_SESSION['username']) && $customer && $customer->shipping_country) {
            //                        $shipping_zone = strtolower($customer->shipping_country);
            //                    } else {
            //                        $shipping_zone = strtolower($_SESSION['shipping_country']);
            //                    }
            //
            //
            //                    $zone_key = array_search($shipping_zone, $zone_array);
            //                    if ($zone_key !== false):
            //                        $price = $price_array[$zone_key];
            //                        ?>
            <!--                        <td> Shipping Price:</td>-->
            <!--                        <td> Jouw Zone: <br>-->
            <!--                            --><?php //if (isset($_SESSION['username']) && $customer->shipping_country){
            //                                echo $customer->shipping_country;
            //                            } elseif (isset($_SESSION['shipping_country'])){
            //                                echo $_SESSION['shipping_country'];
            //                            }?>
            <!--                        </td>-->
            <!--                        <td>--><?php //echo "€" . $price; ?><!--</td>-->
            <!--                        --><?php
            //                    endif;
            //                endif;
            //                ?>
            <!--                <tr>-->
            <!--                    <th colspan="2" class="text-right">Total Price:</th>-->
            <!--                    <td>--><?php //echo "<b>" . "€" . $order->total_price . "</b>"; ?><!--</td>-->
            <!--                </tr>-->
            <!--            </table>-->

            <table class="table table-hover">
                <tr>
                    <th colspan="2">Product</th>
                    <th>Price</th>
                </tr>

                <?php
                $total_price = 0;
                $i = 0;
                $all_products = unserialize($order->products);
                foreach ($all_products as $all_product):
                    $product_id = array_shift($all_product);
                    $product = Product::find_by_id($product_id);
                    ?>

                    <tr>
                        <td colspan="2">
                            <?php
                            echo $product->name . "<br>";
                            foreach ($all_product as $values) {
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
                            ?>

                        </td>
                        <?php
                        $key = array_search("$product_id", $all_product);; ?>
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
                            <td colspan="2"> Shipping Price: <br>
                                Zone: <?php echo $order->shipping_country ?></td>
                            <td><?php echo "€" . $price; ?></td>
                            <?php
                            $total_price += $price + 0.00;
                        endif;
                    endif;
                    ?>
                </tr>
                <tr>
                    <th colspan="2" class="text-right">Total Price:</th>
                    <td>
                        <?php echo "<b>" . "€" . $total_price . "</b>"; ?>
                    </td>
                </tr>
        </div>
    </div>

