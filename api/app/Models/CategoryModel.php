<?php

namespace App\Models;

use App\Database;

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCategories(): array
    {
        $stmt = $this->db->query("
            SELECT 
                c.id,
                c.name,
                c.description,
                c.parent_id,
                COUNT(co.id) AS count_of_courses,
                c.created_at,
                c.updated_at
            FROM categories c
            LEFT JOIN courses co ON c.id = co.category_id
            GROUP BY c.id
        ");
        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->formatCategories($categories);
    }

    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("
            SELECT 
                c.id,
                c.name,
                c.description,
                c.parent_id,
                COUNT(co.id) AS count_of_courses,
                c.created_at,
                c.updated_at
            FROM categories c
            LEFT JOIN courses co ON c.id = co.category_id
            WHERE c.id = :id
            GROUP BY c.id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        $category = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($category) {
            return $this->formatCategory($category);
        }

        return null;
    }


    private function formatCategories($categories): array
    {
        return array_map([$this, 'formatCategory'], $categories);
    }

    private function formatCategory($category)
    {
        $category['created_at'] = $this->convertToIso8601($category['created_at']);
        $category['updated_at'] = $this->convertToIso8601($category['updated_at']);
        $category['parent_id'] = $category['parent_id'] ? $category['parent_id'] : null;
        return $category;
    }

    private function convertToIso8601($date): string
    {
        $datetime = new \DateTime($date);
        return $datetime->format('Y-m-d\TH:i:s.v\Z');
    }

    public function getCoursesByCategoryId($id)
    {
        $stmt = $this->db->prepare("
        SELECT 
            co.id,
            co.name,
            co.description,
            co.image_preview as preview,
            cat.name AS main_category_name,
            co.category_id,
            co.created_at,
            co.updated_at
        FROM courses co
        INNER JOIN categories cat ON co.category_id = cat.id
        WHERE co.category_id = :id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $courses;
    }
}
