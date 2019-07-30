<?php include "includes/header.php"; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Administration
                        <small>Author name</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php insert_categories(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add a Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add">
                            </div>
                        </form>
                        <?php include "includes/update_categories.php"; ?>

                    </div>

                    <div class="col-xs-6">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php showAllCategories() ?>
                            <?php deleteCategories() ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"?>