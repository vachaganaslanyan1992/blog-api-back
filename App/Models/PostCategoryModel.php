<?php

namespace App\Models;

use PDO;

class PostCategoryModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM post_categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($categoryName)
    {
        $stmt = $this->db->prepare("INSERT INTO post_categories (category_name) VALUES (:category_name)");
        $stmt->bindParam(':category_name', $categoryName, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return null;
    }
}

?>