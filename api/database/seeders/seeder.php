<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database;
$pdo = Database::getInstance()->getConnection();

try {
    echo "Connected to the database successfully!\n";
    // Seed the categories and courses tables
    seedCategories($pdo);
    seedCourses($pdo);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Seeder for Categories
function seedCategories($pdo)
{
    echo "Seeding Categories...\n";

    $categoryData = json_decode(file_get_contents(__DIR__.'/data/categories.json'), true);

    $stmt = $pdo->prepare("
        INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`)
        VALUES (:id, :name, :parent_id, NOW(), NOW())
    ");

    foreach ($categoryData as $category) {
        var_dump($category);
        $stmt->execute([
            ':id' => $category['id'],
            ':name' => $category['name'],
            ':parent_id' => $category['parent'], // assuming `parent` is the parent category id
        ]);
    }

    echo "Categories seeded successfully!\n";
}

// Seeder for Courses
function seedCourses($pdo)
{
    echo "Seeding Courses...\n";

    $courseData = json_decode(file_get_contents(__DIR__.'/data/courses.json'), true);

    $stmt = $pdo->prepare("
        INSERT INTO `courses` (`id`,`name`, `description`, `image_preview`, `category_id`, `created_at`, `updated_at`)
        VALUES (:id, :name, :description, :image_preview, :category_id, NOW(), NOW())
    ");

    foreach ($courseData as $course) {
        $stmt->execute([
            ':id' => $course['course_id'],
            ':name' => $course['title'],
            ':description' => $course['description'],
            ':image_preview' => $course['image_preview'],
            ':category_id' => $course['category_id'], // assuming category_id is valid
        ]);
    }

    echo "Courses seeded successfully!\n";
}
