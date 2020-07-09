<?php include("includes/header.php");
if (!$session->is_signed_in()) {
    redirect("login.php");
}
$products = Product::find_all();
?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<div class="container-fluid d-none d-lg-block">
    <div class="row">
        <div class="col-12">
            <h2 class="pt-5">Products</h2>
            <table class="table table-header">
                <thead>
                <tr>

                    <th>Product Image</th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Last Update</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($products as $product) :
                    ?>
                    <tr>
                        <td><img src="<?php echo $product->image_path_and_placeholder(); ?>" height="100" alt=""></td>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->description; ?></td>
                        <td><?php echo $product->price; ?></td>
                        <td><?php echo $product->stock; ?></td>

                        <td>
                            <?php
                            $category = Category::find_by_id($product->category_id);
                            echo $category->name;
                            ?>
                        </td>
                        <td>
                            <?php
                            $sub_category = Sub_category::find_by_id($product->sub_category_id);
                            if (empty($sub_category->name)) {
                                echo "None";
                            } else {
                                echo $sub_category->name;
                            }

                            ?>

                        </td>
                        <td><?php echo $product->created_at; ?></td>
                        <td><a href="edit_Product.php?id=<?php echo $product->id; ?>"
                               class="btn btn-danger rounded-0"><i class="fas fa-user-edit"></i></a></td>
                        <td><a href="delete_Product.php?id=<?php echo $product->id; ?>"
                               class="btn btn-danger rounded-0"><i class="fas fa-user-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid px-0 main-content d-lg-none">
    <div class="row w-100 mx-0">
        <div class="col-12">
            <h2 class="text-center pt-5">Products</h2>
            <hr>
            <?php
            $x = 0;
            foreach ($products as $product) : ?>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header inactive_accordion_header" id="heading<?php echo $x; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link dropdown-toggle p-0 w-100 inactive_collapse_text"
                                        data-toggle="collapse" data-target="#collapse<?php echo $x; ?>"
                                        aria-expanded="true" aria-controls="collapse<?php echo $x; ?>">
                                    <img class="float-left" src="<?php echo $product->image_path_and_placeholder(); ?>"
                                         height="50" alt="">
                                    <?php echo $product->name; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>ID: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->id; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Product: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->name; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Description: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->description; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Price: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->price; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Stock: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->stock; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Category: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php
                                        $category = Category::find_by_id($product->category_id);
                                        echo $category->name;
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Sub Category: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php
                                        $sub_category = Sub_category::find_by_id($product->sub_category_id);
                                        if (empty($sub_category->name)) {
                                            echo "None";
                                        } else {
                                            echo $sub_category->name;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around row">
                                    <div class="col-6 text-center">
                                        <h6>Last Update: </h6>
                                    </div>
                                    <div class="col-6 text-center">
                                        <?php echo $product->created_at; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-around">
                                    <a href="edit_Product.php?id=<?php echo $product->id; ?>" class="btn btn-primary">View
                                        or Edit Product</a>
                                    <a href="delete_Product.php?id=<?php echo $product->id; ?>" class="btn btn-danger">Delete
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $x++;
            endforeach;
            ?>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
