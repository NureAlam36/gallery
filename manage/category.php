<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate category object
$category = new Category();

$result  = $category->getAllCategories();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
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
            Add Category
        </div>
        <div class="form-body">
            <div class="form-group">
                <form action="core/category.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="">Category Name</label>
                        <input type="text" name="ctg_name" class="form-control form-control-sm" placeholder="Category Name" required>
                    </div>
                    <button type="submit" name="addCategory" value="submit" class="btn primary submit-btn">Add Category</button>
                </form>
            </div>
        </div>

    </div>

    <div class="table-body">
        <div class="card-header">
            Category List
        </div>
        <div class="table-wrap">
            <table class="table table-bordered">
                <tr>
                    <th class="center">#</th>
                    <th>Name</th>
                    <th align="center" class="center">Images</th>
                    <th class="center">Action</th>
                </tr>
                <tbody class="row_position">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr id="<?php echo $row['id'] ?>">
                                <td align="center"><?php echo $row['id'] ?></td>
                                <td><?php echo $row['ctg_name'] ?></td>
                                <td align="center"><?php echo Helper::totalImagesByCategory($row['id']); ?></td>
                                <td class="center">
                                    <a class="mr-2" href="edit-category.php?id=<?php echo $row['id'] ?>"><button type="button" class="d-inline btn sm btn-primary"><i class="d-block fas fa-pencil-alt"></i></button></a>
                                    <a href="core/category.php?status=delete&id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to Delete this Category?')"><button type="button" class="d-inline btn sm btn-danger"><i class="d-block fas fa-times"></i></button></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td align="center" colspan="4">Category Not Found!</td>
                        </tr>
                    <?php
                    }


                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(data) {
        $.ajax({
            url: "ajax/ajaxPro.php",
            type: 'post',
            data: {
                position: data
            },
            success: function(data) {
                toastr.success('Your Change Successfully Saved.');
            }
        })
    }
</script>


<?php include 'inc/footer.php'; ?>