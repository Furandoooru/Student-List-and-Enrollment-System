<?php
include '../db.php';

$students = $conn->query("SELECT * FROM students");
$courses = $conn->query("SELECT * FROM courses");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = intval($_POST['student_id']);
    $course_id = intval($_POST['course_id']);
    $enrollment_date = $conn->real_escape_string($_POST['enrollment_date']);
    $status = $conn->real_escape_string($_POST['status']);

    $conn->query("INSERT INTO enrollments (student_id, course_id, enrollment_date, status) 
                  VALUES ($student_id, $course_id, '$enrollment_date', '$status')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">➕ Add New Enrollment</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                <?php while($student = $students->fetch_assoc()): ?>
                    <option value="<?= $student['student_id'] ?>"><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-control" required>
                <?php while($course = $courses->fetch_assoc()): ?>
                    <option value="<?= $course['course_id'] ?>"><?= htmlspecialchars($course['course_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Enrollment Date</label>
            <input type="date" name="enrollment_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Enrolled">Enrolled</option>
                <option value="Dropped">Dropped</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
