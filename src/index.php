<?php

require '../vendor/autoload.php';

use App\Router;

$apiV = '/api/v1/';

// Add your routes
Router::add($apiV . 'post_index', 'PostController', 'index');
Router::add($apiV . 'post_show/:id', 'PostController', 'show');
Router::add($apiV . 'post_delete/:id', 'PostController', 'delete');
Router::add($apiV . 'post_create', 'PostController', 'store');
Router::add($apiV . 'post_update', 'PostController', 'update');
Router::add($apiV . 'post_categories', 'PostCategoryController', 'index');
Router::add($apiV . 'post_category_create', 'PostCategoryController', 'store');

$url = $_GET['url'] ?? 'home/index';
Router::route($url);

?>