<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Gallery.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate category object
$gallery = new Gallery();
$gallery->id = intval($_GET["id"]);
$result1 = $gallery->getSingleImage();

// Instantiate category object
$category = new Category();
$result2 = $category->getAllCategories();

// Instantiate album object
$album = new Album();
$result3 = $album->getAllAlbums();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
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

<div class="gal-wrp">
    <div class="form-container">
        <div class="card-header">
            Edit Image
        </div>
        <div class="form-body">
            <form action="core/images.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Change File <em>(Optional)</em></label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <div class="setting image_picker">
                            <div class="settings_wrap">
                                <label class="drop_target mb-0">
                                    <div class="image_preview"></div>
                                    <input id="inputFile" name="image_file" type="file" />
                                </label>
                                <div class="settings_actions vertical"><a data-action="choose_from_uploaded"><i class="fa fa-picture-o"></i> Choose from Uploads</a><a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Remove Current Image</a></div>
                                <div class="image_details">
                                    <label class="input_line image_title">
                                        <input type="text" name="file_name" placeholder="Title" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Image Title</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="image_title" value="<?php echo $result1["image_title"]; ?>" placeholder="Image Title">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Category</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            while ($row = $result2->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["id"]; ?>" <?php if ($result1["category_id"] == $row["id"]) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $row["ctg_name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Album</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="album_id" class="form-control">
                            <option value="">Select Album</option>
                            <?php
                            while ($row = $result3->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["id"]; ?>" <?php if ($result1["album_id"] == $row["id"]) {
                                                                                echo 'selected';
                                                                            } ?>><?php echo $row["album_name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Description <em>(Optional)</em></label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea placeholder="Image Description" name="sort_desc" rows="4" class="form-control"><?php echo $result1["sort_desc"]; ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-4" align="end">
                        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                    </div>
                    <div class="col-sm-8">
                        <button name="updateImage" class="btn primary">Update Image</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>