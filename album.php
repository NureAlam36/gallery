<?php require 'classes/Database.php'; ?>
<?php require 'classes/Helper.php'; ?>
<?php require 'classes/Album.php'; ?>

<?php

// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate helper object
$helper = new Helper();
Helper::$breadcrumbs = 'Album';

// Instantiate album object
$album = new Album();
?>

<?php require 'inc/header.php'; ?>

<?php
$album_id = $_GET["id"];

$album = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `albums` WHERE `id` = $album_id"));
$images = 'SELECT * FROM `images` WHERE `album_id` = ' . $album_id . '';

//Update views
$views = $album["views"] + 1;
mysqli_query($connect, "UPDATE `albums` SET `views`= $views WHERE `id` = '$album_id'");
?>

<div class="container">
    <!-- |begin| sidebar -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- |end| sidebar -->

    <div class="main-content">
        <div class="gallery-view-wrapper">
            <h4 itemprop="name"><?php echo strtoupper(Helper::getCaegoryName($album["category"])); ?> - <?php echo strtoupper($album["album_name"]); ?></h4>
            <div class="gallery-meta">
                <p class="mb-3 description">
                    <?php echo htmlspecialchars_decode($album["album_body"]); ?>
                </p>
                <p class="mb-3 keywords">
                    <?php
                    $album_keywords = $album["album_keywords"];
                    $keywords = explode(",", $album_keywords);

                    if (!empty($keywords)) {
                        foreach ($keywords as $key) {
                    ?>
                            <span class="badge badge-info bg-info gal-keyword"><?php echo $key; ?></span>
                    <?php
                        }
                    }
                    ?>
                </p>
                <div class="info">
                    <span>Images: <em><?php echo mysqli_num_rows(mysqli_query($connect, $images)) ?></em></span>
                    <span>Created On: <em><?php echo date("d M Y", strtotime($album["added_on"])); ?></em></span>
                </div>
                <div class="social-share-btns-container mt-4">
                    <h5 class="mb-3">Share This Album:</h5>
                    <div class="social-share-btns">
                        <a class="share-btn share-btn-twitter" href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=https://www.codewithfns.com/gallery/album.php?id=<?php echo $album_id; ?>&display=popup&ref=plugin&src=share_button" id="share-fb" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600'); return false;">
                            <i class="fab fa-twitter"></i>
                            Tweet
                        </a>
                        <a class="share-btn share-btn-facebook" href="https://twitter.com/intent/tweet?url=https://www.codewithfns.com/gallery/album.php?id=<?php echo $album_id; ?>&text=<?php echo $album["album_name"]; ?>" id="share-tw" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600'); return false;">
                            <!-- <i class="fab fa-facebook-square"></i> -->
                            <i class="fab fa-facebook-f"></i>
                            Share
                        </a>
                        <a class="share-btn share-btn-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.codewithfns.com/gallery/album.php?id=<?php echo $album_id; ?>&title=<?php echo $album["album_name"]; ?>" id="share-li" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600'); return false;">
                            <i class="fab fa-linkedin-in"></i>
                            Share
                        </a>
                    </div>
                </div>
                <div class="button-group mt-4">
                    <div class="like-button mr-2">
                        <div class="blue button">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <span class="like-count basic blue label"><?php echo Album::getAlbumLike($album_id); ?></span>
                    </div>
                    <div class="view-button">
                        <i class="fas fa-eye"></i><span><?php echo Helper::thousandsCurrencyFormat($album["views"]); ?></span>
                    </div>
                </div>
            </div>
            <div class="gallery">
                <!-- filter menu -->
                <div class="filter-sec mb-4">
                    <form action="album.php" method="GET">
                        <input type="hidden" name="id" value="<?php echo $album_id; ?>">
                        <?php include 'inc/filter.php'; ?>
                    </form>
                </div>

                <!-- images group -->
                <div class="images imgcontainer">
                    <?php
                    $images .= isset($_GET["order"]) ? Helper::orderByGalery($_GET["order"]) : '';

                    $sql = $images;

                    $adjacents = 3;
                    //echo $sql;
                    $numrows = mysqli_num_rows(mysqli_query($connect, $sql));
                    $total_pages = $numrows;
                    $targetpage = "album.php?id=" . $album_id; //your file name  (the name of this file)
                    $limit = isset($_GET["rpp"]) ? Helper::albumLimit($_GET["rpp"]) : 12;                                //how many items to show per page
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
                    $lastpage = ceil($total_pages / $limit);     //lastpage is = total pages / items per page, rounded up.
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
                            <div class="item">
                                <a href="uploads/<?php echo $row["image_source"]; ?>">
                                    <img class="img-responsive" width="355px" height="200px" src="uploads/<?php echo $row["image_source"]; ?>" title="<?php echo $row["image_title"]; ?>" alt="<?php echo $row["image_title"]; ?>" />
                                </a>
                                <span align=left><?php echo $row["image_title"]; ?></span>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                        $rowcnt = $rowcnt + 1;
                    } else {
                    ?>
                        <div class="alert alert-info" role="alert" align="center">No Items found.</div>
                    <?php
                    }
                    ?>
                    <!-- Pagination -->
                    <div class="pagination">
                        <?php echo $pagination; ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

    </div>

</div>


<script src="lib/js/simple-lightbox.min.js?v2.8.0"></script>

<script>
    (function() {
        var $gallery = new SimpleLightbox('.gallery a', {});
    })();

    //Update Album Like
    $(".like-button").click(function() {
        var album_id = <?php echo $album_id ?>;
        updateAlbumLike(album_id);
    });

    function updateAlbumLike(album_id) {
        var action = "update album like";
        var album_id = album_id;
        var agent = "<?php echo $_SERVER["HTTP_USER_AGENT"]; ?>";
        $.ajax({
            url: "ajax/album_like.php",
            type: "POST",
            data: {
                action: action,
                album_id: album_id,
                agent: agent
            },
            success: function(response) {
                if (response === 'success') {
                    var like_count = $(".like-count").text();
                    $('.like-count').html(parseInt(like_count) + 1);
                } else if (response === 'already voted') {
                    alert("already voted!");
                } else {
                    alert("Somethig went wrong!");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
</script>

<script src="lib/js/jquery.row-grid.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            minMargin: 5,
            maxMargin: 15,
            itemSelector: ".item",
            firstItemClass: "first-item"
        };
        $(".imgcontainer").rowGrid(options);
    });
</script>

<?php require 'inc/footer.php'; ?>