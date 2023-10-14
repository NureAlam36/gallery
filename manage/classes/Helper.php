<?php
class Helper
{
    // DB Stuff
    private static $conn;

    //Constructor with DB
    public function __construct()
    {
        global $connect;
        self::$conn = $connect;
    }

    // is admin
    public static function is_admin_logged_in()
    {
        if (isset($_SESSION['logged_admin'])) {
            return true;
        }
    }

    //Rediret
    public static function redirect($addr)
    {
        if (headers_sent()) {
            die('<script type="text/javascript">window.location.href="' . $addr . '"</script>');
        } else {
            header("location: $addr");
            die();
        }
    }

    // Get Option
    public static function get_option($option_name)
    {
        $query = 'SELECT * FROM `options` WHERE `option_name` = "' . $option_name . '"';

        $result = self::$conn->query($query);
        if ($result->num_rows > 0) {
            $option = $result->fetch_assoc();
            return $option["option_value"];
        }
        return false;
    }

    // Total Images
    public static function totalImages()
    {
        // create query
        $query = 'SELECT * FROM `images`';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // total images by category
    public static function totalImagesByCategory($id)
    {
        // create query
        $query = 'SELECT * FROM `images` WHERE `category_id` = ' . $id . '';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }
    // total imagesB by album
    public static function totalImagesByAlbum($id)
    {
        // create query
        $query = 'SELECT * FROM `images` WHERE `album_id` = ' . $id . '';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // Total Images
    public static function totalCategories()
    {
        // create query
        $query = 'SELECT * FROM `categories`';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // Total Images
    public static function totalAlbums()
    {
        // create query
        $query = 'SELECT * FROM `albums`';

        $result = self::$conn->query($query);
        if ($result) {
            return $result->num_rows;
        }

        return false;
    }

    // Check if image
    public static  function is_image($file)
    {
        $pieces_array = explode('.', $file["name"]);
        $ext = strtolower(end($pieces_array));
        $file_supported = array("jpg", "jpeg", "png", "gif");
        if (in_array($ext, $file_supported)) {
            return true;
        }
        return false;
    }

    //Number to currency format
    public static function thousandsCurrencyFormat($num)
    {
        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $num;
    }

    public static function RandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public static function randomImageName($file, $name = '')
    {
        $txt = !empty($name) ? $name : self::RandomString(24);
        return  $txt . '.' . end(explode(".", $file["name"]));
    }

    static function int($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_INT);
        if ($val === true) {
            return $val;
        }
        return $val;
    }

    static function str($val)
    {
        if (is_string($val)) {
            $val = trim(htmlspecialchars($val));
            return $val;
        }
        return false;
    }

    static function email($val)
    {
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($val === true) {
            return $val;
        }
        return false;
    }
}
