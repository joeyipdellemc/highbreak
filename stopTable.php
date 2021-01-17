<?php

require_once 'connection.php';

//echo $_POST['table_num'];

$table_num_int  = intval($_GET['table_num']);
$charge  = floatval($_GET['charge']);
echo $table_num_int;
$sql = "UPDATE table_record SET table_num=$table_num_int, stop_time=now(), status='stopped', charge=$charge WHERE table_num = $table_num_int order by start_time DESC limit 1"; 

if ($conn->query($sql) === TRUE) {
   
    echo "New record updated successfully";
    
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>