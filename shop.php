<?php include("includes/header.php"); ?>

<?php $products = Product::find_all(); ?>

<section class="latest-padding">
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <?php foreach ($products

                                   as $product) : ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <a href="product_details?id=<?php echo $product->id; ?>">
                                <div class="mb-50 text-center single-popular-items">
                                    <div class="popular-img">
                                        <img class="img-fluid"
                                             src="<?php echo $product->image_path_and_placeholder_front(); ?>" style="height:380px" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3>
                                            <a href="product_details?id=<?php echo $product->id; ?>"> <?php echo $product->name; ?></a>
                                        </h3>
                                        <span>€<?php echo $product->price; ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>

