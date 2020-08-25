<?php include ("includes/header.php")?>;

<?php

if (!isset($_GET['id'])){
    redirect("access_denied");
}

if (!empty(Customer::find_by_user_code($_GET['id']))){
    $customer = Customer::find_by_user_code($_GET['id']);

    if (isset($_POST['submit'])){
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $customer->password = $hashed_password;
        $customer->user_code = "";
        $customer->save();
        echo "
         <div class='row align-content-center justify-content-center w-100 pt-4'>
             <div class='col-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Password Reset Success - Confirmation Email Sent</strong>
                    <a href='login'>Click here to login</a>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";

        include("templates/mail/password_confirmation_email.php");

    } else{
        echo "
     <div class='container pt-5'>
    <div class='row justify-content-center'>
        <div class='col-12'>
            <h2 class='text-center'>Password Reset</h2>
            <div class='row justify-content-center pt-4'>
                <div class='col-lg-6'>
                    <form method='post'>
                        <div class='form group'>
                            <label for='password'>New Password:</label>
                            <input type='password' name='password' class='form-control'>
                        </div>
                        <input type='submit' name='submit' class='btn btn-primary float-right mt-4'>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
    ";
    }
}else{
    redirect("login");
}




?>


