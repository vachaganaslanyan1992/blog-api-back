<?php

namespace App\Models;

use PDO;

class PostModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllPosts()
    {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoriesForPost($postId)
    {
        $stmt = $this->db->prepare("SELECT pc.category_name FROM post_categories pc 
                                          INNER JOIN post_category_relations pcr ON pcr.category_id = pc.category_id 
                                          WHERE pcr.post_id = :post_id");
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function store($title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM posts WHERE id = :post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':post_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->execute();
    }

    public function insertPostCategoryRelations($postId, $categoryIds)
    {
        $sql = "INSERT INTO post_category_relations (post_id, category_id) VALUES (:post_id, :category_id)";
        $stmt = $this->db->prepare($sql);

        foreach ($categoryIds as $categoryId) {
            $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}

?>