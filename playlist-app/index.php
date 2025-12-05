<?php

session_start();

require_once __DIR__ . '/controllers/PlaylistController.php';

$controller = new PlaylistController();
$controller->handleRequest();

require_once __DIR__ . '/views/index.view.php';
?>