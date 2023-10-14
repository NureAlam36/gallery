<?php
require '../../classes/Database.php';
require '../classes/Helper.php';
require '../classes/Category.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate category object
$category = new Category();

// Add Category
if (isset($_POST["addCategory"])) {
    $category->category_name = Helper::str(strip_tags($_POST["ctg_name"]));
    $category->position_order = $category->lastOrderNum() + 1;

    // Create Categgory
    if ($category->addCategory()) {
        $response = array(
            "status" => "alert-success",
            "message" => "Category Successfully Added."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

// Update Category
if (isset($_POST["updateCategory"])) {
    $category->id = Helper::str(strip_tags($_POST["ctg_id"]));
    $category->category_name = Helper::str(strip_tags($_POST["ctg_name"]));

    if ($category->updateCategory()) {
        $response = array(
            "status" => "alert-success",
            "message" => "Category Updated."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

// Delete Category
if (isset($_GET["status"]) && $_GET["status"] === 'delete') {
    $category->id =  $_GET["id"];

    if ($category->deleteCategory()) {
        $response = array(
            "status" => "alert-success",
            "message" => "Category Deleted."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

Helper::redirect("../category.php?" . http_build_query($response));
