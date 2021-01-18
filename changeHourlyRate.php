<?php

require_once 'connection.php';
    $changeRate  = intval($_GET['changeRate']);
    $sql = "UPDATE table_charge SET hourly_charge=$changeRate";

    $result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
   
        echo "New record created successfully";
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
    $conn->close();
    ?>
    


