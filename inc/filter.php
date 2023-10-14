<section class="d-flex">
    <select name="rpp" class="form-control mr-2" style="width: auto;">
        <option value="12" <?php echo isset($_GET["rpp"]) && $_GET["rpp"] == '12' ? 'selected' : ''; ?>>12</option>
        <option value="28" <?php echo isset($_GET["rpp"]) && $_GET["rpp"] == '28' ? 'selected' : ''; ?>>28</option>
        <option value="36" <?php echo isset($_GET["rpp"]) && $_GET["rpp"] == '36' ? 'selected' : ''; ?>>36</option>
    </select>
    <select name="order" class="form-control" style="width: auto;">
        <option value="asc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'asc' ? 'selected' : ''; ?>>Ordering ASC</option>
        <option value="desc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'desc' ? 'selected' : ''; ?>>Ordering DESC</option>
        <option value="title-asc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'title-asc' ? 'selected' : ''; ?>>Title ASC</option>
        <option value="title-desc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'title-desc' ? 'selected' : ''; ?>>Title DESC</option>
        <option value="date-asc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'date-asc' ? 'selected' : ''; ?>>Date ASC</option>
        <option value="date-desc" <?php echo isset($_GET["order"]) && $_GET["order"] == 'title-desc' ? 'selected' : ''; ?>>Date DESC</option>
    </select>
    <button class="filter-btn ml-2 btn btn-sm" type="submit">Filter</button>
</section>