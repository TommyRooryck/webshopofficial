<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>
<?php

if (!$session->is_signed_in()) {
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))) {
    redirect("../access_denied");
}

if (empty($_GET['id'])) {
    redirect("products");
}

$product = Product::find_by_id($_GET['id']);
$category = Category::find_by_id($product->category_id);
$sub_category = Sub_category::find_by_id($product->sub_category_id);
$categories = Category::find_all();
$sub_categories = Sub_category::find_all();
$attributes = Attributes::find_all();

$specific_products = Specific_product::find_the_key($product->id);


if (isset($_POST['submit'])) {

    $all_color_quantity= array();
    $all_color_quantity = array_filter($_POST['color_quantity']);
    $all_color_quantity = array_values($all_color_quantity);
    if (array_sum($all_color_quantity) == trim($_POST['stock'])){
        $product->name = trim($_POST['name']);
        $product->description = trim($_POST['desc']);
        $product->price = trim($_POST['price']);
        $product->stock = trim($_POST['stock']);
        $product->created_at = date("Y/m/d");
        $product->category_id = trim($_POST['category']);
        $product->sub_category_id = trim($_POST['sub']);
        $product->save_image();
        $product->save();
        Photo::set_files_product($_FILES['file'], $product->id);


        foreach ($specific_products as $specific_product) {
            $specific_product->delete();
        }

        if (isset($_POST['attribute_value'])) {
            $all_values = count($_POST['attribute_value']);
            $all_attributes = array();
            $all_attributes = $_POST['attribute'];

            for ($i = 0; $i < $all_values; $i++) {
                $specific_product = new Specific_product();

                if (array_key_exists($i,$all_attributes)) {
                    $specific_product->attribute_id = trim($_POST['attribute'][$i]);
                }
                $specific_product->attribute_values_id = trim($_POST['attribute_value'][$i]);
                $specific_product->product_id = $product->id;

                if (array_key_exists($i,$all_color_quantity)) {
                    $specific_product->quantity = $all_color_quantity[$i];
                }

                $specific_product->save();
            }
        }

        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products successfully edited!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } elseif (empty($all_color_quantity)){
        $product->name = trim($_POST['name']);
        $product->description = trim($_POST['desc']);
        $product->price = trim($_POST['price']);
        $product->stock = trim($_POST['stock']);
        $product->created_at = date("Y/m/d");
        $product->category_id = trim($_POST['category']);
        $product->sub_category_id = trim($_POST['sub']);
        $product->set_file($_FILES['placeholder']);
        $product->create_image();
        $product->save();
        Photo::set_files_product($_FILES['file'], $product->id);


        if (isset($_POST['attribute_value'])) {
            $all_values = count($_POST['attribute_value']);
            $all_attributes = array();
            $all_attributes = $_POST['attribute'];

            for ($i = 0; $i < $all_values; $i++) {
                $specific_product = new Specific_product();

                if (array_key_exists($i,$all_attributes)) {
                    $specific_product->attribute_id = trim($_POST['attribute'][$i]);
                }
                $specific_product->attribute_values_id = trim($_POST['attribute_value'][$i]);
                $specific_product->product_id = $product->id;

                if (array_key_exists($i,$all_color_quantity)) {
                    $specific_product->quantity = $all_color_quantity[$i];
                }

                $specific_product->save();
            }
        }

        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Products successfully edited!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    } else{
        echo "
         <div class='row align-content-center justify-content-center w-100 mt-5 mx-auto'>
             <div class='col-lg-6'>
                <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
                    <strong>Color quantity does not match total product quantity!</strong>
                    <button type='button' class='close mt-lg-3' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                </div>
            </div>
        </div>
        ";
    }
//    redirect("products");

}
?>



<?php include (__DIR__ . "/templates/product_template.php")?>


<?php include("includes/footer.php"); ?>
