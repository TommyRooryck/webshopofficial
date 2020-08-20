<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

if (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied.php");
}

if (empty($_GET['id'])){
    redirect('users.php');
}

$admin = Admin::find_by_id($_GET['id']);

if ($admin){
    $admin->delete();
    redirect('users.php');
} else{
    redirect('users.php');
}

?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content-top.php"); ?>
    <h1>Welkom delete pagina</h1>
<?php include ("includes/footer.php");
