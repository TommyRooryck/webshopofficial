<?php

include ("includes/header.php");


//if (!$session->is_signed_in()){
//    redirect('login');
//} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
//    redirect("../access_denied");
//}

$admin= new Admin(); //Creëer een niewe instantie van het object user met de naam $user
$msg = "";


if (isset($_POST['add_user'])){
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($admin) {
            $admin->role = trim($_POST['role']);
            $admin->first_name = trim($_POST['first_name']);
            $admin->last_name = trim($_POST['last_name']);
            $admin->username = trim($_POST['username']);
            $admin->password = $hashed_password;
            $admin->save();
            redirect('users.php');
        }
    } else{
        $msg = "Username already taken";
}



?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Add User</h1>
            <form action="add_User.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <h5>
                            <div class="text-danger border-danger">
                                <?php echo $msg; ?>
                            </div>
                        </h5>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <input type="submit" name="add_user" value="Add User" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
