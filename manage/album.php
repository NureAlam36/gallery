<?php require 'classes/Helper.php'; ?>
<?php require '../classes/Database.php'; ?>
<?php require 'classes/Album.php'; ?>
<?php require 'classes/Category.php'; ?>
<?php require 'classes/Gallery.php'; ?>
<?php include 'inc/header.php'; ?>

<!-- include libraries(jQuery, bootstrap) -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include jquery -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->

<!-- include libraries BS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<!-- include summernote -->
<!-- <script src="lib/css/summernote-bs4.css"></script>
<script src="lib/js/summernote-bs4.js"></script> -->
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/wysiwyg-editor-summernote/summernote-bs4.css">
<script type="text/javascript" src="https://www.jqueryscript.net/demo/wysiwyg-editor-summernote/summernote-bs4.js"></script>

<script type="text/javascript">
    document.oncontextmenu = document.body.oncontextmenu = function() {
        //return false;
    }

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 120,
            placeholder: '@ Album Description'
        });
    });
</script>

<?php
// Instantiate DB & connect
$database = new Database();
$connect = $database->connect();

// Instantiate album object
$album = new Album();
$result1 = $album->getAllAlbums();

// Instantiate helper object
$helper = new Helper();

// Instantiate category object
$category = new Category();
$result2  = $category->getAllCategories();

// Instantiate gallery object
$gallery = new Gallery();
$result3 = $gallery->getAllImages();
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Album</li>
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

<div class="alb-wrp">
    <div class="form-container">
        <div class="card-header">
            Add Album
        </div>
        <div class="form-body">
            <form action="core/album.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Album Name</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="album_name" placeholder="Album Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">
                            Album thumbnail :
                            <br />
                            <small class="mr-2">600px X 400px</small>
                        </label>
                        <span class="form-indicat"></span>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" name="album_thumb" required />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Select Category</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <select name="category" class="form-control form-control-sm">
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
                        <label for="">Description</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <!-- <textarea id="desc" placeholder="Album Description" name="album_body" rows="4" class="form-control form-control-sm"></textarea> -->
                        <textarea name="album_body" class="summernote"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="end">
                        <label for="">Keywords</label>
                        <span class="form-indicat">:</span>
                    </div>
                    <div class="col-sm-8">
                        <textarea id="desc" placeholder="animal, horse, cat, dog" name="album_keywords" rows="4" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" name="addAlbum" value="true" class="btn primary">Add Album</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="album">
        <div class="card-header">
            Album List
        </div>
        <div class="album-group">
            <?php
            $sql = 'SELECT * FROM `albums` ORDER BY id DESC';

            $adjacents = 3;
            //echo $sql;
            $numrows = mysqli_num_rows(mysqli_query($connect, $sql));
            $total_pages = $numrows;
            $targetpage = "album.php"; //your file name  (the name of this file)
            $limit = 10;                                //how many items to show per page
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
                ?>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($rs_result)) {
                    ?>
                        <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-xxl-2">
                            <div class="card mb-4">
                                <div class="card-img-body">
                                    <img class="card-img" src="../uploads/<?php if (!empty($row["album_thumb"])) {
                                                                                echo $row["album_thumb"];
                                                                            } else {
                                                                                echo 'no-photo.png';
                                                                            } ?>" alt="<?php echo $row["album_name"]; ?>" title="<?php echo $row["album_name"]; ?>">
                                </div>
                                <div class="card-body">
                                    <div class="album_name mt-1 mb-1">
                                        <h6><?php echo $row["album_name"]; ?></h6>
                                    </div>
                                    <div class="left float-left">
                                        <i class="far fa-images" aria-hidden="true"></i> <span>(<?php echo Helper::totalImagesByAlbum($row["id"]); ?>)</span>
                                    </div>
                                    <div class="right float-right">
                                        <a class="float-left mr-2" href="edit-album.php?id=<?php echo $row["id"]; ?>"><button type="button" class="d-inline btn sm btn-primary"><i class="d-block fas fa-pencil-alt"></i></button></a>
                                        <a class="float-right" href="core/album.php?status=delete&id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to Delete this Image?')"><button type="button" class="d-inline btn sm btn-danger"><i class="d-block fas fa-times"></i></button></a>
                                    </div>
                                </div>
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

<?php include 'inc/footer.php'; ?>