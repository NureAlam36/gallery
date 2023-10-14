<?php
require '../../classes/Database.php';
require '../classes/Helper.php';
require '../classes/Page.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate page object
$page = new Page();

// Add Category
if (isset($_POST["updatePage"])) {
    $id = Helper::int($_POST["id"]);
    $body = Helper::str($_POST["page_body"]);
    // Create Categgory
    if ($page->updatePage($id, $body)) {
        $response = array(
            "status" => "alert-success",
            "message" => "Page Updated."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

Helper::redirect("../pages.php?" . http_build_query($response));
