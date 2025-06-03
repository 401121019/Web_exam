<?php

session_start();
define('ROOT_PATH',__DIR__);
require __DIR__.'/vendor/autoload.php';
require_once(__DIR__.'/helper/functions.php');


use App\Route;
use App\Controller\FrontController;
use App\Controller\AuthController;
use App\Controller\LogoutController;
use App\Controller\PostController;
use Illuminate\Database\Capsule\Manager as Capsule;


$config = require __DIR__.'/config/database.php';
$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$route = new Route();
$route->addRoute("GET","/project/",[FrontController::class, 'home']);
$route->addRoute("GET",'/project/dashboard',[FrontController::class, 'dashboard']);
$route->addRoute("GET","/project/register_successful",[FrontController::class, 'register_successful']);


// login - register - logout
$route->addRoute("GET","/project/login",[AuthController::class, 'login']);
$route->addRoute("POST",'/project/login',[AuthController::class, 'loginuser']);
$route->addRoute("GET","/project/register",[AuthController::class, 'register']);
$route->addRoute("POST","/project/register",[AuthController::class, 'storeuser']);
$route->addRoute("GET", "/project/logout", [LogoutController::class, 'handle']);


// posts
$route->addRoute("GET",'/project/post',[PostController::class, 'index']);
$route->addRoute("GET",'/project/post/create',[PostController::class, 'create']);
$route->addRoute("POST",'/project/post/create',[PostController::class, 'store']);
$route->addRoute("GET",'/project/post/show',[PostController::class, 'show']);
$route->addRoute("GET", "/project/post/delete", [PostController::class, 'delete']);
$route->addRoute("GET", "/project/post/edit", [PostController::class, 'edit']);
$route->addRoute("POST", "/project/post/update", [PostController::class, 'update']);

$request = $_SERVER['REQUEST_URI'];
$base_path = '/project';
$request = str_replace($base_path, '', $request);

// Try to dispatch the route first
$dispatched = $route->dispatch();

// If route was not dispatched by the router, handle it with switch
if (!$dispatched) {
    switch ($request) {
        case '':
        case '/':
            require __DIR__ . '/Views/home.php';
            break;

        case '/post':
            require __DIR__ . '/Views/Posts/index.php';
            break;

        case '/ranked':
            require __DIR__ . '/Views/header.php';
            require __DIR__ . '/Views/ranked_posts.php';
            require __DIR__ . '/Views/footer.php';
            break;

        case (preg_match('/^\/post\/show\?id=\d+$/', $request) ? true : false):
            require __DIR__ . '/Views/Posts/show.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . '/Views/404.php';
            break;
    }
}
