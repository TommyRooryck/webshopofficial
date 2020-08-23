<?php require_once("includes/header.php") ?>
<?php require_once("includes/sidebar.php"); ?>
<?php require_once("includes/content_top.php"); ?>

<?php
if (!$session->is_signed_in()) {
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied");
}


$orders = Orders::find_all();

$descending_orders = array_reverse($orders);


?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="pt-5">Orders</h2>
        </div>
    </div>

    <?php if ($orders) : ?>
        <?php foreach ($descending_orders

                       as $order) :
            ?>
            <div class="row shadow-lg p-5 m-5">
                <div class="col-12 text-center">
                    <table class="table table-hover">
                        <tr>
                            <th>Order-id</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td><?php echo "#" . $order->id; ?></td>
                            <td><?php echo $order->first_name . " " . $order->last_name; ?></td>
                            <td><?php echo $order->created_at; ?> </td>
                            <td><?php echo $order->status; ?> </td>
                            <td><?php echo $order->total_price; ?></td>
                        </tr>
                    </table>
                    <a href="order_details.php?id=<?php echo $order->bestelcode; ?>" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                </div>
            </div>
        <?php
        endforeach;
    else:
    ?>
    <div class="row">
        <div class="col-12 text-center">
            <p>No orders placed</p>
        </div>
    </div>
</div>
<?php endif; ?>
<?php require_once("includes/footer.php"); ?>
