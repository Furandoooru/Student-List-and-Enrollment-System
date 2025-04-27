<?php
include '../db.php';
$result = $conn->query("
    SELECT grades.*, students.first_name, students.last_name, courses.course_name
    FROM grades
    JOIN enrollments ON grades.enrollment_id = enrollments.enrollment_id
    JOIN students ON enrollments.student_id = students.student_id
    JOIN courses ON enrollments.course_id = courses.course_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9f9f9, #e0f7fa);
            font-family: 'Poppins', sans-serif;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        h2 {
            font-weight: 600;
            margin-bottom: 30px;
        }
        .btn-add {
            background-color: #42a5f5;
            color: white;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-add:hover {
            background-color: #1e88e5;
        }
        table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📄 Manage Grades</h2>
    <a href="create.php" class="btn btn-add mb-3">➕ Add New Grade</a>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th><th>Student</th><th>Course</th><th>Grade</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($grade = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $grade['grade_id'] ?></td>
                <td><?= htmlspecialchars($grade['first_name'] . ' ' . $grade['last_name']) ?></td>
                <td><?= htmlspecialchars($grade['course_name']) ?></td>
                <td><?= htmlspecialchars($grade['grade']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $grade['grade_id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <a href="delete.php?id=<?= $grade['grade_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>

</body>
</html>
