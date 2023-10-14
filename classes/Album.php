<?php
class Album
{
    // DB Stuff
    private static $conn;

    // properties

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        self::$conn = $connect;
    }

    // check like status
    public static function likeStatus($agent)
    {
        // create query
        $query = 'SELECT * FROM `album_likes` WHERE `http_user_agent` = "' . $agent . '"';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // add like
    public static function addLike($id, $agent)
    {
        // create query
        $query  = 'INSERT INTO `album_likes` (`album_id`, `http_user_agent`) VALUES (' . $id . ', "' . $agent . '")';

        if (self::$conn->query($query)) {
            return true;
        }

        return false;
    }

    // like count of a album
    public static function likeCount($id)
    {
        // create query
        $query = 'SELECT * FROM `album_likes` WHERE `album_id` = ' . $id . '';

        $result = self::$conn->query($query);
        return $result->num_rows;
    }

    // get album like
    public static function getAlbumLike($id)
    {
        $query = 'SELECT * FROM `album_likes` WHERE album_id = ' . $id . '';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // get top albums
    public static function getTopAlbums($limit = '3')
    {
        // create query
        $query = 'SELECT * FROM albums ORDER BY id DESC LIMIT ' . $limit . '';

        // prepare query
        $result = self::$conn->query($query);

        return $result;
    }

    // get album number of an  categroy
    public static function albumCount($id)
    {
        // create query
        $query = 'SELECT * FROM `albums` WHERE `category` = ' . $id . '';

        // prepare query
        $result = self::$conn->query($query);

        if ($result) {
            return $result->num_rows;
        }

        return false;
    }
}
