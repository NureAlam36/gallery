<?php
class User
{
    // DB Stuff
    private $conn;
    private $table = 'administrator';

    // Proparties
    public $email;
    public $password;

    // Construct with DB
    public function __construct()
    {
        global $connect;
        $this->conn = $connect;
    }

    /*** Admin login process ***/
    public function checkLogin()
    {
        $password_hash = hash("sha256", $this->password);
        $query = 'SELECT * FROM ' . $this->table . ' WHERE `admin_email` = "' . $this->email . '" AND `admin_password` = "' . $password_hash . '"';

        $result = $this->conn->query($query);

        // checking if the admin is availavle in the tabel
        if ($result->num_rows > 0) {
            $admin_data = $result->fetch_assoc();

            // this login var will use for the session thing
            $_SESSION['logged_admin'] = true;
            $_SESSION['uid'] = $admin_data['id'];

            return true;
        }

        return false;
    }
}
