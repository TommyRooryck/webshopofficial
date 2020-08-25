<?php include ("includes/header.php"); ?>

<?php
if (isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    if (!empty(Customer::forgot_password_check($username, $email))){
        $customer = Customer::forgot_password_check($username, $email);
        $customer->user_code = uniqid($username, true);
        $customer->save();
        include("templates/mail/forgot_password_email.php");
        echo "
         <div class='row align-content-center justify-content-center w-100' style='padding-top: 40px;'>
             <div class='col-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Reset Email sent</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } else{
        echo "
         <div class='row align-content-center justify-content-center w-100'>
             <div class='col-lg-6'>
                <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
                    <strong>No user found with this combination!</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    }
}

    ?>

<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="text-center">Forgot password?</h2>
            <div class="row justify-content-center pt-4">
                <div class="col-lg-6">
                    <form action="" method="post">
                        <div class="form group">
                            <label for="username">Enter Username: </label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Enter Email: </label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary float-right">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


