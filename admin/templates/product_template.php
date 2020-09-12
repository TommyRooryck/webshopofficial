<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <h1 class="text-center"><?php if (isset($product)){ echo "Edit Product"; }else{echo "Add Product";}  ?></h1>
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
                            <input type="text" name="name" class="form-control" value="<?php if (isset($product)){ echo $product->name;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control" cols="30"
                                      rows="10"><?php if (isset($product)){ echo $product->description;} ?> </textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="placeholder">Product Image</label> <br>
                            <?php if (isset($product)): ?>
                            <img src=" <?php  echo $product->image_path_and_placeholder(); ?>" id="placeholder_img"
                                 alt="">
                            <?php else: ?>
                            <img src="#" id="placeholder_img" alt="">
                            <?php endif; ?>
                            <input type="file" name="placeholder" id="imgInp" class="form-control-file">

                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" value="<?php if (isset($product)){ echo $product->price; } ?>">
                        </div>


                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control"
                                   value="<?php if (isset($product)){ echo $product->stock;} ?>">
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
                                } else{
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
                                        <table class="table table-hover">
                                            <tr>
                                                <th class="col-4"><label
                                                            for="attribute_value[]"><?php echo $attribute_value->name; ?></label>
                                                </th>
                                                <td class="col-4">
                                                    <?php if (!empty($specific_attribute_value)): ?>
                                                        <?php foreach ($specific_attribute_value as $specific_product) :?>
                                                            <input type="number" name="color_quantity[]" min="0"
                                                                   value="<?php
                                                                   echo $specific_product->quantity;  ?>" >
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <input type="number" min="0" name="color_quantity[]">
                                                    <?php endif; ?>
                                                </td>

                                                <td class="col-4">
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
                                    <div class="col-lg-4 col-md-4 col-6 text-center">
                                        <img src="<?php echo $photo->picture_path(); ?>"
                                             class="p-3 img-fluid preview-img" alt="">
                                        <a onclick=""
                                           href="delete_Photo_Product.php?id=<?php echo $photo->id; ?>&product=<?php echo $product->id; ?>"><i
                                                    class="far fa-trash-alt fa-lg"></i></a>
                                    </div>
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