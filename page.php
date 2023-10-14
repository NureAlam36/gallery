<?php require 'classes/Database.php'; ?>
<?php require 'classes/Helper.php'; ?>
<?php require 'classes/Album.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate album object
$album = new Album();

$page = Helper::str(strip_tags($_GET["view"]));

$page_data = Helper::getPage($page);
$page_name = $page_data["page_name"];
$page_body = $page_data["page_body"];

if (empty($page_name)) {
    Helper::redirect('index.php');
}

Helper::$breadcrumbs = $page_name;
?>
<?php require 'inc/header.php'; ?>

<div class="container">
    <div class="page-title mb-4">
        <h3><?php echo strtoupper($page); ?></h3>
    </div>
    <div class="page-body">
        <?php echo htmlspecialchars_decode($page_body); ?>
    </div>
</div>

<?php require 'inc/footer.php'; ?>