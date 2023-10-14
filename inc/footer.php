</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-column">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <span class="footer-title">Top Albums</span>
                    </li>
                    <?php
                    $topAlbums = Album::getTopAlbums();
                    while ($row = $topAlbums->fetch_assoc()) {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="album.php?id=<?php echo $row["id"]; ?>"><?php echo $row["album_name"]; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-4 footer-column">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <span class="footer-title">Company</span>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="page.php?view=about-us">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="page.php?view=privacy-policy">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4 footer-column">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <span class="footer-title">Contact & Support</span>
                    </li>
                    <li class="nav-item"><span class="nav-link"><i class="fas fa-phone"></i>+47 45 80 80 80</span></li>
                    <li class="nav-item"><a class="nav-link" href="page.php?view=contact"><i class="fas fa-envelope"></i>Contact us</a></li>
                </ul>
            </div>
        </div>

        <div class="text-center"><i class="fas fa-ellipsis-h"></i></div>

        <div class="row text-center">
            <div class="col-md-4 box">
                <span class="copyright quick-links">Copyright &copy; Your Website <script>
                        document.write(new Date().getFullYear())
                    </script>
                </span>
            </div>
            <div class="col-md-4 box">
                <ul class="list-inline social-buttons">
                    <?php
                    if (!empty($twitter = Helper::get_option('twitter-url'))) {
                    ?>
                        <li class="list-inline-item">
                            <a href="<?php echo $twitter; ?>">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($facebook = Helper::get_option('facebook-url'))) {
                    ?>
                        <li class="list-inline-item">
                            <a href="<?php echo $facebook; ?>">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($linkedin = Helper::get_option('linkedin-url'))) {
                    ?>
                        <li class="list-inline-item">
                            <a href="<?php echo $linkedin; ?>">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-4 box">
                <ul class="list-inline quick-links">
                    <li class="list-inline-item">
                        <a href="page.php?view=privacy-policy">Privacy Policy</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="page.php?view=terms">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>

</html>