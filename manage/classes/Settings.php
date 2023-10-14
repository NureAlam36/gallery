<?php
class Settings
{
    // DB Stuff
    private $conn;
    private $table = 'options';

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    // Select Last Order Number
    public function updateOption($option_name, $option_value)
    {
        // Create Query
        $query = 'UPDATE ' . $this->table . ' SET `option_value` = "' . $option_value . '" WHERE `option_name` LIKE "' . $option_name . '"';

        if ($this->conn->query($query)) {
            return true;
        }

        return false;
    }
}
