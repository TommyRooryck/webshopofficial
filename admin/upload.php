<?php include("includes/header.php"); ?>
<?php

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}



$message = "";


if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->set_file($_FILES['upload']);
    $photo->product_id = $_POST['product'];
    $photo->description = $_POST['color'];
    $photo->save();

 //   redirect("photos");

}

$products= Product::find_all();
$attribute = Attributes::find_by('name', 'Kleur');

$colors = Attribute_values::find_the_key($attribute->id);


?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="p-5 text-center">Upload Photo</h1>
            <h5>
                <?php echo $message; ?>
            </h5>
            <form action="upload" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="product" class="form-control">
                                <?php usort($products, array('Product', 'order_by_name')); ?>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="color" class="form-control">
                                <?php usort($colors, array('Attribute_values', 'order_by_name')); ?>
                                <?php foreach ($colors as $color) : ?>
                                    <option value="<?php echo $color->name; ?>"><?php echo $color->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="file" name="upload" class="form-control-file" id="imgInp">
                            <img src="#" id="placeholder_img" alt="">
                        </div>


                        <input type="submit" name="submit" value="submit" class="btn btn-primary float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
