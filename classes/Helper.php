<?php
class Helper
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

    // Get Option
    public static function get_option($option_name)
    {
        $query = 'SELECT * FROM `options` WHERE `option_name` = "' . $option_name . '"';

        // prepare query
        $result = self::$conn->query($query);

        if ($result->num_rows > 0) {
            $option = $result->fetch_assoc();
            return $option["option_value"];
        }
        return false;
    }

    // Get page
    public static function getPage($page_name)
    {
        $query = 'SELECT * FROM `pages` WHERE `page_name` = "' . $page_name . '"';

        // prepare query
        $result = self::$conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    // Get Category Name
    public static function getCaegoryName($id)
    {
        $query = 'SELECT * FROM `categories` WHERE `id` = "' . $id . '"';

        // prepare query
        $result = self::$conn->query($query);

        if ($result->num_rows > 0) {
            $option = $result->fetch_assoc();
            return $option["ctg_name"];
        }
        return false;
    }

    // update breadcrumbs
    public static function breadcrumbs()
    {
        if (!empty(self::$breadcrumbs)) {
            return '<i class="ml-2 mr-2 fas fa-caret-right"></i> <span>' . self::$breadcrumbs . '</span>';
        }

        return false;
    }

    //Site url
    public static function site_url()
    {
        $site_url = 'http://www.codewithfns.com/';
        $site_url .= (substr($site_url, -1) == '/' ? '' : '/');
        return $site_url;
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

    //Limit Words
    public static function limit_words($string, $word_limit)
    {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
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

    // gallery order by
    public static function orderByGalery($val = '')
    {
        if ($val == 'asc') {
            return ' ORDER BY `id` ASC';
        } else if ($val == 'desc' || $val == '') {
            return ' ORDER BY `id` DESC';
        } else if ($val == 'title-asc') {
            return ' ORDER BY `image_title` ASC';
        } else if ($val == 'title-desc') {
            return ' ORDER BY `image_title` DESC';
        } else if ($val == 'date-asc') {
            return ' ORDER BY `added_on` ASC';
        } else if ($val == 'date-desc') {
            return ' ORDER BY `added_on` DESC';
        }
        return false;
    }

    // album order by
    public static function orderByAlbum($val = '')
    {
        if ($val == 'asc') {
            return ' ORDER BY `id` ASC';
        } else if ($val == 'desc' || $val == '') {
            return ' ORDER BY `id` DESC';
        } else if ($val == 'title-asc') {
            return ' ORDER BY `album_name` ASC';
        } else if ($val == 'title-desc') {
            return ' ORDER BY `album_name` DESC';
        } else if ($val == 'date-asc') {
            return ' ORDER BY `added_on` ASC';
        } else if ($val == 'date-desc') {
            return ' ORDER BY `added_on` DESC';
        }
        return false;
    }

    // album limit
    public static function albumLimit($val = '')
    {
        if ($val == '12') {
            return 12;
        } else if ($val == '28') {
            return 28;
        } else if ($val == '36') {
            return 36;
        }
        return false;
    }

    // Converting timestamp to time ago
    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . ' ago' : 'just now';
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
