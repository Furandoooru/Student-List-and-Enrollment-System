<?php
include '../db.php';

$keyword = '';
$students = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = $conn->real_escape_string($_GET['keyword']);
    $students = $conn->query("
        SELECT * FROM students 
        WHERE first_name LIKE '%$keyword%' 
           OR last_name LIKE '%$keyword%' 
           OR email LIKE '%$keyword%'
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">🔎 Search Students</h2>
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" class="form-control" placeholder="Search by name or email..." required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php if (!empty($students)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
                </tr>
            </thead>
            <tbody>
            <?php while($student = $students->fetch_assoc()): ?>
                <tr>
                    <td><?= $student['student_id'] ?></td>
                    <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['phone']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($keyword != ''): ?>
        <p class="text-danger">No students found for "<?= htmlspecialchars($keyword) ?>"</p>
    <?php endif; ?>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>
</body>
</html>
