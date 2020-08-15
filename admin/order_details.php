<?php require_once("includes/header.php"); ?>
<?php require_once("includes/sidebar.php"); ?>
<?php require_once("includes/content_top.php"); ?>

<?php
$order = Orders::find_by_id($_GET['id']);
$order_products = Order_products::find_the_key($order->id);
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center p-5">
            <h1>Order <?php echo "#" . $order->id; ?> Details</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-hover">
                <tr>
                    <th>Created at</th>
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

<?php require_once("includes/footer.php"); ?>
