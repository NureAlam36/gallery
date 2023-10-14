<?php require 'classes/Helper.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

$helper = new Helper();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Settings</li>
    </ol>
</nav>

<?php
if (isset($_GET["status"]) && isset($_GET["message"])) {
?>
    <div class="alert <?php echo $_GET["status"]; ?> alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $_GET["message"]; ?>
    </div>

<?php
}
?>

<div class="settings">
    <div class="general-settings">
        <div class="card-header">
            General Settings
        </div>
        <div class="form-body">
            <form action="core/settings.php" method="post" enctype="multipart/form-data">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>Website Logo</h5>
                            <span>Select an image for your logo</span>
                        </div>
                        <div class="col-sm-8">
                            <ul class="list-unstyled" id="logo-sec" class="ml-5">
                                <li class="mb-3">
                                    <img width="120" src="../img/<?php echo Helper::get_option('site-logo'); ?>">
                                </li>
                                <li>
                                    <input name="site_logo" type="file" id="exampleInputFile">
                                    <input class="file-name" type="text" placeholder="" readonly="">
                                    <label class="upload-btn" for="exampleInputFile">
                                        <span>Upload File</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Title</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="site_title" value="<?php echo Helper::get_option('site-title'); ?>" placeholder="Enter Websit Title">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Description</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea id="desc" placeholder="Enter Website Description" name="site_desc" rows="4" class="form-control form-control-sm"><?php echo Helper::get_option('site-desc'); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Keywords</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea id="desc" placeholder="Enter Website Keyworlds" name="site_keywords" rows="4" class="form-control form-control-sm"><?php echo Helper::get_option('site-keywords'); ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-4" align="end">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" name="update_options" value="true" class="btn primary">Save Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="social-links">
        <div class="card-header">
            Social Media Links
        </div>
        <div class="form-body">
            <form action="core/settings.php" method="post">
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Facebook</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="facebook_url" value="<?php echo Helper::get_option('facebook-url'); ?>" placeholder="Enter Facebook Link">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Twitter</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="twitter_url" value="<?php echo Helper::get_option('twitter-url'); ?>" placeholder="Enter Twitter Link">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Linkedin</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="linkedin_url" value="<?php echo Helper::get_option('linkedin-url'); ?>" placeholder="Enter Linkedin Link">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-4" align="end">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" name="update_socialmedia" value="true" class="btn primary">Save Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input:file').on('change', function() {
            var target = $(this);
            var relatedTarget = target.siblings('.file-name');
            var fileName = target[0].files[0].name;
            relatedTarget.val(fileName);
        });
    });
</script>

<?php include 'inc/footer.php'; ?>