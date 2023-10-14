<?php require 'classes/Helper.php'; ?>
<?php include '../classes/Database.php'; ?>
<?php require 'classes/Page.php'; ?>
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
        <li class="breadcrumb-item active" aria-current="page">Users</li>
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

<!-- User Lists Table -->
<div class="pages-list">
    <table id="table_id" class="display table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>Email Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        const path = $(location).attr('pathname');

        if (path === '/manage/' || path === '/manage/index.php') {
            $('#table_id').DataTable({
                "order": [
                    [5, "desc"]
                ]
            });
        } else {
            $('#table_id').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        }
    });
</script>

<?php include 'inc/footer.php'; ?>