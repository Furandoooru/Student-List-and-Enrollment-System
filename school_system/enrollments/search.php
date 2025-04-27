<?php
include '../db.php';

$keyword = '';
$enrollments = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = $conn->real_escape_string($_GET['keyword']);
    $enrollments = $conn->query("
        SELECT e.enrollment_id, s.first_name, s.last_name, c.course_name, e.enrollment_date, e.status
        FROM enrollments e
        JOIN students s ON e.student_id = s.student_id
        JOIN courses c ON e.course_id = c.course_id
        WHERE s.first_name LIKE '%$keyword%'
           OR s.last_name LIKE '%$keyword%'
           OR c.course_name LIKE '%$keyword%'
           OR e.status LIKE '%$keyword%'
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Enrollments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">🔎 Search Enrollments</h2>
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" class="form-control" placeholder="Search by student, course, or status..." required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php if (!empty($enrollments)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Enrollment ID</th><th>Student</th><th>Course</th><th>Date</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while($enroll = $enrollments->fetch_assoc()): ?>
                <tr>
                    <td><?= $enroll['enrollment_id'] ?></td>
                    <td><?= htmlspecialchars($enroll['first_name'] . ' ' . $enroll['last_name']) ?></td>
                    <td><?= htmlspecialchars($enroll['course_name']) ?></td>
                    <td><?= htmlspecialchars($enroll['enrollment_date']) ?></td>
                    <td><?= htmlspecialchars($enroll['status']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($keyword != ''): ?>
        <p class="text-danger">No enrollments found for "<?= htmlspecialchars($keyword) ?>"</p>
    <?php endif; ?>

    <a href="../index.php" class="btn btn-secondary mt-3">🏠 Back to Dashboard</a>
</div>
</body>
</html>
