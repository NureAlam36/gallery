<?php require 'classes/Helper.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php require 'classes/Page.php'; ?>
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

$helper = new Helper();

$id = $_GET["id"];

$page = new Page();
$page = $page->getSinglePages($id);
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
    </ol>
</nav>

<!-- User Lists Table -->
<div class="content-wrap">
    <div class="form-container">
        <form action="core/page.php" method="POST">
            <div class="form-group">
                <label for="">Page Name</label>
                <input class="form-control" type="text" name="page_name" value="<?php echo $page["page_name"]; ?>" placeholder="Album Name" readonly>
            </div>
            <div class="form-group">
                <label for="">Page Body</label>
                <textarea name="page_body" class="summernote"><?php echo $page["page_body"]; ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <button class="btn primary" type="submit" name="updatePage" value="true">Update</button>
            </div>
        </form>
    </div>
</div>

<?php include 'inc/footer.php'; ?>