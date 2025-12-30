<?php
// public/index.php

// Define Application Root
define('ROOT', dirname(__DIR__));

// Initialize App
require_once '../app/init.php';

use App\Core\App;

$app = new App();
