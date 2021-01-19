<?php

require_once 'connection.php';
    $sql = "UPDATE table_record SET table_num={$_GET['tableMoveTo']} WHERE id = {$_GET['tableMoveFromID']}";

    $result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
   
        echo "New record created successfully";
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
    $conn->close();
    ?>
    
