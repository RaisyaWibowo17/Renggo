<?php

$port = env('PORT', 8000);

// Forward ke public/index.php
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
require_once __DIR__ . '/public/index.php';