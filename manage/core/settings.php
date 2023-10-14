<?php
require '../../classes/Database.php';
require '../classes/Helper.php';
require '../classes/Settings.php';

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

$helper = new Helper();

// Instantiate category object
$settings = new Settings();

// Update Options
if (isset($_POST["update_options"])) {

    $site_logo = $_FILES["site_logo"];


    $error = false;
    if (!empty($site_logo["name"])) {
        if (Helper::is_image($site_logo)) {
            $image_name = Helper::randomImageName($site_logo, 'logo');
        } else {
            $error = true;
            $response = array(
                "status" => "alert-danger",
                "message" => "you need to check image file type"
            );
        }
    }

    if (!$error) {
        $site_title = Helper::str($_POST["site_title"]);
        $site_desc = Helper::str($_POST["site_desc"]);
        $site_keywords = Helper::str($_POST["site_keywords"]);

        $q1 = $settings->updateOption('site-title', $site_title);
        $q2 = $settings->updateOption('site-desc', $site_desc);
        $q3 = $settings->updateOption('site-keywords', $site_keywords);

        if ($q1 || $q2 || $q3) {
            if (!empty($site_logo["name"])) {
                unlink("../../img/" . $image_name);
                move_uploaded_file($site_logo["tmp_name"], "../../img/" . $image_name);
            }

            $response = array(
                "status" => "alert-success",
                "message" => "Data Successfully Updated."
            );
        } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "ERR: Something went wrong. please try again!"
            );
        }
    }
}

// Update Social Media
if (isset($_POST["update_socialmedia"])) {
    $facebook_url = htmlentities(strip_tags($_POST["facebook_url"]));
    $twitter_url = htmlentities(strip_tags($_POST["twitter_url"]));
    $linkedin_url = htmlentities(strip_tags($_POST["linkedin_url"]));

    $q1 = $settings->updateOption('facebook-url', $facebook_url);
    $q2 = $settings->updateOption('twitter-url', $twitter_url);
    $q3 = $settings->updateOption('linkedin-url', $linkedin_url);

    if ($q1 || $q2 || $q3) {
        $response = array(
            "status" => "alert-success",
            "message" => "Data Successfully Updated."
        );
    } else {
        $response = array(
            "status" => "alert-danger",
            "message" => "ERR: Something went wrong. please try again!"
        );
    }
}

Helper::redirect("../settings.php?" . http_build_query($response));
