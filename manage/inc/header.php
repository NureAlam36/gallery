<?php
session_start();
// if not admin
if (!Helper::is_admin_logged_in()) {
    Helper::redirect('login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="icon/favicon.png" type="image/gif" sizes="16x16" />
    <title>Admin Panel</title>

    <!-- All All Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- All Included Css -->
    <link rel="stylesheet" href="lib/css/image-uploader.css">
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../lib/css/font-awesome.min.css">
    <link rel="stylesheet" href="lib/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css">

    <!-- All Included JavaScript -->
    <script src="../lib/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="lib/js/script.js"></script>
    <script src="../lib/js/f1bf2637dc.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="../lib/js/jquery.dataTables.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header Start-->
    <header></header>
    <!-- Header End -->

    <!-- Main Body Start -->
    <div class="container_wrapper">
        <div class="__sidebar">
            <div class="logo"></div>
            <div class="sidebar_items">
                <div class="menu_Div">
                    <a class="toggle_Class" href="index.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="images.php">
                        <i class="far fa-images"></i>
                        <span>Images</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="category.php">
                        <i class="far fa-list-alt"></i>
                        <span>Manage Category</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="album.php">
                        <i class="fas fa-photo-video"></i>
                        <span>Manage Album</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="pages.php">
                        <i class="far fa-file"></i>
                        <span>Pages</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="users.php">
                        <i class="fas fa-users"></i>
                        <span>User Management</span></a>
                </div>
                <div class="menu_Div">
                    <a class="toggle_Class" href="settings.php">
                        <i class="fas fa-tools"></i>
                        <span>Settings</span></a>
                </div>
            </div>
        </div>
        <div class="__main">
            <div class="header_section">
                <div class="section_left">
                    <div class="bar_icon">
                        <svg viewBox="0 0 1349 1500">
                            <g>
                                <g>
                                    <path d="M1230.436,236.221H434.736c-65.395,0-118.564,53.196-118.564,118.564c0,65.395,53.17,118.564,118.564,118.564h795.699 c65.369,0,118.564-53.17,118.564-118.564C1349,289.417,1295.804,236.221,1230.436,236.221z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M1230.436,631.436H434.736c-65.395,0-118.564,53.196-118.564,118.564c0,65.395,53.17,118.564,118.564,118.564h795.699 c65.369,0,118.564-53.17,118.564-118.564C1349,684.631,1295.804,631.436,1230.436,631.436z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M1230.436,1026.65H434.736c-65.395,0-118.564,53.196-118.564,118.564c0,65.395,53.17,118.564,118.564,118.564h795.699 c65.369,0,118.564-53.17,118.564-118.564C1349,1079.846,1295.804,1026.65,1230.436,1026.65z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M118.564,236.221C53.17,236.221,0,289.417,0,354.785C0,420.18,53.17,473.35,118.564,473.35 c65.369,0,118.564-53.17,118.564-118.564C237.129,289.417,183.933,236.221,118.564,236.221z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M118.564,631.436C53.17,631.436,0,684.631,0,750c0,65.395,53.17,118.564,118.564,118.564 c65.369,0,118.564-53.17,118.564-118.564C237.129,684.631,183.933,631.436,118.564,631.436z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M118.564,1026.65C53.17,1026.65,0,1079.846,0,1145.215c0,65.395,53.17,118.564,118.564,118.564 c65.369,0,118.564-53.17,118.564-118.564C237.129,1079.846,183.933,1026.65,118.564,1026.65z" />
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="section_right">
                    <div class="dropdown">
                        <div id="icon">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <span id="user_name">Admin</span>
                        <div id="caret-down">
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <ul class="dropdown_menu">
                        <li><a href="change-password.php"><i class="fas fa-unlock-alt"></i> Change password</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="main-body">