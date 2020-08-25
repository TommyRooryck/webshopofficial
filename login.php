<?php include("includes/header.php"); ?>
<?php

if ($session->is_signed_in()) {
    redirect("my_account");
}

$msg = '';


if (isset($_POST['submit_login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (Customer::find_by_username($_POST['username'])) {
        $customer = Customer::find_by_username($_POST['username']);
        $hashed_password = $customer->password;

        if (password_verify($password, $hashed_password)) {
            if (!empty($_POST['remember_me'])) {
                setcookie("customer_username", $_POST['username'], time() + (86400 * 30), "/");
                setcookie("customer_password", $_POST['password'], time() + (86400 * 30), "/");
            } else {
                if (isset($_COOKIE['customer_username'])) {
                    setcookie("customer_login", "");
                }
                if (isset($_COOKIE['customer_password'])) {
                    setcookie("customer_password", "");
                }
            }
            $session->login($customer);
            redirect("index");
        }
    } elseif (Admin::find_by_username($_POST['username'])) {
        $admin = Admin::find_by_username($_POST['username']);
        $hashed_password = $admin->password;

        if (password_verify($password, $hashed_password)) {
            if (!empty($_POST['remember_me'])) {
                setcookie("customer_username", $_POST['username'], time() + (86400 * 30), "/");
                setcookie("customer_password", $_POST['password'], time() + (86400 * 30), "/");
            } else {
                if (isset($_COOKIE['customer_username'])) {
                    setcookie("customer_login", "");
                }
                if (isset($_COOKIE['customer_password'])) {
                    setcookie("customer_password", "");
                }
            }
            $session->login($admin);
            redirect("admin/index");
        }
    } else {
        $msg = "Uw gebruikersnaam en wachtwoorden komen niet overeen";
    }

} else {
    $username = "";
    $password = "";
}


$customer = new Customer();
$message = "";


if (isset($_POST['submit_register'])) {
    $email_register = trim($_POST['email_register']);
    $username_register = trim($_POST['username_register']);
    $password_register = trim($_POST['password_register']);
    $hashed_password_register = password_hash($password_register, PASSWORD_DEFAULT);

    $email = trim($_POST['email_register']);

    if (empty($customer->check_customer_exist(trim($_POST['username_register']))) && empty(Admin::check_admin_exist(trim($_POST['username_register'])))) {
        $customer->email = $email;
        $customer->username = $username_register;
        $customer->password = $hashed_password_register;
        $customer->save();
        $session->login($customer);
        $_SESSION['username'] = $username;
        redirect("my_account");

        include("templates/mail/registration_email.php");

    } else {
        $message = "Username is already taken!";
    }
} else {
    $email_register = "";
    $username_register = "";
    $password_register = "";
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 text-center pt-5">
            <h1>Login</h1>
            <hr>
        </div>
    </div>
</div>
<div class="container pt-5 pt-lg-0">
    <div class="row align-items-center">
        <div class="col-12 d-sm-flex">
            <div class="col-md-6">
                <div class="login_form">
                    <h3 class="text-center text-lg-left pb-5 pb-lg-0">Welkom Terug!</h3>
                    <h5 class="text-danger"><?php echo $msg; ?></h5>
                    <form method="post" class="form_input">
                        <div class="form-group">
                            <input type="text" required  class="form-control" name="username" placeholder="Gebruikersnaam"
                                   value="<?php if (isset($_COOKIE['customer_username'])){
                                       echo $_COOKIE['customer_username'];
                                   } echo htmlentities($username); ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" required class="form-control " name="password" placeholder="Wachtwoord"
                                   value="<?php if (isset($_COOKIE['customer_password'])) {
                                       echo $_COOKIE['customer_password'];
                                   }htmlentities($password); ?>">
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="px-2"><input type="checkbox" <?php if (isset($_COOKIE['customer_username'])) {
                                    echo "checked";
                                } ?> name="remember_me"></span>
                            <span class="text-secondary remember_me"><label class="mb-0"
                                                                            for="checkbox">Remember me</label></span>
                        </div>
                        <div class="col-12 pt-3 px-0">
                            <button type="submit" name="submit_login" value="submit" class="btn w-100 mt-lg-4">
                                log in
                            </button>
                        </div>
                        <div class="col-12 pt-3 px-0">
                            <a class="float-right" href="password_reset">Forget Password?</a>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-6 text-white text-center mt-5 pt-5 mt-lg-0 <?php if ($message) {
                echo "d-none";
            } ?>" id="register">
                <div class="registration_form text-center bg-dark">
                    <div class="login_part_text text-center">
                        <h2 class="pt-lg-5">Nieuw bij onze winkel?</h2>
                        <p class="pt-5">Maak je account aan en geniet van tal van
                            voordelen tijdens promotiedagen!</p>
                        <button class="btn mt-lg-5" id="register_button">Maak je account aan</button>
                    </div>

                </div>
            </div>

            <div class="col-md-6 login_form text-center text-lg-left mt-5 mt-sm-0 <?php if (!$message) {
                echo "d-none";
            } else {
                echo "d-block";
            } ?>" id="registration">
                <div class="registration_part_form">
                    <div class="login_part_form_iner">
                        <h3>Maak Account aan</h3>
                        <form class="row contact_form" method="post">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="rounded form-control" required id="email_register"
                                       name="email_register" value="<?php echo htmlentities($email_register); ?>"
                                       placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="rounded form-control" required id="username_register"
                                       name="username_register"
                                       value="<?php echo htmlentities($username_register); ?>"
                                       placeholder="Gebruikersnaam">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="rounded form-control" required id="password_register"
                                       name="password_register"
                                       value="<?php echo htmlentities($password_register); ?>"
                                       placeholder="Wachtwoord">
                            </div>
                            <div class="col-md-12 text-right">
                                <h5 class="text-danger text-left"><?php echo $message; ?></h5>
                                <button type="submit" name="submit_register" value="submit"
                                        class="btn w-100 mt-4 mt-lg-0">
                                    maak account aan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<?php include("includes/footer.php"); ?>
