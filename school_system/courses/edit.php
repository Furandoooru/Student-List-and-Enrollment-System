<?php
include '../db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM courses WHERE course_id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $conn->real_escape_string($_POST['course_code']);
    $course_name = $conn->real_escape_string($_POST['course_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $credits = intval($_POST['credits']);

    $conn->query("UPDATE courses SET course_code='$course_code', course_name='$course_name', description='$description', credits=$credits WHERE course_id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Course</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Course Code</label>
            <input type="text" name="course_code" value="<?= $row['course_code'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Course Name</label>
            <input type="text" name="course_name" value="<?= $row['course_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?= $row['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Credits</label>
            <input type="number" name="credits" value="<?= $row['credits'] ?>" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
