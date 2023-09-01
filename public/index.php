<?php

use Router\Router;


require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_NAME', 'p5_ocr');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router($_GET['url']); 

$router->get('/', 'src\controllers\MainController@homepage');
$router->get('/posts', 'src\controllers\PostController@posts');
$router->get('/post/:id', 'src\controllers\PostController@show');

$router->get('/login', 'src\controllers\UserController@login');
$router->get('/signin', 'src\controllers\UserController@signIn');

$router->get('/admin/posts', 'src\controllers\PostController@getAdminPosts');
$router->post('/admin/posts/delete/:id', 'src\controllers\PostController@deletePost');
$router->get('/admin/posts/edit/:id', 'src\controllers\PostController@editPost');
$router->post('/admin/posts/edit/:id', 'src\controllers\PostController@updatePost');

$router->run();