<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate category object
$category = new Category();

$category->id = $_GET["id"];

$result = $category->getSingleCategory();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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

<div class="ctg-wrp">
    <div class="panel-card">
        <div class="card-header">
            Edit Category
        </div>
        <div class="form-body">
            <div class="form-group">
                <form action="core/category.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="">Category Name</label>
                        <input type="text" name="ctg_name" class="form-control form-control-sm" placeholder="Category Name" value="<?php echo $result["ctg_name"]; ?>" required>
                        <input type="hidden" name="ctg_id" value="<?php echo $_GET["id"]; ?>">
                    </div>
                    <button type="submit" name="updateCategory" value="submit" class="btn primary submit-btn">Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>