<?php
include("admin/includes/init.php");
ob_start();

$super_categories = Super_category::find_all();

?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="admin/img/favicon.ico">
    <link rel="stylesheet" href="admin/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <title>Little Blessings</title>
</head>

<body>
<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">

                <div class="col-lg-1 d-flex justify-content-between m-auto">
                    <a class="navbar-brand" href="index">Little Blessings</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span><i class="fas fa-bars"></i></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse col-lg-5 ml-auto text-center" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="shop">Shop <span class="sr-only">(current)</span></a>
                        </li>
                        <?php foreach ($super_categories as $super_category) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $super_category->name; ?>
                                </a>
                                <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                                    <?php
                                    $categories = Category::find_the_key($super_category->id);
                                    foreach ($categories as $category) :
                                        ?>
                                        <a class="dropdown-item" href="#"><?php echo $category->name; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <form class="form-inline col-lg-2 pt-3 pt-lg-0 ml-auto">
                    <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                    <input class="form-control mr-sm-2 col-10 col-lg-8" type="search" placeholder="Search" aria-label="Search">
                </form>
                <div class="<?php if ($session->is_signed_in()){echo "col-lg-2";}else{echo "col-lg-1";} ?>  pt-3 pt-lg-0  d-flex justify-content-around">
                    <a href="
                       <?php if ($session->is_signed_in()){
                        echo "my_account";
                    } else{
                        echo "login";
                    }
                    ?>
                    "><i class="fas fa-user-circle"></i></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a>
                    <?php
                    if ($session->is_signed_in()) {
                        echo " <a href=\"admin/logout\"><i class=\"fas fa-sign-out-alt\"></i></a>";
                    }
                    ?>
                    <?php
                    if ($session->is_signed_in() && !empty(Admin::check_admin_exist($_SESSION['username']))) {
                        echo " <a href=\"admin/index\"><i class=\"fas fa-tachometer-alt\"></i></a>";
                    }
                    ?>
                </div>
            </nav>
        </div>
    </div>
</div>
