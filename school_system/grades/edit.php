<?php
include '../db.php';

$id = $_GET['id'];
$grade = $conn->query("SELECT * FROM grades WHERE grade_id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade_value = $conn->real_escape_string($_POST['grade']);

    $conn->query("UPDATE grades SET grade='$grade_value' WHERE grade_id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Grade</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Grade</label>
            <input type="text" name="grade" value="<?= htmlspecialchars($grade['grade']) ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
