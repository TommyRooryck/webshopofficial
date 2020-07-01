<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}

if (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied.php");
}

if (empty($_GET['id'])){
    redirect('users.php');
}


$customer = Customer::find_by_id($_GET['id']);

if ($customer){
    $customer->delete();
    redirect('customers.php');
} else{
    redirect('customers.php');
}

?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content-top.php"); ?>
    <h1>Welkom delete pagina</h1>
<?php include ("includes/footer.php");
