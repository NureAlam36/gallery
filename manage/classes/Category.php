<?php
class Category
{
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Proparties
    public $id;
    public $category_name;
    public $position_order;

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    // Select Last Order Number
    public function lastOrderNum()
    {
        // Create Query
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY position_order DESC LIMIT 1';

        $result = $this->conn->query($query);

        if ($result->fetch_row() > 0) {
            return $result->fetch_assoc()["position_order"];
        }

        return 0;
    }

    // Get Single Category
    public function getSingleCategory()
    {
        // Create Query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE `id` = ' . $this->id . '';

        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }

    // get all categories
    public function getAllCategories()
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY `position_order` DESC';

        // Prepare statement
        $result = $this->conn->query($query);

        return $result;
    }

    // add category
    public function addCategory()
    {
        // create query
        $query  = 'INSERT INTO ' . $this->table . ' (`ctg_name`, `position_order`) VALUES ("' . $this->category_name . '", ' . $this->position_order . ')';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    // Update Category
    public function updateCategory()
    {
        // Create Query
        $query = 'UPDATE ' . $this->table . ' SET `ctg_name` = "' . $this->category_name . '" WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }

    // Detele Category
    public function deleteCategory()
    {
        // Create Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $this->id . '';

        if ($this->conn->query($query)) {
            return true;
        }
        return false;
    }
}
