<?php include '../classes/Database.php'; ?>
<?php include 'classes/Helper.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>

<div class="card_wrap mb-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3 widget-chart">
                <div class="widget-chart-content">
                    <div class="icon-wrapper rounded-circle">
                        <div class="icon-wrapper-bg bg-primary"></div>
                        <i class="far fa-images" aria-hidden="true"></i>
                    </div>
                    <div class="widget-numbers"><?php echo Helper::thousandsCurrencyFormat(Helper::totalImages()) ?></div>
                    <div class="widget-subheading">Total Images</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 widget-chart">
                <div class="widget-chart-content">
                    <div class="icon-wrapper rounded-circle">
                        <div class="icon-wrapper-bg bg-success"></div>
                        <i class="far fa-list-alt" aria-hidden="true"></i>
                    </div>
                    <div class="widget-numbers"><?php echo Helper::thousandsCurrencyFormat(Helper::totalCategories()) ?></div>
                    <div class="widget-subheading">Categories</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 widget-chart">
                <div class="widget-chart-content">
                    <div class="icon-wrapper rounded-circle">
                        <div class="icon-wrapper-bg bg-danger"></div>
                        <i class="fas fa-photo-video" aria-hidden="true"></i>
                    </div>
                    <div class="widget-numbers"><?php echo Helper::thousandsCurrencyFormat(Helper::totalAlbums()) ?></div>
                    <div class="widget-subheading">Albums</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="visit-stat">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="lib/js/highchart.js"></script>

<?php include 'inc/footer.php'; ?>