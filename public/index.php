<?php

use Router\Router;


require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_NAME', 'p5_ocr-');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router($_GET['url']);

$router->get('/', 'src\controllers\MainController@homepage');

/* Route User */
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
$router->post('/admin/user/delete/:id', 'src\controllers\UserController@deleteUser');
$router->post('/admin/user/admin/:id', 'src\controllers\UserController@setUserAdmin');

/* Route Post */
$router->get('/posts', 'src\controllers\PostController@posts');
$router->get('/post/:id', 'src\controllers\PostController@show');
$router->get('/admin', 'src\controllers\PostController@homepageAdmin');
$router->get('/admin/posts', 'src\controllers\PostController@showAdminPosts');
$router->post('/admin/posts/status/:id', 'src\controllers\PostController@togglePost');
$router->post('/admin/posts/delete/:id', 'src\controllers\PostController@deletePost');
$router->get('/admin/posts/edit/:id', 'src\controllers\PostController@editPost');
$router->post('/admin/posts/edit/:id', 'src\controllers\PostController@updatePost');
$router->get('/admin/comments', 'src\controllers\PostController@showCommentsByPost');
$router->get('/admin/post/add', 'src\controllers\PostController@addPostView');
$router->post('/admin/post/add', 'src\controllers\PostController@createPost');

/* Route Comment */
$router->post('/admin/comment/status/:id', 'src\controllers\CommentController@toggleComment');
$router->post('/admin/comment/delete/:id', 'src\controllers\CommentController@deleteComment');
$router->post('/post/:id', 'src\controllers\CommentController@commentPost');

$router->run();

if (!$router->matchFound) {
    include VIEWS . '404.php';
}