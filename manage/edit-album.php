<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php include 'inc/header.php'; ?>

<!-- include libraries(jQuery, bootstrap) -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include jquery -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->

<!-- include libraries BS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<!-- include summernote -->
<!-- <script src="lib/css/summernote-bs4.css"></script>
<script src="lib/js/summernote-bs4.js"></script> -->
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/wysiwyg-editor-summernote/summernote-bs4.css">
<script type="text/javascript" src="https://www.jqueryscript.net/demo/wysiwyg-editor-summernote/summernote-bs4.js"></script>

<script type="text/javascript">
    document.oncontextmenu = document.body.oncontextmenu = function() {
        //return false;
    }

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 120,
            placeholder: '@ Album Description'
        });
    });
</script>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate album object
$album = new Album();
$album->id = $_GET["id"];
$result1  = $album->getSingleAlbum();

// Instantiate category object
$category = new Category();
$result2  = $category->getAllCategories();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Album</li>
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

<div class="alb-wrp">
    <div class="form-container">
        <div class="card-header">
            Adit Album
        </div>
        <div class="form-body">
            <form action="core/album.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Album Name</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="album_name" value="<?php echo $result1["album_name"]; ?>" placeholder="Album Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">
                            Album thumbnail :
                            <br />
                            <small class="mr-2">600px X 400px</small>
                        </label>
                        <span class="form-indicat"></span>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" name="album_thumb" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Category</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="category" class="form-control form-control-sm">
                            <option value="">Select Category</option>
                            <?php
                            while ($row = $result2->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["id"]; ?>" <?php if ($row["id"] == $result1["category"]) {
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
                        <label for="">Description <em>(Optional)</em></label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <!-- <textarea id="desc" placeholder="Image Description" name="album_body" rows="4" class="form-control form-control-sm"></textarea> -->
                        <textarea name="album_body" class="summernote"><?php echo $result1["album_body"]; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Keywords</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea id="desc" placeholder="animal, horse, cat, dog" name="album_keywords" rows="4" class="form-control form-control-sm"><?php echo $result1["album_keywords"]; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="hidden" name="album_id" value="<?php echo $_GET["id"]; ?>">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" name="updateAlbum" value="true" class="btn primary">Edit Album</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>