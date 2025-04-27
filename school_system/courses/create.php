<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $conn->real_escape_string($_POST['course_code']);
    $course_name = $conn->real_escape_string($_POST['course_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $credits = intval($_POST['credits']);

    $conn->query("INSERT INTO courses (course_code, course_name, description, credits) 
                  VALUES ('$course_code', '$course_name', '$description', $credits)");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">➕ Add New Course</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Course Code</label>
            <input type="text" name="course_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Course Name</label>
            <input type="text" name="course_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Credits</label>
            <input type="number" name="credits" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
