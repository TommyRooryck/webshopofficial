<?php include("includes/header.php");


if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}


$customers = Customer::find_all();
?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>

<div class="container-fluid px-0 main-content d-none d-lg-block">
    <div class="row w-100">
        <div class="col-12 pr-0 pt-5 text-center">
            <h1>Customers</h1>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($customers as $customer) :
                    ?>
                    <tr>
                        <td><?php echo $customer->id; ?></td>
                        <td><?php echo $customer->username; ?></td>
                        <td><?php echo $customer->first_name; ?></td>
                        <td><?php echo $customer->last_name; ?></td>
                        <td><?php echo $customer->email; ?></td>
                        <td><a href="edit_Customer.php?id=<?php echo $customer->id; ?>"
                               class="btn btn-danger rounded-0"><i
                                        class="fas fa-user-edit"></i></a></td>
                        <td><a href="delete_Customer.php?id=<?php echo $customer->id; ?>"
                               class="btn btn-danger rounded-0"><i
                                        class="fas fa-user-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid px-0 main-content d-lg-none">
    <div class="row w-100 mx-0">
        <div class="col-12">
            <h2 class="text-center pt-5">Customers</h2>
            <hr>
            <?php
            $x=0;
            foreach ($customers as $customer) : ?>

            <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading<?php echo $x; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link dropdown-toggle w-100 p-0" data-toggle="collapse" data-target="#collapse<?php echo $x; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x;?>">
                                    <?php echo $customer->id . ' : ' . $customer->username . ' - ' . $customer->first_name . ' ' . $customer->last_name; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>" data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-around">
                                    <h6>ID: </h6>
                                    <?php echo $customer->id; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Username: </h6>
                                    <?php echo $customer->username; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Voornaam: </h6>
                                    <?php echo $customer->first_name; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Familienaam: </h6>
                                    <?php echo $customer->last_name; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Email: </h6>
                                    <?php echo $customer->email; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <a href="edit_Customer.php?id=<?php echo $customer->id; ?>" class="btn btn-primary">View or Edit Customer</a>
                                    <a href="delete_Customer.php?id=<?php echo $customer->id; ?>" class="btn btn-danger">Delete Customer</a>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
            <?php
            $x++;
            endforeach;
            ?>
    </div>
</div>


<?php include("includes/footer.php"); ?>
