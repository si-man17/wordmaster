<?php

function __($data){echo "<pre>"; var_dump($data); echo "</pre>";}

require_once  '../vendor/autoload.php';

use App\Core\Application;
use App\Core\View;
use App\Src\Model\User;

$app = new Application();
$app->run();

