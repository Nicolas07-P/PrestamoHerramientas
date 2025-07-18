<?php

if (!isset($_GET['controller'])) {
    header("Location: ?controller=auth&action=login");
    exit;
}
require_once '../routes.php';
