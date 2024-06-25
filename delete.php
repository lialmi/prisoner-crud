<?php
include 'database/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('DELETE FROM crud WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    header('Location: index.php');
}

