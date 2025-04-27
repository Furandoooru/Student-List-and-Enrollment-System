<?php
include '../db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM enrollments WHERE enrollment_id = $id");

header("Location: index.php");
?>
