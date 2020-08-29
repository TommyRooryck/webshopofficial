<?php include("includes/header.php"); ?>

<?php

if (isset($_GET['category'])){


    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    $items_per_page = 6;

    $category_name = $_GET['category'];

    $category = Category::find_by('name', $category_name);

    $product_total_count = Product::count_by_column('category_id', $category->id);

    $paginate = new Paginate($page, $items_per_page, $product_total_count);

    $products = Product::paginate_categories($items_per_page, $paginate->offset(), $category->id);


} elseif (isset($_GET['sub_category'])){


    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    $items_per_page = 6;

    $category_name = $_GET['sub_category'];

    $category = Sub_category::find_by('name', $category_name);

    $product_total_count = Product::count_by_column('sub_category_id', $category->id);

    $paginate = new Paginate($page, $items_per_page, $product_total_count);

    $products = Product::paginate_sub_categories($items_per_page, $paginate->offset(), $category->id);



} else{
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    $items_per_page = 6;

    $product_total_count = Product::count_all();

    $paginate = new Paginate($page, $items_per_page, $product_total_count);

    $products = Product::paginate($items_per_page, $paginate->offset());
}




?>


<?php include ("templates/products_template.php"); ?>



<?php include("includes/footer.php"); ?>

