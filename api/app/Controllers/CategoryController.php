<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        header('Content-Type: application/json');
        echo json_encode($categories);
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            header('Content-Type: application/json');
            echo json_encode($category);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['message' => 'Category not found']);
        }
    }

    public function getCoursesByCategoryId($id)
    {
        $courses = $this->categoryModel->getCoursesByCategoryId($id);
        header('Content-Type: application/json');
        echo json_encode($courses);
    }
}
