<?php
require '../classes/Helper.php';
require '../../classes/Database.php';
require '../classes/User.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate user object
$user = new User();

if (isset($_POST["change_password_btn"])) {
    $admin_id = 1;

    $old_password = trim($_POST["old_password"]);
    $old_password = htmlspecialchars($_POST["old_password"]);

    $new_password = trim($_POST["new_password"]);
    $new_password = htmlspecialchars($_POST["new_password"]);

    $retype_password = trim($_POST["retype_password"]);
    $retypretype_passworde_pwd = htmlspecialchars($_POST["retype_password"]);

    if ($new_password === $retype_password) {
        if (strlen($new_password) <= 5) {

            $response = array(
                "status" => "alert-danger",
                "message" => "Password must contain at least 6 characters."
            );
        } else {
            $old_password_hashing = hash("sha256", $old_password); //password hashing using sha256

            //Select Administrator
            $select_data = mysqli_query($connect, "SELECT * FROM `administrator` WHERE `id` = '$admin_id' AND `admin_password` = '$old_password_hashing'");
            $row = mysqli_num_rows($select_data);
            if ($row < 1) {

                $response = array(
                    "status" => "alert-danger",
                    "message" => "Your entered old password is wrong!"
                );
            } else {
                $new_password_hashing = hash("sha256", $new_password); //password hashing using SHA256
                //Update Data
                $update_data = mysqli_query($connect, "UPDATE `administrator` SET `admin_password` = '$new_password_hashing' WHERE `id` = '$admin_id'");
                if ($update_data) {

                    $response = array(
                        "status" => "alert-success",
                        "message" => "Password successfully changed."
                    );
                }
            }
        }
    } else {

        $response = array(
            "status" => "alert-danger",
            "message" => "Password not matched!"
        );
    }
} else {

    $response = array(
        "status" => "alert-danger",
        "message" => "Something went wrong!"
    );
}


Helper::redirect("../change-password.php?" . http_build_query($response) . "");
