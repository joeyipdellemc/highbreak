<?php

require_once 'connection.php';

    //$sql = "SELECT * FROM table_record where table_num = {$_GET['table_num']} order by start_time DESC limit 1";
    //$sql = "SELECT start_time FROM table_record where table_num = {$_GET['table_num']} order by start_time DESC limit 1";
    //$sql = "SELECT start_time FROM table_record where table_num = 2 order by start_time DESC limit 1";
    $sql = "SELECT SUM(charge) totalCharge FROM table_record WHERE start_time LIKE '{$_GET['dateToQuery']}%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row 
            while($row = $result->fetch_assoc()) {
            
                    echo $row["totalCharge"]; 
               }
        }
        else {echo 0.00;}

$conn->close();
?>