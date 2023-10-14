<?php
function getAlbum($sql, $connect, $limit, $target)
{
    $adjacents = 3;
    //echo $sql;
    $numrows = mysqli_num_rows(mysqli_query($connect, $sql));
    $total_pages = $numrows;
    $targetpage = '' . $target . '';                           //your file name  (the name of this file)
    $limit = $limit;                                //how many items to show per page
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    if ($page)
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;
    $sql .= " LIMIT $start, $limit";
    //echo $sql;

    $result = mysqli_query($connect, $sql);

    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages / $limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1

    /* 
        Now we apply our rules and draw the pagination object. 
        We're actually saving the code to a variable in case we want to draw it more than once.
    */

    $pagination = "";
    if ($lastpage > 1) {
        $pagination .= "<div class=\"paginations\">";
        //previous button
        if ($page > 1)
            $pagination .= "<a href=\"$targetpage&page=$prev\"> << </a>";
        else
            $pagination .= "<span class=\"disabled\"> << </span>";

        //pages 
        if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
        {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination .= "<span style='font-weight:bold;' class=\"pageline\"> $counter </span>";
                else
                    $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
            }
        } elseif ($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span style='font-weight:bold;' class=\"pageline\"> $counter </span>";
                    else
                        $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                }
                $pagination .= "";
                $pagination .= "<a href=\"$targetpage&page=$lpm1\"> $lpm1 </a>";
                $pagination .= "<a href=\"$targetpage&page=$lastpage\"> $lastpage </a>";
            }
            //in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $pagination .= "<a href=\"$targetpage&page=1\"> 1 </a>";
                $pagination .= "<a href=\"$targetpage&page=2\"> 2 </a>";
                $pagination .= "";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span style='font-weight:bold;' class=\"pageline\"> $counter </span>";
                    else
                        $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                }
                $pagination .= "";
                $pagination .= "<a href=\"$targetpage&page=$lpm1\"> $lpm1 </a>";
                $pagination .= "<a href=\"$targetpage&page=$lastpage\"> $lastpage </a>";
            }
            //close to end; only hide early pages
            else {
                $pagination .= "<a href=\"$targetpage&page=1\"> 1 </a>";
                $pagination .= "<a href=\"$targetpage&page=2\"> 2 </a>";
                $pagination .= "";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span  style='font-weight:bold;' class=\"pageline\">  $counter </span>";
                    else
                        $pagination .= "<a href=\"$targetpage&page=$counter\"> $counter </a>";
                }
            }
        }

        //next button
        if ($page < $counter - 1)
            $pagination .= "<a href=\"$targetpage&page=$next\"> >> </a>";
        else
            $pagination .= "<span style='display:none;' > >>  </span>";
        $pagination .= "</div>\n";
    }
    //echo "no:".$numrows ;
    if ($numrows > 0) {

        $rowcnt = 1;
        //echo $rowcnt;
?>
        <?php
        //echo $sql;
        $rs_result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_array($rs_result)) {
        ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mb-4">
                    <div class="card-img-body">
                        <a href="album.php?id=<?php echo $row["id"]; ?>">
                            <img class="card-img" src="uploads/<?php echo $row["album_thumb"]; ?>" alt="<?php echo $row["album_name"]; ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["album_name"]; ?> <span>(<?php echo Gallery::imageCount($row["id"]); ?>)</span></h5>
                        <p class="card-text"><?php echo Helper::limit_words(strip_tags(htmlspecialchars_decode($row["album_body"])), '12'); ?></p>
                        <div class="meta">
                            <div class="added_on float-left"><em><i class="far fa-clock"></i><span class="ml-2"><?php echo Helper::time_elapsed_string($row["added_on"]); ?></span></em></div>
                            <div class="views float-right"><i class="far fa-eye"></i><span class="ml-2"><?php echo Helper::thousandsCurrencyFormat($row["views"]); ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    <?php
        $rowcnt = $rowcnt + 1;
    }
    ?>
    <!-- Pagination -->
    <div class="pagination">
        <?php echo $pagination; ?>
    </div>
<?php
}
