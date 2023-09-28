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

$router->get('/', 'src\controllers\UserController@loginPost');
$router->get('/signin', 'src\controllers\UserController@signIn');
$router->post('/signin', 'src\controllers\UserController@signInPost');
$router->get('/login', 'src\controllers\UserController@login');
$router->post('/login', 'src\controllers\UserController@loginPost');
$router->get('/logout', 'src\controllers\UserController@logout');
$router->get('/profil/:id', 'src\controllers\UserController@editUserProfil');
$router->post('/profil/:id', 'src\controllers\UserController@updateUserProfil');
$router->get('/admin/user/edit/:id', 'src\controllers\UserController@adminEditUserProfil');
$router->post('admin/user/edit/:id', 'src\controllers\UserController@adminUpdateUserProfil');
$router->get('/admin/users', 'src\controllers\UserController@getUsers');
$router->post('/admin/user/status/:id', 'src\controllers\UserController@toggleUser');

$router->get('/posts', 'src\controllers\PostController@posts');
$router->get('/post/:id', 'src\controllers\PostController@show');
$router->get('/admin', 'src\controllers\PostController@homepageAdmin');
$router->get('/admin/posts', 'src\controllers\PostController@getAdminPosts');
$router->post('/admin/posts/status/:id', 'src\controllers\PostController@togglePost');
$router->post('/admin/posts/delete/:id', 'src\controllers\PostController@deletePost');
$router->get('/admin/posts/edit/:id', 'src\controllers\PostController@editPost');
$router->post('/admin/posts/edit/:id', 'src\controllers\PostController@updatePost');
$router->get('/admin/comments', 'src\controllers\PostController@showCommentsByPost');
$router->get('/admin/post/add', 'src\controllers\PostController@addPostView');
$router->post('/admin/post/add', 'src\controllers\PostController@createPost');

$router->post('/post/:id', 'src\controllers\CommentController@commentPost');

$router->run();