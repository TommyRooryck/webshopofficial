<?php include ("includes/header.php"); ?>
<?php

if (!$session->is_signed_in()){
    redirect('login');
} elseif (empty(Admin::check_admin_exist($_SESSION['username']))){
    redirect("../access_denied");
}

$attribute = Attributes::find_by_id($_GET['id']);
$attribute_values = Attribute_values::find_the_key($attribute->id);


if (isset($_POST['add_value'])){
    $count_attributes = count($_POST['value']);
    for ($x = 0; $x < $count_attributes; $x++) {
        $new_value = new Attribute_values();
        $new_value->name = trim($_POST['value'][$x]);
        $new_value->attribute_id = $attribute->id;
        $new_value->save();
        redirect("edit_Attribute.php?id=" . $attribute->id);
    }
}

if (isset($_POST['edit_name'])){
    $attribute->name = $_POST['name'];
    $attribute->save();
    redirect("edit_Attribute.php?id=" . $attribute->id);}



?>



<?php  include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>


<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1>Edit_attribute</h1>
            <hr>
        </div>
    </div>

    <form action="edit_Attribute.php?id=<?php echo $attribute->id; ?>" method="post">
        <h5>Add Attribute Values</h5>
        <div class="form-group">
            <input type="text" name="value[]" class="form-control" placeholder="Enter Attribute Value">
            <div id="new_value">
            </div>
            <button type="button" id="add_element" class="btn btn-secondary mt-2 float-left">Add Value Input</button>
            <input type="submit" name="add_value" class="btn btn-primary mt-2 float-right" value="Submit Values">
        </div>
        <h5 class="pt-5">Edit Attribute Name</h5>
        <input type="text" name="name" class="form-control" value="<?php echo $attribute->name; ?>">
        <input type="submit" name="edit_name" class="btn btn-primary mt-2 float-right" value="Edit Name">

    </form>

    <h5 class="pt-5">Values</h5>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        usort($attribute_values, array("Attribute_values", 'order_by_name'));
        foreach ($attribute_values as $attribute_value) :
            ?>
            <tr>
                <td><?php echo $attribute_value->id; ?></td>
                <td><?php echo $attribute_value->name; ?></td>
                <td><a href="delete_Attribute_Value.php?id=<?php echo $attribute_value->id; ?>&attribute=<?php echo $attribute->id; ?>"
                       class="btn btn-danger rounded-0"><i
                            class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>


    </table>

</div>









<?php include ("includes/footer.php"); ?>
