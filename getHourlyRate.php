<?php

require_once 'connection.php';

    $sql = "SELECT * FROM table_charge";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row 
        while($row = $result->fetch_assoc()) {
        
                echo $row["hourly_charge"]; 
           }
    }
    else {echo 120.00;}


$conn->close();
?>