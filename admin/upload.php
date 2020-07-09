<?php include("includes/header.php"); ?>
<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}


$message = "";


if (isset($_POST['submit'])) {

    Photo::set_files($_FILES['file']);
    redirect("photos");

}











?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="pt-5">Upload Photo</h1>
            <h5>
                <?php echo $message; ?>
            </h5>
            <form action="upload" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="file" name="upload" class="form-control" multiple="multiple">
                        </div>

                        <div class="form-group">
                            <input type="file" name="file[]" class="form-control" multiple="multiple">
                        </div>

                        <input type="submit" name="submit" value="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
