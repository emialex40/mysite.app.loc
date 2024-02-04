<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

define('APP_PATH', __DIR__);

use App\App;

$app = new App();

$app->run();
