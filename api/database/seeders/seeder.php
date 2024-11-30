<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database;

// Define the output SQL file
$outputFile = __DIR__ . '/seed.sql';

try {
    echo "Generating SQL file...\n";
    $sqlStatements = [];

    // Generate SQL for categories
    $sqlStatements[] = generateCategorySQL();

    // Generate SQL for courses
    $sqlStatements[] = generateCourseSQL();

    // Write to the file
    file_put_contents($outputFile, implode("\n", $sqlStatements));
    echo "SQL file generated successfully at: $outputFile\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Generate SQL for Categories
function generateCategorySQL()
{
    echo "Generating SQL for Categories...\n";

    $categoryData = json_decode(file_get_contents(__DIR__ . '/data/categories.json'), true);
    $sql = [];

    foreach ($categoryData as $category) {
        $sql[] = sprintf(
            "INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) " .
            "VALUES ('%s', '%s', %s, NOW(), NOW());",
            addslashes($category['id']),
            addslashes($category['name']),
            $category['parent'] !== null ? "'" . addslashes($category['parent']) . "'" : 'NULL'
        );
    }

    echo "Categories SQL generated successfully!\n";
    return implode("\n", $sql);
}

// Generate SQL for Courses
function generateCourseSQL()
{
    echo "Generating SQL for Courses...\n";

    $courseData = json_decode(file_get_contents(__DIR__ . '/data/courses.json'), true);
    $sql = [];

    foreach ($courseData as $course) {
        $sql[] = sprintf(
            "INSERT INTO `courses` (`id`, `name`, `description`, `image_preview`, `category_id`, `created_at`, `updated_at`) " .
            "VALUES ('%s', '%s', '%s', '%s', '%s', NOW(), NOW());",
            addslashes($course['course_id']),
            addslashes($course['title']),
            addslashes($course['description']),
            addslashes($course['image_preview']),
            addslashes($course['category_id'])
        );
    }

    echo "Courses SQL generated successfully!\n";
    return implode("\n", $sql);
}