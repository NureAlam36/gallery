<?php

function is_admin_logged_in()
{
    if (isset($_SESSION['logged_administrator'])) {
        return true;
    }
}

function redirect($addr)
{
    if (headers_sent()) {
        die('<script type="text/javascript">window.location.href="' . $addr . '"</script>');
    } else {
        header("location: $addr");
        die();
    }
}

function find_past_date($days)
{
    $data = date('Y-m-d H:i:s');
    $newdate = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s", strtotime($data)) . " -$days day"));
    return $newdate;
}

//Limit Words
function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
