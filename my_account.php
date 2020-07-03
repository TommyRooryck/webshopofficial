<?php include("includes/header.php");

if (!empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("admin/users.php");
}
$msg = "";
$customer = Customer::find_by_id($_SESSION['user_id']);

if (isset($_POST['submit'])) {
    if (isset($_POST['shipping_adress_check'])) {
        if ($customer) {
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
            redirect("my_account.php");
        } else {
            $msg = "There was an error updating - check error";
        }
    } else {
        if ($customer) {
            $customer->first_name = trim($_POST['first_name']);
            $customer->last_name = trim($_POST['last_name']);
            $customer->email = trim($_POST['email']);
            $customer->phone = trim($_POST['phone']);
            $customer->adress = trim($_POST['adress']);
            $customer->postal_code = trim($_POST['postal_code']);
            $customer->city = trim($_POST['city']);
            $customer->region = trim($_POST['region']);
            $customer->country = trim($_POST['country']);
            $customer->shipping_adress = trim($_POST['adress']);
            $customer->shipping_postal_code = trim($_POST['postal_code']);
            $customer->shipping_region = trim($_POST['region']);
            $customer->shipping_city = trim($_POST['city']);
            $customer->shipping_country = trim($_POST['country']);
            $customer->save();
            redirect("my_account.php");
        } else {
            $msg = "There was an error updating - no check error";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 text-center pt-5">
            <h1>Mijn Account</h1>
            <hr>
        </div>
    </div>
    <div class="accordion pt-5" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapse_btn text-center dropdown-toggle " id="buttonOne" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Mijn Gegevens
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form method="post">
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
                                           value="<?php echo $customer->shipping_adress; ?>">
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
                        <div class="float-right mb-3">
                            <input type="submit" name="submit" class="btn save-button" value="opslaan">
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed collapse_btn dropdown-toggle text-center" id="buttonTwo" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Mijn Bestellingen
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>
</div>


<?php include("includes/footer.php"); ?>


