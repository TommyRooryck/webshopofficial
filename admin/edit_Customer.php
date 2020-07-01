<?php include("includes/header.php"); ?>

<?php

if (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("customers.php");
}

$msg = "";

$customer = Customer::find_by_id($_GET['id']);

if (isset($_POST['submit'])) {
    if ($customer) {
        $customer->username = trim($_POST['username']);
        $customer->first_name = trim($_POST['first_name']);
        $customer->last_name = trim($_POST['last_name']);
        $customer->email = trim($_POST['email']);
        $customer->phone = trim($_POST['phone']);
        $customer->adress = trim($_POST['adress']);
        $customer->postal_code = trim($_POST['postal_code']);
        $customer->city = trim($_POST['city']);
        $customer->region = trim($_POST['region']);
        $customer->country = trim($_POST['country']);
        $customer->shipping_adress = trim($_POST['shipping_adress']);
        $customer->shipping_postal_code = trim($_POST['shipping_postal_code']);
        $customer->shipping_city = trim($_POST['shipping_city']);
        $customer->shipping_region = trim($_POST['shipping_region']);
        $customer->shipping_country = trim($_POST['shipping_country']);
        $customer->save();
        redirect("customers.php");
    } else {
        $msg = "There was an error updating - check error";
    }
}

?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Edit Customer</h1>
            <div>
                <h5 class="text-danger"><?php $msg; ?></h5>
            </div>
            <form method="post">
                <div class="form-group col-md-6 pl-0">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"
                           value="<?php echo $customer->username; ?>">
                </div>
                <div class="form-row">
                    <?php echo $msg; ?>
                    <div class="form-group col-md-6">
                        <label for="first_name">Voornaam</label>
                        <input type="text" class="form-control" name="first_name"
                               value="<?php echo $customer->first_name; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Familienaam</label>
                        <input type="text" class="form-control" name="last_name"
                               value="<?php echo $customer->last_name; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email"
                               value="<?php echo $customer->email; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Telefoonnummer</label>
                        <input type="text" class="form-control" name="phone"
                               value="<?php echo $customer->phone; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="billing_adress">Adres</label>
                        <input type="text" class="form-control" name="adress"
                               value="<?php echo $customer->adress ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="postal_code">Postcode</label>
                        <input type="text" class="form-control" name="postal_code"
                               value="<?php echo $customer->postal_code; ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="city">Stad</label>
                        <input type="text" class="form-control" name="city"
                               value="<?php echo $customer->city; ?>">
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="region">Regio</label>
                        <input type="text" class="form-control" name="region"
                               value="<?php echo $customer->region; ?>">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="country">Land</label>
                        <input type="text" class="form-control" name="country"
                               value="<?php echo $customer->country; ?>">
                    </div>
                </div>

                <div id="shipping_adress_form">
                    <h5>Shipping Address</h5>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="shipping_adress">Adres</label>
                            <input type="text" class="form-control" name="shipping_adress"
                                   value="<?php echo $customer->shipping_adress ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="shipping_postal_code">Postcode</label>
                            <input type="text" class="form-control" name="shipping_postal_code"
                                   value="<?php echo $customer->shipping_postal_code; ?>">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="shipping_city">Stad</label>
                            <input type="text" class="form-control" name="shipping_city"
                                   value="<?php echo $customer->shipping_city; ?>">
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="shipping_region">Regio</label>
                            <input type="text" class="form-control" name="shipping_region"
                                   value="<?php echo $customer->shipping_region; ?>">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="shipping_country">Land</label>
                            <input type="text" class="form-control" name="shipping_country"
                                   value="<?php echo $customer->shipping_country; ?>">
                        </div>
                    </div>
                </div>
                <div class="row float-right mb-5 mr-lg-0 mr-3">
                    <a href="delete_User.php?id=<?php echo $customer->id; ?>" class="btn btn-danger ">Delete User</a>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
