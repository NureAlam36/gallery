<?php
class Page
{
    // DB Stuff
    private $conn;
    private $table = 'pages';

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    // Select single pages
    public function getSinglePages($id)
    {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE `id` = ' . $id . '';

        // Prepare statement
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return $result;
    }

    // Select all pages
    public function getAllPages()
    {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY `id` DESC';

        // Prepare statement
        $result = $this->conn->query($query);

        return $result;
    }

    // update page
    public function updatePage($id, $body)
    {
        // Create Query
        $query = 'UPDATE ' . $this->table . ' SET `page_body` = "' . $body . '" WHERE `id` = ' . $id . '';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }
}
