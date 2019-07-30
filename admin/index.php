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
                        <small><?php echo $_SESSION['firstname'];?></small>
                    </h1>

                </div>
            </div>
            <?php include "includes/widgets.php"?>
            <!-- /.row -->

            <div class="row">
            <?php include "includes/chart.php"; ?>
                <div id="columnchart_material" style="width: auto ; height: 500px;"></div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"?>
