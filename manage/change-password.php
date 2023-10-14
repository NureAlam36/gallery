<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
</nav>

<div class="login-form d-block">

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

    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center mb-5">Change password</h3>

            <!--Password must contain one lowercase letter, one number, and be at least 7 characters long.-->

            <div class="card-text">
                <form action="core/change-password.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">CURRENT PASSWORD</label>
                        <input type="password" name="old_password" class="form-control form-control-sm" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">NEW PASSWORD</label>
                        <input type="password" name="new_password" class="form-control form-control-sm" placeholder="Enter New Password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">CONFIRM PASSWORD</label>
                        <input type="password" name="retype_password" class="form-control form-control-sm" placeholder="Enter CONFIRM Password">
                    </div>
                    <button name="change_password_btn" value="submit" type="submit" class="btn primary btn-block submit-btn">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>