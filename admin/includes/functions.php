<?php
function insert_categories()
{

    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if (!empty($cat_title)) {
            $query = "INSERT INTO categories (cat_title) VALUE ('$cat_title')";
            $add_category_query = mysqli_query($connection, $query);

            if (!$add_category_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

        } else {
            echo "<h2> You must enter a category name. </h2>";
        }

    }
}

function showAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        ?>
        <tr>
            <td><?php echo $cat_id; ?></td>
            <td><?php echo $cat_title ?></td>
            <td><?php echo "<a class='btn btn-danger center-block' href='categories.php?delete={$cat_id}'>Delete</a>"; ?></td>
            <td><?php echo "<a class='btn btn-info center-block' href='categories.php?edit={$cat_id}'>Edit</a>"; ?></td>
        </tr>
        <?php
    }
}

function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function recordCount($table)
{
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_query);

    return $result;
}

function checkStatus($table, $column, $status)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $select_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_query);

    return $result;
}

function is_admin($username)
{
    global $connection;

    $query = "SELECT user_role FROM users WHERE user_username = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if ($row['user_role'] == 'Administrator') {
        return true;
    } else {
        return false;
    }
}

function username_exists($username)
{
    global $connection;

    $query = "SELECT user_username FROM users WHERE user_username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exists($email)
{
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}



