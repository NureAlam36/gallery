<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Gallery.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php include 'inc/header.php'; ?>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate gallery object
$gallery = new Gallery();
$result1 = $gallery->getAllImages();

// Instantiate category object
$category = new Category();
$result2 = $category->getAllCategories();

// Instantiate album object
$album = new Album();
$result3 = $album->getAllAlbums();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Images</li>
    </ol>
</nav>

<?php
if (isset($_GET["status"]) && isset($_GET["message"])) {
?>
    <div class="alert <?php echo $_GET["status"]; ?> alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $_GET["message"]; ?>
    </div>

<?php
}
?>

<div class="gal-wrp">
    <div class="form-container">
        <div class="card-header">
            Add Image
        </div>
        <div class="form-body">
            <form action="core/images.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select File</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <div class="setting image_picker">
                            <div class="settings_wrap">
                                <label class="drop_target mb-0">
                                    <div class="image_preview"></div>
                                    <input id="inputFile" name="image_file" type="file" />
                                </label>
                                <div class="settings_actions vertical"><a data-action="choose_from_uploaded"><i class="fa fa-picture-o"></i> Choose from Uploads</a><a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Remove Current Image</a></div>
                                <div class="image_details">
                                    <label class="input_line image_title">
                                        <input type="text" name="file_name" placeholder="Title" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Image Title</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="image_title" placeholder="Image Title">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Category</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            while ($row = $result2->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["id"]; ?>"><?php echo $row["ctg_name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Album</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="album_id" class="form-control">
                            <option value="">Select Album</option>
                            <?php
                            while ($row = $result3->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row["id"]; ?>"><?php echo $row["album_name"]; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Description <em>(Optional)</em></label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea placeholder="Image Description" name="sort_desc" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-sm-4" align="end">
                    </div>
                    <div class="col-sm-8">
                        <button name="addImage" class="btn primary">Add Image</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="gallery">
        <div class="card-header">
            Image List
        </div>
        <div class="image-group">
            <?php
            $sql = 'SELECT * FROM `images` ORDER BY id DESC';

            $adjacents = 3;
            //echo $sql;
            $numrows = mysqli_num_rows(mysqli_query($connect, $sql));
            $total_pages = $numrows;
            $targetpage = "images.php?"; //your file name  (the name of this file)
            $limit = 12;                                //how many items to show per page
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
                    // $pagination .= "<span class=\"disabled\"> << </span>";
                    $pagination .= "";

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
                ?>
                <div class="imgcontainer">
                    <?php
                    while ($row = mysqli_fetch_array($rs_result)) {
                    ?>

                        <div class="item">
                            <a href="../uploads/<?php echo $row["image_source"]; ?>">
                                <img class="img-responsive" alt="rose red beauty" width="355px" height="200px" src="../uploads/<?php echo $row["image_source"]; ?>">
                            </a>
                            <span align=left><?php echo $row["image_title"]; ?></span>
                            <div class="btn-group">
                                <a class="float-left mr-2" href="edit-image.php?id=<?php echo $row["id"]; ?>"><button type="button" class="d-inline btn sm btn-primary"><i class="d-block fas fa-pencil-alt"></i></button></a>
                                <a class="float-right" href="core/images.php?status=delete&id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to Delete this Image?')"><button type="button" class="d-inline btn sm btn-danger"><i class="d-block fas fa-times"></i></button></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

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
    </div>
</div>

<script src="../lib/js/jquery.row-grid.js"></script>

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

<?php include 'inc/footer.php'; ?>