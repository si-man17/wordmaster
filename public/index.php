<?php

function __($data){echo "<pre>"; var_dump($data); echo "</pre>";}

require_once  '../vendor/autoload.php';

use App\Core\Application;
use App\Core\View;


$app = new Application();
// $view = new View();
// $cc = $view->render('test.php', ['name' => 'sergey', 'age' => 32]);

// echo $cc; die();

$app->run();
