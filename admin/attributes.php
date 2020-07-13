<?php include("includes/header.php"); ?>

<?php

if (!$session->is_signed_in()) {
    redirect("login");
}

$attributes = Attributes::find_all();


$new_attribute = new Attributes();
$new_value = new Attribute_values();

if (isset($_POST['add_attribute'])) {
    $count_attributes = count($_POST['value']);

    $new_attribute->name = trim($_POST['name']);
    $new_attribute->save();

    for ($x = 0; $x < $count_attributes; $x++) {
        $new_value = new Attribute_values();
        $new_value->name = trim($_POST['value'][$x]);
        $new_value->attribute_id = trim($_POST['parent']);
        $new_value->save();
    }

}


?>


<?php // include ("includes/sidebar.php"); ?>
<?php include("includes/content_top.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1>Attributes</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center">Add Attributes</h2>
            <form method="post">
                <h5>Add Attribute</h5>
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" class="form-control">
                </div>

                <h5>Add Attribute Values</h5>
                <div class="form-group">
                    <label for="attribute">Attribute: </label>
                    <select name="parent" class="form-control">
                        <option value=""></option>
                        <option value="<?php echo $new_attribute->id; ?>">Current</option>
                        <?php foreach ($attributes as $attribute) : ?>
                            <option value="<?php echo $attribute->id; ?>"><?php echo $attribute->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="value[]">Attribute Value: </label>
                    <input type="text" name="value[]" class="form-control">

                    <div id="new_value">

                    </div>


                    <button type="button" id="add_element" class="btn btn-secondary mt-2 float-right">Add Value</button>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary mt-4" name="add_attribute" value="Add Attribute">
                </div>
            </form>
        </div>
        <div class="col-lg-6 pt-5 pt-lg-0">
            <h2 class="text-center">All Attributes</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Values</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($attributes as $attribute) : ?>
                    <tr>
                        <td><?php echo $attribute->id; ?></td>
                        <td><?php echo $attribute->name; ?></td>
                        <td><?php
                            $attribute_values = Attribute_values::find_the_key($attribute->id);
                            $myArray = array();
                            foreach ($attribute_values as $attribute_value) {
                                $myArray[] = $attribute_value->name;
                            }
                            echo implode(',', $myArray);

                            ?></td>
                        <td><a href="edit_Attribute.php?id=<?php echo $attribute->id; ?>"
                               class="btn btn-danger rounded-0"><i
                                        class="fas fa-user-edit"></i></a></td>
                        <td><a href="delete_Attribute.php?id=<?php echo $attribute->id; ?>"
                               class="btn btn-danger rounded-0"><i
                                        class="fas fa-user-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>


            </table>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
