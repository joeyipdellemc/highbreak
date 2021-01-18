
<?php
require_once 'connection.php';
$get_id  = $_GET['get_id'];

$sql = "DELETE FROM table_record WHERE id=$get_id"; 

if ($conn->query($sql) === TRUE) {
   
    echo "Deleted Record Successfully";
    
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>