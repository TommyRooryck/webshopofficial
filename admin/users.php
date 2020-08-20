<?php include("includes/header.php");
if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}


if (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied.php");
}

$admins = Admin::find_all()
?>
<?php include("includes/sidebar.php"); ?>

<?php include("includes/content_top.php"); ?>
<div class="container-fluid d-none d-lg-block">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1>USERS</h1>
            <hr>
            <td><a href="add_User.php" class="btn btn-primary rounded-0 my-2"><i class="fas fa-user-plus"></i>Add
                    User</a></td>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Edit User</th>
                    <th>Delete User</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($admins as $admin) :
                    ?>
                    <tr>
                        <td><?php echo $admin->id; ?></td>
                        <td><?php echo $admin->username; ?></td>
                        <td><?php echo $admin->first_name; ?></td>
                        <td><?php echo $admin->last_name; ?></td>
                        <td><?php echo $admin->role; ?></td>
                        <td><a href="edit_User?id=<?php echo $admin->id; ?>" class="btn btn-danger rounded-0"><i
                                        class="fas fa-user-edit"></i></a></td>
                        <td><a href="delete_User.php?id=<?php echo $admin->id; ?>" class="btn btn-danger rounded-0"><i
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
            <h2 class="text-center pt-5">Users</h2>
            <hr>
            <?php
            $x=0;
            foreach ($admins as $admin) : ?>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading<?php echo $x; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link dropdown-toggle p-0 w-100" data-toggle="collapse" data-target="#collapse<?php echo $x; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x;?>">
                                    <?php echo $admin->id . ' : ' . $admin->username . ' - ' . $admin->first_name . ' ' . $admin->last_name; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>" data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-around">
                                    <h6>ID: </h6>
                                    <?php echo $admin->id; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Username: </h6>
                                    <?php echo $admin->username; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Voornaam: </h6>
                                    <?php echo $admin->first_name; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Familienaam: </h6>
                                    <?php echo $admin->last_name; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <h6>Email: </h6>
                                    <?php echo $admin->role; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <a href="edit_User?id=<?php echo $admin->id; ?>" class="btn btn-primary">View or Edit User</a>
                                    <a href="delete_User.php?id=<?php echo $admin->id; ?>" class="btn btn-danger">Delete User</a>
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
