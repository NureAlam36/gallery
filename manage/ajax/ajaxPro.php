<?php
// Include Connection File 
require('../dbConfig.php');

$position = $_POST['position'];

$i = 1;

// Update Orting Data 
foreach ($position as $k => $v) {

    $sql = "Update categories SET position_order=" . $i . " WHERE id=" . $v;

    mysqli_query($con, $sql);

    $i++;
}
