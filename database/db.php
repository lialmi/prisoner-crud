<?php
$conn = new mysqli('localhost', 'root', '', 'mydb');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
// ?>
  