<?php include("includes/header.php");


if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$shipping_zones = Shipping::find_all();

if (isset($_POST['submit'])){
    $shipping = new Shipping();
    $shipping->shipping_zone = trim($_POST['zone']);
    $shipping->shipping_price = trim($_POST['price']);
    $shipping->save();

    redirect("shipping");
}

?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center pt-5">
            <h1>Shipping</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center"> Add New Shipping Zone </h2>
            <form method="post" action="shipping.php">
                <div class="form-group">
                    <label for="zone">Shipping Zone (country)</label>
                    <input type="text" required name="zone" class="form-control" placeholder="Enter Shipping Zone">
                </div>
                <div class="form-group">
                    <label for="price">Price (*.**)</label>
                    <input type="text" required name="price" class="form-control" placeholder="Enter Shipping Price">
                    <small class="form-text text-muted">2 decimals</small>
                </div>

                <button type="submit" name="submit" class="btn btn-primary float-right float-lg-left">Submit</button>
            </form>
        </div>
        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center">All Shipping Zones</h2>
            <table class="table table-hover text-center">
                <tr>
                    <th>Shipping Zone</th>
                    <th>Shipping Price</th>
                </tr>

                <?php foreach ($shipping_zones as $shipping_zone) : ?>
                <tr>
                    <td><?php echo $shipping_zone->shipping_zone; ?></td>
                    <td><?php echo "€" . $shipping_zone->shipping_price; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>


