<?php
    require_once 'connection.php';
    //$sql = "SELECT DATE(start_time) AS date, SUM(charge) as total from table_record GROUP by date";
    $sql = "SELECT DATE(start_time) AS date, SUM(charge) as total from table_record  where MONTH(start_time) = {$_GET['monthToQuery']} AND YEAR(start_time) = {$_GET['yearToQuery']} GROUP by date";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row 
        $dailySum = []; 
        while($row = $result->fetch_assoc()){
            $dailySum[] = $row;
            
        }
        echo json_encode($dailySum);
    }
    $conn->close();
    
?>