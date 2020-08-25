<?php include("includes/header.php"); ?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 6;

$product_total_count = Product::count_all();

$paginate = new Paginate($page, $items_per_page, $product_total_count);

$products = Product::paginate($items_per_page, $paginate->offset());


?>


    <div class="container pt-5">
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
                                             src="<?php echo $product->image_path_and_placeholder_front(); ?>" style="height: 360px;" alt="">
                                    </div>
                                    <div class="popular-caption">
                                        <h3>
                                            <a href="product_details?id=<?php echo $product->id; ?>"> <?php echo $product->name; ?></a>
                                        </h3>
                                        <span>€<?php $price = number_format($product->price, 2); echo $price; ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row flex-row pt-4">
                    <div class="col-lg-12 text-center d-flex justify-content-center">
                        <div class="col-lg-4">
                            <ul class="pager d-flex flex-fill list-unstyled">
                                <?php

                                if ($page == 1 ){
                                    for ($i = 1; $i <= $paginate->page_total(); $i++) {
                                        if ($i == $paginate->current_page) {
                                            echo "<li class='active flex-fill '><a class='pagination-link active-pagination-link' href='shop?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='flex-fill '><a class='pagination-link' href='shop?page={$i}'>{$i}</a></li>";
                                        }
                                    }
                                    echo "<li class= 'next flex-fill '> <a class='pagination-link' href='shop?page={$paginate->next()}'>Next</a></li>";
                                } else{
                                    echo "<li class='previous flex-fill'><a class='pagination-link' href='shop?page={$paginate->previous()}'>Previous</a></li>";

                                    for ($i = 1; $i <= $paginate->page_total(); $i++) {
                                        if ($i == $paginate->current_page) {
                                            echo "<li class='active flex-fill '><a class='pagination-link active-pagination-link'  href='shop?page={$i}'>{$i}</a></li>";
                                        } else {
                                            echo "<li class='flex-fill '><a class='pagination-link' href='shop?page={$i}'>{$i}</a></li>";
                                        }
                                    }
                                    echo "<li class= 'next flex-fill '> <a class='pagination-link' href='shop?page={$paginate->next()}'>Next</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include("includes/footer.php"); ?>

