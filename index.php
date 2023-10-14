<?php require 'classes/Database.php'; ?>
<?php require 'classes/Helper.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php require 'classes/Gallery.php'; ?>
<?php require 'inc/album.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate album object
$album = new Album();

// Instantiate helper object
$helper = new Helper();

// Instantiate gallery object
$gallery = new Gallery();
?>

<?php require 'inc/header.php'; ?>

<div class="container">
    <!-- |begin| sidebar -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- |end| sidebar -->

    <!-- |begin| main-content -->
    <div class="main-content">
        <div class="pg-categories-view">
            <section class="mb-4">
                <div class="heading">
                    <h4>GALLERY LIST</h4>
                </div>
                <!-- filter menu -->
                <div class="filter-sec">
                    <form action="index.php" method="GET">
                        <?php include 'inc/filter.php'; ?>
                    </form>
                </div>
            </section>
            <div class="gal-wrap mb-3">
                <?php
                $sql = 'SELECT * FROM `albums`';
                $sql .= isset($_GET["order"]) ? Helper::orderByAlbum($_GET["order"]) : '';
                $limit = isset($_GET["rpp"]) ? Helper::albumLimit($_GET["rpp"]) : 12;

                if (mysqli_num_rows(mysqli_query($connect, $sql)) > 0) {
                ?>
                    <div class="row">
                        <?php
                        echo getAlbum($sql, $connect, $limit, 'index.php?');
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-info mt-5" role="alert" align="center">No Items found.</div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- |end| main-content -->
</div>

<?php require 'inc/footer.php'; ?>