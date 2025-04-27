<?php
include '../db.php';
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
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
            margin-bottom: 20px;
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
        #searchInput {
            margin-bottom: 20px;
            padding: 8px 15px;
            width: 100%;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</head>
<body>

<div class="container">
    <h2>🎓 Manage Students</h2>
    <a href="create.php" class="btn btn-add">➕ Add New Student</a>
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="🔍 Search students...">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th><th>Name</th><th>Birth Date</th><th>Gender</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($student = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $student['student_id'] ?></td>
                <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                <td><?= htmlspecialchars($student['birth_date']) ?></td>
                <td><?= htmlspecialchars($student['gender']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['phone']) ?></td>
                <td><?= htmlspecialchars($student['address']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $student['student_id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <a href="delete.php?id=<?= $student['student_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>

</body>
</html>
