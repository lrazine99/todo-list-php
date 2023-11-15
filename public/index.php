<html>
<?php

use Router\Router;
//appel de l'autoload de composer pour facilement utilisé les class
require '../vendor/autoload.php';

//definition des constantes pour les chemins et pour les données de la bdd
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_name', 'todolist');
define('DB_host','127.0.0.1');
define('DB_username', 'root');
define('DB_password', '');

//instance objet router pour comparer l'url
$router = new Router($_GET['url']);

//ensemble des url avec leurs methodes à comparer
$router->get('/', 'App\Controllers\UserController@login');
$router->post('/', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logout');

    $router->get('/list',        'App\Controllers\ListController@show');
    $router->get('/list/item/edit/:id','App\Controllers\ListController@editItem');
    $router->post('/list/item/update/:id','App\Controllers\ListController@updateItem');
    $router->post('/list/item/add','App\Controllers\ListController@addItem');
    $router->get('/list/item/finish/:id','App\Controllers\ListController@finishItem');
    $router->get('/list/item/delete/:id','App\Controllers\ListController@deleteItem');
    $router->get('/list/item/deleteAll/:param','App\Controllers\ListController@deleteItems');
    
    $router->get('/list/categorie','App\Controllers\ListController@showCategorie');
    $router->get('/list/categorie/edit/:id','App\Controllers\ListController@editCategorie');
    $router->post('/list/categorie/update/:id','App\Controllers\ListController@updateCategorie');
    $router->post('/list/categorie/add','App\Controllers\ListController@addCategorie');
    $router->get('/list/categorie/delete/:id','App\Controllers\ListController@deleteCategorie');



$router->run();
?> 
