<?php
class Gallery
{
    // DB Stuff
    private static $conn;

    // properties
    public static $breadcrumbs;

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        self::$conn = $connect;
    }

    // get image number of an  album
    public static function imageCount($id)
    {
        // create query
        $query = 'SELECT * FROM `images` WHERE `album_id` = ' . $id . '';

        // prepare query
        $result = self::$conn->query($query);

        if ($result) {
            return $result->num_rows;
        }

        return false;
    }
}
