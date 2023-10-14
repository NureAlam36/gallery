<?php
class Album
{
    // DB stuff
    private $conn;
    private $table = 'albums';

    // proparties
    public $id;
    public $album_name;
    public $album_thumb;
    public $category;
    public $album_body;
    public $album_keywords;

    //constructor with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    // get single album
    public function getSingleAlbum()
    {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE `id` = ' . $this->id . '';

        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    // get all albums
    public function getAllAlbums()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';

        // prepare query
        $result = $this->conn->query($query);

        return $result;
    }

    // add album
    public function addAlbum()
    {
        // create query
        $query  = 'INSERT INTO ' . $this->table . ' (`album_name`, `category`, `album_body`, `album_keywords`, `album_thumb`) VALUES ("' . $this->album_name . '", ' . $this->category . ', "' . $this->album_body . '", "' . $this->album_keywords . '", "' . $this->album_thumb . '")';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    // update album
    public function updateAlbum()
    {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET `album_name` = "' . $this->album_name . '", `category` = ' . $this->category . ', `album_body` = "' . $this->album_body . '", `album_keywords` = "' . $this->album_keywords . '", `album_thumb` = "' . $this->album_thumb . '" WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }


        return false;
    }

    // detele album
    public function deleteAlbum()
    {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }
        return false;
    }
}
