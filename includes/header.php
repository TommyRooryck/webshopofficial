<?php
include("admin/includes/init.php");
ob_start();


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
<div class="container-fluid p-0">
    <div class="row w-100 m-0" id="top_nav">
        <div class="col-12 p-0">
            <nav class="navbar navbar-expand-lg ">
                <div class="row w-100 d-flex d-lg-flex d-md-block justify-content-around">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-between d-lg-block">

                            <div class="col-7 col-lg-12 p-lg-3 text-left">
                                <a class="navbar-brand" href="index">Little Blessings</a>
                            </div>

                            <div class="col-lg-4 col-6 col-md-4 show_menu_toggle text-right">
                                <button class="navbar-toggler border-dark rounded" type="button" data-toggle="collapse"
                                        data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation" id="navbar-toggler">
                                    <i class="fas fa-bars text-dark" id="bars-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row text-center w-100 pl-5">
                            <div class="col-lg-12">
                                <div class="col-lg-12 pl-5 pr-0">
                                    <div class="collapse navbar-collapse px-auto" id="navbarTogglerDemo02">
                                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 d-lg-none justify-content-around">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="#"><span>Home</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#"><span>Shop</span></a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                   id="navbarDropdownMenuLink"
                                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    Categorie 1
                                                </a>
                                                <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                    aria-labelledby="navbarDropdownMenuLink">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                   id="navbarDropdownMenuLink"
                                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    Categorie 2
                                                </a>
                                                <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                    aria-labelledby="navbarDropdownMenuLink">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                   id="navbarDropdownMenuLink"
                                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    Categorie 3
                                                </a>
                                                <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                    aria-labelledby="navbarDropdownMenuLink">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pl-5 pl-lg-0">
                        <div class="col-lg-12 d-lg-flex justify-content-between pt-3">
                            <div class="row text-center" id="top_nav_items">
                                <div class="col-lg-12 d-none d-lg-block">
                                    <div class="col-lg-12">
                                        <div class="collapse navbar-collapse px-auto" id="navbarTogglerDemo02">
                                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 d-lg-flex justify-content-around">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="#"><span>Home</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"><span>Shop</span></a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#"
                                                       id="navbarDropdownMenuLink"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Categorie 1
                                                    </a>
                                                    <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                        aria-labelledby="navbarDropdownMenuLink">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </ul>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#"
                                                       id="navbarDropdownMenuLink"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Categorie 2
                                                    </a>
                                                    <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                        aria-labelledby="navbarDropdownMenuLink">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </ul>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#"
                                                       id="navbarDropdownMenuLink"
                                                       role="button" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Categorie 3
                                                    </a>
                                                    <ul class="dropdown-menu text-center" id="dropdown_menu"
                                                        aria-labelledby="navbarDropdownMenuLink">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4" id="search_bar">
                                <form class="form-inline my-2 my-lg-0">
                                    <a href="#">
                                        <i class="fas fa-search pr-3 "></i>
                                    </a>
                                    <input class="form-control w-75 " type="search" placeholder="Search">
                                </form>
                            </div>

                            <div class="row text-center d-flex justify-content-around col-lg-2">
                                <div class="col-3">
                                    <a href="login">
                                        <i class="fas fa-user-alt"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>

                                <?php
                                if ($session->is_signed_in()) {
                                    echo "  <div class=\"col-3\">
                                    <a href=\"admin/logout\">
                                        <i class=\"fas fa-sign-out-alt\"></i>
                                    </a>
                                </div>
                                ";
                                }
                                ?>

                                <?php
                                if ($session->is_signed_in() && !empty(Admin::check_admin_exist($_SESSION['username']))) {
                                    echo "<div class=\"col-3\">
                                    <a href=\"admin/index\">
                                        <i class=\"fas fa-tachometer-alt\"></i>
                                    </a>
                                </div>";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</div>


