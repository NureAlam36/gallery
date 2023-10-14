<?php
class Gallery
{
    // DB stuff
    private $conn;
    private $table = 'images';

    // properties
    public $id;
    public $image_source;
    public $image_title;
    public $category_id;
    public $album_id;
    public $sort_desc;

    //constructor with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    // get single image
    public function getSingleImage()
    {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $this->id . '';

        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    // get all images
    public function getAllImages()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';

        // prepare statement
        $result = $this->conn->query($query);

        return $result;
    }

    // add image
    public function addImage()
    {
        // create query
        $query  = 'INSERT INTO ' . $this->table . ' (`image_title`, `category_id`, `album_id`, `sort_desc`, `image_source`) VALUES ("' . $this->image_title . '", "' . $this->category_id . '", "' . $this->album_id . '", "' . $this->sort_desc . '", "' . $this->image_source . '")';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    // update image
    public function updateImage()
    {
        // create query
        $query = 'UPDATE ' . $this->table . ' SET `image_title` = "' . $this->image_title . '", `category_id` = ' . $this->category_id . ', `album_id` = ' . $this->album_id . ', `sort_desc` = "' . $this->sort_desc . '", `image_source` = "' . $this->image_source . '" WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    // detele album
    public function deleteImage()
    {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }
        return false;
    }
}
