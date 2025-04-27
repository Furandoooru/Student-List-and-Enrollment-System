<?php
include '../db.php';

$id = $_GET['id'];
$enrollment = $conn->query("SELECT * FROM enrollments WHERE enrollment_id = $id")->fetch_assoc();

$students = $conn->query("SELECT * FROM students");
$courses = $conn->query("SELECT * FROM courses");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = intval($_POST['student_id']);
    $course_id = intval($_POST['course_id']);
    $enrollment_date = $conn->real_escape_string($_POST['enrollment_date']);
    $status = $conn->real_escape_string($_POST['status']);

    $conn->query("UPDATE enrollments SET student_id=$student_id, course_id=$course_id, enrollment_date='$enrollment_date', status='$status' WHERE enrollment_id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Enrollment</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                <?php while($student = $students->fetch_assoc()): ?>
                    <option value="<?= $student['student_id'] ?>" <?= ($student['student_id'] == $enrollment['student_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control" required>
                <?php while($course = $courses->fetch_assoc()): ?>
                    <option value="<?= $course['course_id'] ?>" <?= ($course['course_id'] == $enrollment['course_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($course['course_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Enrollment Date</label>
            <input type="date" name="enrollment_date" value="<?= $enrollment['enrollment_date'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Enrolled" <?= ($enrollment['status'] == 'Enrolled') ? 'selected' : '' ?>>Enrolled</option>
                <option value="Dropped" <?= ($enrollment['status'] == 'Dropped') ? 'selected' : '' ?>>Dropped</option>
                <option value="Completed" <?= ($enrollment['status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
