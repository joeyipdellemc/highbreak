<?php

require_once 'connection.php';

//echo $_POST['table_num'];

$table_num_int  = intval($_GET['table_num']);
echo $table_num_int;
$sql = "INSERT INTO table_record (table_num, start_time, status)
VALUES ($table_num_int , now(), 'started')";

if ($conn->query($sql) === TRUE) {
   
    echo "New record created successfully";
    
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>
