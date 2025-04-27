<?php
include '../db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM courses WHERE course_id = $id");

header("Location: index.php");
?>
