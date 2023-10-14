<?php
require 'classes/Helper.php';
require '../classes/Database.php';
require 'classes/User.php';

session_start();

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate User object
$user = new User();

$user->email = htmlspecialchars(strip_tags($_POST["email_addr"]));
$user->password = htmlspecialchars(strip_tags($_POST["password"]));

if (empty($user->email)) {
    $response = array(
        "status" => "alert-success",
        "message" => "Email can not be empty!"
    );
} else if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
    $response = array(
        "status" => "alert-danger",
        "message" => "Your entered email not valid."
    );
} else if (empty($user->password)) {
    $response = array(
        "status" => "alert-danger",
        "message" => "Password can not be empty!"
    );
} else {
    if ($user->checkLogin()) {
        Helper::redirect("index.php?login_true");
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "The email or password you entered is incorrect."
        );
    }
}

Helper::redirect("login.php?" . http_build_query($response) . "");
