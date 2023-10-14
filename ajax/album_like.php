<?php
include '../classes/Database.php';
include '../classes/Album.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate album object
$album = new Album();

if (isset($_POST["action"])) {
    $album_id = $_POST["album_id"];
    $agent = $_POST["agent"];

    if (Album::likeStatus($agent) < 1) {
        if (Album::addLike($album_id, $agent)) {
            echo 'success';
        }
    } else {
        echo "already voted";
    }
}
