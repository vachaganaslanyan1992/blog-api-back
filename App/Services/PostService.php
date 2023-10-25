<?php

namespace App\Services;

use App\DBConnection;
use App\Models\PostModel;
use PDOException;

class PostService
{
    private $model;

    private $db;

    public function __construct()
    {
        $databaseConnection = DBConnection::getInstance();
        $this->db = $databaseConnection->getConnection();
        $this->model = new PostModel($this->db);
    }

    /**
     * @return array|false
     */
    public function getAllPosts()
    {
        $posts = $this->model->getAllPosts();

        foreach ($posts as &$post) {
            $post['categories'] = $this->model->getCategoriesForPost($post['id']);
        }

        return $posts;
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function getPost($postId)
    {
        $post = $this->model->getById($postId);
        if ($post) {
            $post['categories'] = $this->model->getCategoriesForPost($post['id']);
        }
        return $post;
    }

    public function addPost($data)
    {
        try {
            $this->db->beginTransaction();

            $postId = $this->model->store($data['title'], $data['content']);

            if (!$postId) {
                throw new PDOException("Error inserting the post");
            }

            if (!empty($data['categories'])) {
                $this->model->insertPostCategoryRelations($postId, $data['categories']);
            }

            $this->db->commit();

        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }

        return true;
    }

    public function deletePost($postId)
    {
        return $this->model->delete($postId);
    }
}

?>