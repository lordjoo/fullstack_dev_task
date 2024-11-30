<?php

namespace App\Controllers;

use App\Models\CourseModel;

class CourseController
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    public function getCourses()
    {
        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
        $courses = $this->courseModel->getAllCourses($category_id);
        header('Content-Type: application/json');
        echo json_encode($courses);
    }

    public function getCourseById($id)
    {
        $course = $this->courseModel->getCourseById($id);
        if ($course) {
            header('Content-Type: application/json');
            echo json_encode($course);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['message' => 'Course not found']);
        }
    }
}
