<?php
require '../../classes/Database.php';
require '../classes/Helper.php';
require '../classes/Album.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();

// Instantiate category object
$album = new Album();

// add album
if (isset($_POST["addAlbum"])) {
    $thumb_img = $_FILES["album_thumb"];

    if (Helper::is_image($thumb_img)) {
        $album->album_name = Helper::str($_POST["album_name"]);
        $album->category = Helper::int($_POST["category"]);
        $album->album_body = Helper::str($_POST["album_body"]);
        $album->album_keywords = Helper::str($_POST["album_keywords"]);

        $thumb_name = Helper::randomImageName($thumb_img);

        $album->album_thumb = $thumb_name;
        // create album
        if ($album->addAlbum()) {
            move_uploaded_file($thumb_img["tmp_name"], "../../uploads/" . $thumb_name);

            $response = array(
                "status" => "alert-success",
                "message" => "Album Successfully Added."
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

// update album
if (isset($_POST["updateAlbum"])) {
    $thumb_img = $_FILES["album_thumb"];

    $error = false;
    if (!empty($thumb_img["name"])) {
        if (Helper::is_image($thumb_img)) {
            $thumb_name = Helper::randomImageName($thumb_img);
        } else {
            $error = true;
            $response = array(
                "status" => "alert-danger",
                "message" => "you need to check image file type"
            );
        }
    }

    if (!$error) {
        $album->id = Helper::int($_POST["album_id"]);
        $album->album_name = Helper::str($_POST["album_name"]);
        $album->category = Helper::int($_POST["category"]);
        $album->album_body = Helper::str($_POST["album_body"]);
        $album->album_keywords = Helper::str($_POST["album_keywords"]);

        $image = $album->getSingleAlbum()["album_thumb"];
        if (!empty($thumb_img["name"])) {
            unlink("../../uploads/" . $image);
            move_uploaded_file($thumb_img["tmp_name"], "../../uploads/" . $thumb_name);
            $album->album_thumb = $thumb_name;
        } else {
            $album->album_thumb = $image;
        }

        if ($album->updateAlbum()) {
            $response = array(
                "status" => "alert-success",
                "message" => "Album Updated."
            );
        } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "ERR: Something went wrong. please try again!"
            );
        }
    }
}

// delete album
if (isset($_GET["status"]) && $_GET["status"] === 'delete') {
    $album->id =  $_GET["id"];

    $image = $album->getSingleAlbum()["album_thumb"];
    unlink("../../uploads/" . $image);
    if ($album->deleteAlbum()) {
        unlink("../../uploads/" . $image);
        $response = array(
            "status" => "alert-success",
            "message" => "Album Deleted."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

Helper::redirect("../album.php?" . http_build_query($response));
