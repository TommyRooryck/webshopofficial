<?php require_once("includes/header.php"); ?>
<?php require_once("includes/sidebar.php"); ?>
<?php require_once("includes/content_top.php"); ?>

<?php
$order = Orders::find_by_id($_GET['id']);
$order_products = Order_products::find_the_key($order->id);
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center p-lg-5 pt-5">
            <h1>Order <?php echo "#" . $order->id; ?> Details</h1>
        </div>
    </div>

    <div class="row ">
        <div class="col-12">
            <div class="table-responsive d-none d-md-block">
                <table class="table-hover table">
                    <tr>
                        <th>Created At</th>
                        <th>Billing</th>
                        <th>Shipping</th>
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
            <table class="table table-borderless mt-5">
                <tr>
                    <th>Products</th>
                    <th>Attributes</th>
                    <th>Price</th>
                </tr>
                <?php
                $array = array();
                foreach ($order_products as $order_product) :
                    ?>
                    <?php
                    $product = Product::find_by_id($order_product->product_id);
                    $attribute = Attributes::find_by_id($order_product->attribute_id);
                    $attribute_values = Attribute_values::find_by_id($order_product->attribute_values_id);

                    ?>
                    <tr class="border-0">
                        <td><?php if (!in_array($product->id, $array)) {
                                echo $product->name;
                            } ?></td>
                        <td><?php echo $attribute->name . ' : ' . $attribute_values->name; ?></td>
                        <td><?php if (!in_array($product->id, $array)) {
                                echo "€" . $product->price;
                                array_push($array, $product->id);
                            } ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th colspan="2" class="text-right">Total Price:</th>
                    <td><?php echo "<b>" . "€" . $order->total_price . "</b>"; ?></td>
                </tr>
            </table>
        </div>
    </div>


<?php require_once("includes/footer.php"); ?>
