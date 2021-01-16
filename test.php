<?php

require_once 'connection.php';

$sql = "INSERT INTO table_record (table_num, start_time, status)
VALUES (2, now(), 1)";

if ($conn->query($sql) === TRUE) {
    echo "<br>";
    echo "New record created successfully";
    
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>
