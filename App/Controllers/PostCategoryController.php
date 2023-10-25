<?php

namespace App\Controllers;

use App\Services\PostCategoryService;

class PostCategoryController
{
    private $service;

    public function __construct()
    {
        $this->service = new PostCategoryService();
    }

    public function index()
    {
        $posts = $this->service->getAllCategories();
        echo json_encode($posts);
    }

    public function store($categoryName)
    {
        $categoryId = $this->service->addCategory($categoryName);
        echo json_encode($categoryId);
    }
}

?>