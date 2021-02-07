<?php
  require_once 'connection.php';
  $sql = "SELECT * FROM table_record  WHERE start_time LIKE '{$_GET['dateToQuery']}%' ORDER BY start_time DESC";
  $result = $conn->query($sql);

  echo "<table class='table table-hover' id='tableRecord'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>ID</th>
        <th scope='col'>Table Number</th>
        <th scope='col'>Start Time</th>
        <th scope='col'>Stop Time</th>
        <th scope='col'>Chrage</th>
        <th scope='col'>Delete</th>
      </tr>
    </thead>
    <tbody>";
  if ($result->num_rows > 0) {
    // output data of each row 
    while($row = $result->fetch_assoc()){
      $id = $row["id"];
      echo "<tr id = 'tr_$id'>";
        echo "<th scope='row'>";
          echo $row["id"];
        echo "</th>";
        echo "<th scope='row'>";
          echo $row["table_num"];
        echo "</th>";
        echo "<td>";
          echo $row["start_time"];
        echo "</td>";
        echo "<td>";
          echo $row["stop_time"];
        echo "</td>";
        echo "<td>";
          echo $row["charge"];
        echo "</td>";

        //echo "<td><input type='checkbox' id='del_$id'> </td>";
        echo "<td><button type='button' class='btn btn-primary btn-sm' id='$id'>Delete</button></td>";
      echo "</tr>";
    } 
  }
 

  echo "</tbody>
        </table>";
  $conn->close();
?>