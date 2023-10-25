<?php

namespace App\Services;

use App\DBConnection;
use App\Models\PostCategoryModel;

class PostCategoryService
{
    private $model;

    public function __construct()
    {
        $databaseConnection = DBConnection::getInstance();
        $connection = $databaseConnection->getConnection();
        $this->model = new PostCategoryModel($connection);
    }

    public function getAllCategories()
    {
        return $this->model->getAllCategories();
    }

    public function addCategory($categoryName)
    {
        return $this->model->store($categoryName);
    }
}

?>