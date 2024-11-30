<?php

namespace App\Models;

use App\Database;

class CourseModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCourses($category_id = null)
    {
        $query = "
            SELECT 
                c.id,
                c.name,
                c.description,
                c.image_preview AS preview,
                cat.name AS main_category_name,
                c.created_at,
                c.updated_at
            FROM courses c
            INNER JOIN categories cat ON c.category_id = cat.id
        ";

        if ($category_id) {
            $query .= " WHERE c.category_id = :category_id";
        }

        $stmt = $this->db->prepare($query);

        if ($category_id) {
            $stmt->bindParam(':category_id', $category_id, \PDO::PARAM_INT);
        }

        $stmt->execute();
        $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->formatCourses($courses);
    }

    public function getCourseById($id)
    {
        $stmt = $this->db->prepare("
            SELECT 
                c.id,
                c.name,
                c.description,
                c.image_preview AS preview,
                cat.name AS main_category_name,
                c.created_at,
                c.updated_at
            FROM courses c
            INNER JOIN categories cat ON c.category_id = cat.id
            WHERE c.id = :id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $course = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($course) {
            return $this->formatCourse($course);
        }

        return null;
    }

    private function formatCourses($courses)
    {
        return array_map([$this, 'formatCourse'], $courses);
    }

    private function formatCourse($course)
    {
        $course['created_at'] = $this->convertToIso8601($course['created_at']);
        $course['updated_at'] = $this->convertToIso8601($course['updated_at']);
        return $course;
    }

    private function convertToIso8601($date)
    {
        $datetime = new \DateTime($date);
        return $datetime->format('Y-m-d\TH:i:s.v\Z');
    }
}
