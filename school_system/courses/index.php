<?php
include '../db.php';
$result = $conn->query("SELECT * FROM courses");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Courses</title>
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
    <h2>📚 Manage Courses</h2>
    <a href="create.php" class="btn btn-add mb-3">➕ Add New Course</a>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th><th>Course Code</th><th>Course Name</th><th>Description</th><th>Credits</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($course = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $course['course_id'] ?></td>
                <td><?= htmlspecialchars($course['course_code']) ?></td>
                <td><?= htmlspecialchars($course['course_name']) ?></td>
                <td><?= htmlspecialchars($course['description']) ?></td>
                <td><?= $course['credits'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $course['course_id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <a href="delete.php?id=<?= $course['course_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>

</body>
</html>
