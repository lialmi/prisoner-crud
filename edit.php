<?php
//the database connection 
include 'database/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id']; 
    $prisonerName = $_POST['prisonerName']; 
    $case = $_POST['case']; 


    $stmt = $conn->prepare('UPDATE crud SET prisonerName = ?, `case` = ? WHERE id = ?');

    if ($stmt) {
        $stmt->bind_param('ssi', $prisonerName, $case, $id);
        
       
        if ($stmt->execute()) {
            $stmt->close();
            //redirect after upsating the record  
            header('Location: index.php');
            exit(); 
        } else {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    } else {
        die('Prepare failed: ' . htmlspecialchars($conn->error)); 
    }
}
  