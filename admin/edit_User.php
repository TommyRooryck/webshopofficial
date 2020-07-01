<?php
include ("includes/header.php");

if (!$session -> is_signed_in()){
    redirect("login.php");
}

if (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied.php");
}



if (empty($_GET['id'])){
    redirect('users.php');
}

$admin = Admin::find_by_id($_GET['id']);
$msg = "";

include ("includes/sidebar.php");
include ("includes/content_top.php");

if (isset($_POST['update_user'])){
    if (empty(Admin::check_admin_exist(trim($_POST['username']))) && empty(Customer::check_customer_exist(trim($_POST['username']))));
    if ($admin){
        $admin->username = $_POST['username'];
        $admin->first_name = $_POST['first_name'];
        $admin->last_name = $_POST['last_name'];
        $admin->role = $_POST['role'];
        $admin->save();
        redirect("users.php");
    }
    else{
        $msg = "Update failed!";
    }
}


?>



<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12">
            <h1>Edit User</h1>
            <div>
                <h5 class="text-danger"><?php $msg; ?></h5>
            </div>
            <form action="edit_User.php?id=<?php echo $admin->id; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">ID</label>
                            <input type="text" readonly name="id" class="form-control" value="<?php echo $admin->id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $admin->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $admin->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $admin->last_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $admin->role; ?>">
                        </div>
                        <a href="delete_Customer.php?id=<?php echo $admin->id; ?>" class="btn btn-danger">Delete User</a>
                        <input type="submit" name="update_user" value="Update User" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
