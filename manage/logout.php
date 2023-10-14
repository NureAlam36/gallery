<?php
require_once('function.php');
session_start();

if (session_destroy())
    redirect("login.php");
exit;
