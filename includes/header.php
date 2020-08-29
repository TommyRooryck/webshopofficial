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
    <link rel="shortcut icon" type="image/x-icon" href="admin/img/logo_without_text.png">
    <link rel="stylesheet" href="admin/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <title>Little Blessings</title>
</head>

<body>
<div class="container-fluid p-0">
    <div class="row w-100 justify-content-around align-items-center mx-auto">
        <div class="col-lg-4 text-center p-3 p-lg-0">
            <a href="index"><img id="horizontalImg" class="img-center" src="admin/img/horizontal_logo.png" alt=""></a>
        </div>
        <div class="col-lg-5 p-3 p-lg-0 d-flex flex-row align-items-center">
            <form class="flex-row d-flex flex-fill border border-darker rounded-pill pl-4" action="">
                <input type="text" class="form-control p-0 pl-1 border-0" placeholder="Zoeken...">
                <button id="searchButton" type="submit" class="btn px-3 border-0 rounded-pill">Zoeken</button>
            </form>
        </div>
        <div class="col-lg-3 d-flex flex-row justify-content-around p-3 p-lg-0 i-hover">
            <a href="<?php if ($session->is_signed_in()) {
                echo "my_account";
            } else {
                echo "login";
            } ?>"><i class="far fa-user-circle main-color fa-2x"></i></a>
            <a href="cart"><i class="fas fa-shopping-cart fa-2x main-color"></i></a>
            <?php if ($session->is_signed_in()) : ?>
                <a href="admin/logout"><i class="fas fa-sign-out-alt fa-2x main-color"></i></a>
            <?php endif; ?>
            <?php if ($session->is_signed_in() && !empty(Admin::check_admin_exist($_SESSION['username']))): ?>
                <a href="admin/index"><i class="fas fa-tachometer-alt fa-2x main-color"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row w-100 mx-auto bg-main-color justify-content-end justify-content-lg-center my-3">
        <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class=" custom-nav-link" href="index">Home</a>
                    <a class=" custom-nav-link" href="shop">Shop</a>
                    <?php foreach ($super_categories as $super_category) : ?>
                        <li class="nav-item dropdown">
                            <a class="custom-nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $super_category->name; ?>
                            </a>
                            <div class="dropdown-menu text-center dropright ml-lg-3 mt-lg-3" aria-labelledby="navbarDropdown">
                                <?php
                                $categories = Category::find_the_key($super_category->id);
                                foreach ($categories as $category) :
                                    $sub_categories = Sub_category::find_the_key($category->id);
                                    if ($sub_categories): ?>
                                        <div class=" sub-dropdown">
                                            <div class="dropdown show">
                                                <a class="dropdown-item dropdown-toggle" href="#" role="button"
                                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    <?php echo $category->name; ?>
                                                </a>

                                                <div class="dropdown-menu sub-dropdown-menu text-right"
                                                     aria-labelledby="dropdownMenuLink">
                                                    <?php foreach ($sub_categories as $sub_category): ?>
                                                        <a class="dropdown-item"
                                                           href="<?php echo "shop?sub_category={$sub_category->name}";?>"><?php echo $sub_category->name; ?></a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                        </div>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?php echo "shop?category={$category->name}"; ?>">
                                            <?php echo $category->name; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </div>
</div>






