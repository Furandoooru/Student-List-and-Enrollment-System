<?php
include '../db.php';

$keyword = '';
$courses = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = $conn->real_escape_string($_GET['keyword']);
    $courses = $conn->query("
        SELECT * FROM courses 
        WHERE course_name LIKE '%$keyword%' 
           OR course_code LIKE '%$keyword%'
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">🔎 Search Courses</h2>
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" class="form-control" placeholder="Search by name or code..." required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php if (!empty($courses)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th><th>Course Code</th><th>Course Name</th><th>Credits</th>
                </tr>
            </thead>
            <tbody>
            <?php while($course = $courses->fetch_assoc()): ?>
                <tr>
                    <td><?= $course['course_id'] ?></td>
                    <td><?= htmlspecialchars($course['course_code']) ?></td>
                    <td><?= htmlspecialchars($course['course_name']) ?></td>
                    <td><?= htmlspecialchars($course['credits']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($keyword != ''): ?>
        <p class="text-danger">No courses found for "<?= htmlspecialchars($keyword) ?>"</p>
    <?php endif; ?>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>
</body>
</html>
