<?php
require '../classes/Helper.php';
require '../../classes/Database.php';
require '../classes/Gallery.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate category object
$gallery = new Gallery();

// add gallery
if (isset($_POST["addImage"])) {
    $gallery->image_title = Helper::str($_POST["image_title"]);
    $gallery->category_id = Helper::int($_POST["category_id"]);
    $gallery->album_id = Helper::int($_POST["album_id"]);
    $gallery->sort_desc = Helper::str($_POST["sort_desc"]);
    $gallery->image_source = Helper::str($_POST["sort_desc"]);

    $image_file = $_FILES["image_file"];

    if (Helper::is_image($image_file)) {
        $image_name = Helper::randomImageName($image_file);
        move_uploaded_file($image_file["tmp_name"], "../../uploads/" . $image_name);
        $gallery->image_source = $image_name;
        // create gallery
        if ($gallery->addImage()) {
            $response = array(
                "status" => "alert-success",
                "message" => "Image Successfully Added."
            );
        } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "ERR: Something went wrong. please try again!"
            );
        }
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "you need to check image file type"
        );
    }
}

// update gallery
if (isset($_POST["updateImage"])) {
    $image_file = $_FILES["image_file"];

    $error = false;
    if (!empty($image_file["name"])) {
        if (Helper::is_image($image_file)) {
            $image_name = Helper::randomImageName($image_file);
        } else {
            $error = true;
            $response = array(
                "status" => "alert-danger",
                "message" => "you need to check image file type"
            );
        }
    }

    if (!$error) {
        $gallery->id = Helper::int($_POST["id"]);
        $gallery->image_title = Helper::str($_POST["image_title"]);
        $gallery->category_id = Helper::int($_POST["category_id"]);
        $gallery->album_id = Helper::int($_POST["album_id"]);
        $gallery->sort_desc = Helper::str($_POST["sort_desc"]);

        $image = $gallery->getSingleImage()["image_source"];
        if (!empty($image_file["name"])) {
            unlink("../../uploads/" . $image);
            move_uploaded_file($image_file["tmp_name"], "../../uploads/" . $image_name);
            $gallery->image_source = $image_name;
        } else {
            $gallery->image_source = $image;
        }

        if ($gallery->updateImage()) {
            $response = array(
                "status" => "alert-success",
                "message" => "Image Updated."
            );
        } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "ERR: Something went wrong. please try again!"
            );
        }
    }
}

// delete gallery
if (isset($_GET["status"]) && $_GET["status"] === 'delete') {
    $gallery->id =  $_GET["id"];

    // remove image
    $image = $gallery->getSingleImage()["image_source"];
    unlink("../../uploads/" . $image);

    if ($gallery->deleteImage()) {
        $response = array(
            "status" => "alert-success",
            "message" => "Image Deleted."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

Helper::redirect("../images.php?" . http_build_query($response));
