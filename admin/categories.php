<?php include("includes/header.php"); ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}

$super_category = new Super_category();
$super_categories = Super_category::find_all();
$msg = "";


if (isset($_POST['submit'])) {
    if ($super_category) {
        $super_category->name = trim($_POST['name']);
        $super_category->description = trim($_POST['desc']);
        $super_category->save();
        redirect("categories.php");
    } else {
        $msg = "Super Category could not be made";
    }
}


?>


<?php  include ("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1>Categories</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <?php echo $msg; ?>
    </div>
    <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center">Add New Super Category</h2>
            <form method="post">
                <div class="form-group">
                    <label for="name">Super Category Name</label>
                    <input type="text" required name="name" class="form-control" placeholder="Enter Super Category">
                    <small class="form-text text-muted">How it will be displayed on the website.</small>
                </div>

                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="desc" required class="form-control" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-primary float-right float-lg-left">Submit</button>
            </form>
        </div>

        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center">All Categories</h2>

            <?php
            $x = 0;
            foreach ($super_categories

                     as $super_category) :
                ?>
                <div>
                </div>
                <div class="accordion" id="accordion<?php echo $x; ?>">
                    <div class="card">
                        <div class="card-header accordion_header" id="heading<?php echo $x; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link w-100 accordion_header " type="button" data-toggle="collapse"
                                        data-target="#collapse<?php echo $x; ?>" aria-expanded="true"
                                        aria-controls="collapse<?php echo $x; ?>">
                                    <?php echo $super_category->name; ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>"
                             data-parent="#accordion<?php echo $x; ?>">
                            <div class="card-body">
                                <?php
                                $y = rand(1000, 1000000000000);
                                $categories = Category::find_the_key($super_category->id);
                                foreach ($categories

                                         as $category) :
                                    ?>
                                    <div class="accordion" id="accordion<?php echo $y; ?>">
                                        <div class="card">
                                            <div class="card-header collapse_level_one" id="heading<?php echo $y; ?>">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link w-100 collapse_level_one" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#collapse<?php echo $y; ?>"
                                                            aria-expanded="true"
                                                            aria-controls="collapse<?php echo $y; ?>">
                                                        <?php echo $category->name; ?>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapse<?php echo $y; ?>" class="collapse"
                                                 aria-labelledby="heading<?php echo $y; ?>"
                                                 data-parent="#accordion<?php echo $y; ?>">
                                                <div class="card-body">
                                                    <?php
                                                    $y = rand(1000, 1000000000000);
                                                    $sub_categories = Sub_category::find_the_key($category->id);
                                                    foreach ($sub_categories

                                                             as $sub_category) :
                                                        ?>
                                                        <div class="accordion" id="accordion<?php echo $y; ?>">
                                                            <div class="card">
                                                                <div class="card-header collapse_level_two"
                                                                     id="heading<?php echo $y; ?>">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-link w-100 collapse_level_two"
                                                                                type="button"
                                                                                data-toggle="collapse"
                                                                                data-target="#collapse<?php echo $y; ?>"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapse<?php echo $y; ?>">
                                                                            <?php echo $sub_category->name; ?>
                                                                        </button>
                                                                    </h2>
                                                                </div>

                                                                <div id="collapse<?php echo $y; ?>" class="collapse"
                                                                     aria-labelledby="heading<?php echo $y; ?>"
                                                                     data-parent="#accordion<?php echo $y; ?>">
                                                                    <div class="card-body">
                                                                        <div class="d-flex justify-content-around mt-3">
                                                                            <a href="edit_Sub_Category.php?id=<?php echo $sub_category->id; ?>"
                                                                               class="btn btn-success">View or Edit Sub
                                                                                Category</a>
                                                                            <a href="delete_Sub_Category.php?id=<?php echo $sub_category->id; ?>"
                                                                               class="btn btn-danger">Delete Sub
                                                                                Category</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $y++;
                                                    endforeach;
                                                    ?>
                                                    <div class="div float-right d-flex add_category_form pb-5">
                                                        <label class="form-check-label add_sub_category_form_label">Category Options</label>
                                                        <input class="form-check-input add_sub_category_check"
                                                               type="checkbox"">
                                                    </div>
                                                    <div class="add_sub_category_form">
                                                        <hr>
                                                        <div>
                                                            <h6 class="text-center">Add New Sub Category</h6>
                                                        </div>
                                                        <form method="post" class="w-75 m-auto">
                                                            <div class="form-group">
                                                                <input type="text" name="sub_category_name" required
                                                                       placeholder="Enter Sub Category Name"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="formgroup">
                                                                <textarea name="sub_category_description" required
                                                                          class="form-control" cols="35" rows="5"
                                                                          placeholder="Add Description"></textarea>
                                                            </div>
                                                            <button type="submit" name="add_sub_category"
                                                                    class="btn btn-primary my-3">
                                                                Add Sub Category
                                                            </button>
                                                        </form>

                                                        <div class="d-flex justify-content-around mt-3">
                                                            <a href="edit_Category.php?id=<?php echo $category->id; ?>"
                                                               class="btn btn-success">View or Edit Category</a>
                                                            <a href="delete_Category.php?id=<?php echo $category->id; ?>"
                                                               class="btn btn-danger">Delete Category</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $y++;
                                endforeach;
                                ?>

                                <?php

                                if (isset($_POST['add_sub_category'])) {
                                    $name = trim($_POST['sub_category_name']);
                                    $description = trim($_POST['sub_category_description']);

                                    $new_sub_category = Sub_category::create_sub_category($name, $description, $category->id);

                                    if ($new_sub_category && $new_sub_category->save()) {
                                        redirect("categories.php");
                                    } else {
                                        $msg = "Sub Category could not be saved";
                                    }


                                } else {
                                    $name = "";
                                    $description = "";
                                }
                                ?>
                                <div class="div float-right d-flex pb-5">
                                    <label class="form-check-label add_category_form_label">Super Category Options</label>
                                    <input class="form-check-input add_category_check" type="checkbox"">
                                </div>
                                <div class="add_category_form">
                                    <hr>
                                    <div>
                                        <h6 class="text-center">Add New Category</h6>
                                    </div>
                                    <form method="post" class="w-75 m-auto">
                                        <div class="form-group">
                                            <input type="text" name="category_name" required
                                                   placeholder="Enter Category Name"
                                                   class="form-control">
                                        </div>
                                        <div class="formgroup">
                                        <textarea name="category_description" required class="form-control" cols="35"
                                                  rows="5"
                                                  placeholder="Add Description"></textarea>
                                        </div>
                                        <button type="submit" name="add_category" class="btn btn-primary my-3">Add
                                            Category
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="d-flex justify-content-around mt-3">
                                        <a href="edit_Super_Category.php?id=<?php echo $super_category->id; ?>"
                                           class="btn btn-success">View or Edit Super Category</a>
                                        <a href="delete_Super_Category.php?id=<?php echo $super_category->id; ?>"
                                           class="btn btn-danger">Delete Super Category</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $x++;
            endforeach;
            ?>

            <?php
            if (isset($_POST['add_category'])) {
                $name = trim($_POST['category_name']);
                $description = trim($_POST['category_description']);

                $new_category = Category::create_category($name, $description, $super_category->id);

                if ($new_category && $new_category->save()) {
                    redirect("categories.php");
                } else {
                    $msg = "Category could not be saved";
                }
            } else {
                $name = "";
                $description = "";
            }
            ?>

        </div>
    </div>
</div>



</body>
</html>

<?php include("includes/footer.php"); ?>
