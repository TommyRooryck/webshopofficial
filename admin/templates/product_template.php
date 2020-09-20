<?php $first = true; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <h1 class="text-center"><?php if (isset($product)) {
                    echo "Edit Product";
                } else {
                    echo "Add Product";
                } ?></h1>
            <form
                <?php if (isset($product)): ?>
                    action="edit_Product.php?id=<?php echo $product->id; ?>"
                <?php else: ?>
                    action="add_Product.php"
                <?php endif; ?>
                    method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if (isset($product)) {
                                echo $product->name;
                            } ?>">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control" cols="30"
                                      rows="10"><?php if (isset($product)) {
                                    echo $product->description;
                                } ?> </textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="placeholder">Product Image</label> <br>
                            <?php if (isset($product)): ?>
                                <img src=" <?php echo $product->image_path_and_placeholder(); ?>" id="placeholder_img"
                                     alt="">
                            <?php else: ?>
                                <img src="#" id="placeholder_img" alt="">
                            <?php endif; ?>
                            <input type="file" name="placeholder" id="imgInp" class="form-control-file">

                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" value="<?php if (isset($product)) {
                                echo $product->price;
                            } ?>">
                        </div>


                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control"
                                   value="<?php if (isset($product)) {
                                       echo $product->stock;
                                   } ?>">
                        </div>

                        <div class="form-group">
                            <label for="category">Select category</label>
                            <select name="category" class="form-control">
                                <?php if (isset($category)) : ?>
                                    <option value="<?php echo $category->id ?>"
                                            style='background: #cfe3f1'><?php echo $category->name; ?></option>
                                <?php endif; ?>
                                <?php usort($categories, array("Category", "order_by_name")); ?>
                                <?php foreach ($categories as $category_option) : ?>
                                    <?php if (!isset($category) || $category->name != $category_option->name): ?>
                                        <option value="<?php echo $category_option->id; ?>"><?php echo $category_option->name; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sub">Select Sub Category (if needed)</label>
                            <select name="sub" class='form-control'>
                                <?php
                                if (isset($sub_category)) {
                                    if ($sub_category->id == 0) {
                                        echo "   <option value=\"0\">None</option>";
                                    } else {
                                        echo " <option value=\"$sub_category->id>\"  style='background: #cfe3f1'> $sub_category->name </option>";
                                    }
                                } else {
                                    echo "   <option value=\"0\">None</option>";
                                }
                                ?>
                                <?php usort($sub_categories, array("Sub_category", "order_by_name")); ?>
                                <?php foreach ($sub_categories as $sub_category_option) : ?>
                                    <?php if (!isset($sub_category) || $sub_category->name != $sub_category_option->name): ?>
                                        <option value="<?php echo $sub_category_option->id; ?>"><?php echo $sub_category_option->name; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <?php
                            $y = 0;
                            usort($attributes, array("Attributes", "order_by_name"));
                            foreach ($attributes

                                     as $attribute) :
                                if (isset($product)) {
                                    $specific_attribute = Specific_product::find_specific_product_attribute($attribute->id, $product->id);
                                }
                                ?>
                                <div class="form-group">
                                <?php if ($attribute->name === "Tekst"): ?>
                                <label for="attribute[]"><h5><?php echo $attribute->name; ?></h5>
                                </label>
                                <input type="checkbox"
                                       value="<?php echo $attribute->id; ?>"
                                       name="attribute[]"
                                    <?php
                                    if (!empty($specific_attribute)) {
                                        echo "checked";
                                    }
                                    ?> >

                            <?php else: ?>

                                <label for="attribute[]"><h5><?php echo $attribute->name; ?></h5>
                                </label>
                                <input type="checkbox"
                                       value="<?php echo $attribute->id; ?>"
                                       name="attribute[]"
                                    <?php
                                    if ($specific_attribute) {
                                        echo "checked";
                                    }
                                    ?> data-toggle="collapse" data-target="#collapse<?php echo $y; ?>"">
                                <div
                                        class="
                                            row
                                            values
                                            collapse
                                             <?php
                                        if ($specific_attribute) {
                                            echo "show";
                                        }
                                        ?>
                                            "
                                        id="collapse<?php echo $y; ?>">
                                    <div class="table-responsive">


                                        <?php
                                        $attribute_values = Attribute_values::find_the_key($attribute->id);
                                        usort($attribute_values, array("Attribute_values", "order_by_name"));

                                        foreach ($attribute_values

                                                 as $attribute_value) :
                                            if (isset($product)) {
                                                $specific_attribute_value = Specific_product::find_specific_product_attribute_value($attribute_value->id, $product->id);
                                            }
                                            ?>
                                            <?php if ($attribute->name === "Kleur") : ?>
                                            <table class="table table-hover w-100">
                                                <thead class="d-flex w-100">
                                                <?php if ($first) : ?>
                                                    <tr class="d-flex w-100">
                                                        <th class="col-5 col-lg-3">Kleur</th>
                                                        <th class="col-9 col-lg-5 text-center">Photo</th>
                                                        <th class="col-6 col-lg-3 text-center">Quantity</th>
                                                        <th class="col-2 col-lg-1 text-center">Check</th>
                                                    </tr>
                                                    <?php $first = false; ?>
                                                <?php endif; ?>
                                                </thead>
                                                <tbody>
                                                <tr class="d-flex w-100">
                                                    <th class="col-5 col-lg-3"><label
                                                                for="attribute_value[]"><?php echo $attribute_value->name; ?></label>
                                                    </th>
                                                    <td class="col-9 col-lg-5 justify-content-center d-flex">
                                                        <?php if (isset($product)) : ?>
                                                        <?php $photo = Photo::find_by('description', $attribute_value->name); ?>
                                                            <?php if (!empty($photo)): ?>
                                                                <div class="text-center">
                                                                    <img src="<?php echo $photo->picture_path(); ?>" style="width: 100px; height: 100px" alt="">
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php else:  ?>
                                                        <input type="file"  name="photos[]" id="gallery-photo-add"
                                                               class="form-control-file">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="col-6 col-lg-3 text-center">
                                                        <?php if (!empty($specific_attribute_value)): ?>
                                                            <?php foreach ($specific_attribute_value as $specific_product) : ?>
                                                                <input type="number" class="col-5"
                                                                       name="color_quantity[]"
                                                                       min="0"
                                                                       value="<?php
                                                                       echo $specific_product->quantity; ?>">
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <input class="col-5" type="number" min="0"
                                                                   name="color_quantity[]">
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="col-2 col-lg-1 text-center">
                                                        <input
                                                                type="checkbox"
                                                                name="attribute_value[]"
                                                                value="<?php echo $attribute_value->id; ?>"
                                                            <?php

                                                            if ($specific_attribute_value) {
                                                                echo "checked";
                                                            }
                                                            ?>
                                                        >
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <table class="table table-hover">
                                                <tr>
                                                    <th class="col-6"><label
                                                                for="attribute_value[]"><?php echo $attribute_value->name; ?></label>
                                                    </th>
                                                    <td class="col-6">
                                                        <input
                                                                type="checkbox"
                                                                name="attribute_value[]"
                                                                value="<?php echo $attribute_value->id; ?>"
                                                            <?php

                                                            if ($specific_attribute_value) {
                                                                echo "checked";
                                                            }
                                                            ?>
                                                        >
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                </div>
                                <?php
                                $y++;
                            endif;
                            endforeach; ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 d-flex flex-wrap">
                                <?php
                                if (isset($product)):
                                    $photos = Photo::find_the_key($product->id);
                                    foreach ($photos as $photo) :
                                        ?>
                                    <?php if (empty($photo->description)) : ?>
                                        <div class="col-lg-4 col-md-4 col-6 text-center">
                                            <img src="<?php echo $photo->picture_path(); ?>"
                                                 class="p-3 img-fluid preview-img" alt="">
                                            <a onclick=""
                                               href="delete_Photo_Product.php?id=<?php echo $photo->id; ?>&product=<?php echo $product->id; ?>"><i
                                                        class="far fa-trash-alt fa-lg"></i></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="upload[]">More Photos: </label>
                            <input type="file" name="file[]" id="gallery-photo-add" multiple="multiple"
                                   class="form-control-file">
                            <div class="gallery">

                            </div>
                        </div>
                        <input type="submit" name="submit" value="Update Product"
                               class="btn btn-primary mb-5 float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>