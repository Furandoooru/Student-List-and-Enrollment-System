<?php
include '../db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM grades WHERE grade_id = $id");

header("Location: index.php");
?>
