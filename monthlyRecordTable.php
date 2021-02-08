<?php
  require_once 'connection.php';
  $sql = "select year(start_time),month(start_time),sum(charge) from table_record group by year(start_time),month(start_time) order by year(start_time),month(start_time)
  ";
  $result = $conn->query($sql);

  echo "<table class='table table-hover' id='tableRecord'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>year(start_time)</th>
        <th scope='col'>month(start_time)</th>
        <th scope='col'>sum(charge)</th>
      </tr>
    </thead>
    <tbody>";
  if ($result->num_rows > 0) {
    // output data of each row 
    while($row = $result->fetch_assoc()){
      $id = $row["year(start_time)"];
      echo "<tr id = 'tr_$id'>";
        echo "<th scope='row'>";
          echo $row["month(start_time)"];
        echo "</th>";
        echo "<th scope='row'>";
          echo $row["sum(charge)"];
        echo "</th>";
        echo "<td>";
        
        //echo "<td><input type='checkbox' id='del_$id'> </td>";
        echo "<td><button type='button' class='btn btn-primary btn-sm' id='$id'>Delete</button></td>";
      echo "</tr>";
    } 
  }
 

  echo "</tbody>
        </table>";
  $conn->close();
?>