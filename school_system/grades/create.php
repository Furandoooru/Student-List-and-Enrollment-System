<?php
include '../db.php';

$enrollments = $conn->query("
    SELECT enrollments.*, students.first_name, students.last_name, courses.course_name
    FROM enrollments
    JOIN students ON enrollments.student_id = students.student_id
    JOIN courses ON enrollments.course_id = courses.course_id
");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment_id = intval($_POST['enrollment_id']);
    $grade = $conn->real_escape_string($_POST['grade']);

    $conn->query("INSERT INTO grades (enrollment_id, grade) VALUES ($enrollment_id, '$grade')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">➕ Add New Grade</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Enrollment</label>
            <select name="enrollment_id" class="form-control" required>
                <?php while($enrollment = $enrollments->fetch_assoc()): ?>
                    <option value="<?= $enrollment['enrollment_id'] ?>">
                        <?= htmlspecialchars($enrollment['first_name'] . ' ' . $enrollment['last_name'] . ' - ' . $enrollment['course_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Grade</label>
            <input type="text" name="grade" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
