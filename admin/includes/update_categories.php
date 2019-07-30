<?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories where cat_id = {$cat_id}";
    $update_categories_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($update_categories_query)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="cat_title">Update a Category</label>
                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" type="text" class="form-control" name="cat_title">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update" value="Update">
            </div>
        </form>

        <?php
    }
}

if (isset($_POST['update'])) {
    $cat_id = $_GET['edit'];
    $cat_title = $_POST['cat_title'];

    $update_query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
    $update_categories_query = mysqli_query($connection, $update_query);

    header("Location: categories.php");
}
?>