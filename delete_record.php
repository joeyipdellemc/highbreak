<?php

require_once 'connection.php';

$get_id  = $_GET['get_id'];
echo $get_id;

foreach ($getid as $id){
    echo "$id";
}

$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $value) {
  echo "$value <br>";
}

    /*
    $sql = "DELETE FROM table_record WHERE id=$get_id";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
*/
$conn->close();
?>
