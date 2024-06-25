<?php
//connection sa databse
include 'database/db.php';


//if na submit ang form  using post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prisonerName = htmlspecialchars($_POST['prisonerName']);
    $case = htmlspecialchars($_POST['case']);
    
    //way to insert data
    $sql = 'INSERT INTO crud (prisonerName, `case`, date_created) VALUES (?, ?, NOW())';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $prisonerName, $case);
    $stmt->execute();
    
    // close then mag redirect sa index.php
    $stmt->close();
    header('Location: index.php');
    exit(); 
}

