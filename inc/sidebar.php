<div class="sidebar">
    <div class="module-ctg">
        <h4 class="module-title mb-4">CATEGORIES</h4>
        <div class="dtree">
            <div class="dTreeNode"><img class="mr-2" src="img/base.gif" alt=""><a href="javascript:void(0)">Categories</a></div>
            <div class="ctg_group" class="clip" style="display:block; line-height: 26px;">
                <?php
                $sql = mysqli_query($connect, "SELECT * FROM `categories` ORDER BY `position_order` ASC");
                $rowCount = mysqli_num_rows($sql);

                $i = 1;
                while ($row = mysqli_fetch_array($sql)) {
                    $i++;
                ?>
                    <div class="dTree"><img src="<?php echo ($i == $rowCount) ? 'img/join.gif' : 'img/joinbottom.gif'; ?>" alt=""><img id="icon_fld" src="img/folder.gif" alt=""><a id="ctg_name" href="category.php?id=<?php echo $row["id"]; ?>"><?php echo $row["ctg_name"]; ?> <span>(<?php echo Album::albumCount($row['id']); ?>)</span></a></div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>