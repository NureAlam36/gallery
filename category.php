<?php require 'classes/Database.php'; ?>
<?php require 'classes/Helper.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php require 'classes/Gallery.php'; ?>

<?php

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();
Helper::$breadcrumbs = 'Category';

// Instantiate album object
$album = new Album();

// Instantiate gallery object
$gallery = new Gallery();

$category_id = $_GET["id"];
?>

<?php require 'inc/header.php'; ?>
<?php require 'inc/album.php'; ?>

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
                    <form action="category.php" method="GET">
                        <input type="hidden" name="id" value="<?php echo $category_id; ?>">
                        <?php include 'inc/filter.php'; ?>
                    </form>
                </div>
            </section>
            <div class="gal-wrap mb-3">
                <?php
                $sql = 'SELECT * FROM `albums`';
                if($category_id) {
                    $sql .= " WHERE `category` = '$category_id'";
                }
                $sql .= isset($_GET["order"]) ? Helper::orderByAlbum($_GET["order"]) : '';
                $limit = isset($_GET["rpp"]) ? Helper::albumLimit($_GET["rpp"]) : 12;

                if (mysqli_num_rows(mysqli_query($connect, $sql)) > 0) {
                ?>
                    <div class="row">
                        <?php
                        echo getAlbum($sql, $connect, $limit, 'category.php?id=' . $category_id . '');
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