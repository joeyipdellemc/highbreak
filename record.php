<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
	<title> Highbreak Snooker</title>
	<!-- Bootstrap core CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
	
<!-- Top Bar -->
 <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><img src="media/highbreaklogo.png" class="img-fluid"alt="Highbreak Snooker"></h1>
</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.html">Timer</a>
  </nav>

  <a class="btn btn-outline-primary" href="#">Login</a>
</div>

<!---Main Record Table -->
<div class="container">
  <input type='button' value='Delete' id='delete'><br><br>
<div>
<div class="container">
  <div class="card-deck mb-3 text-center">
  <?php
  require_once 'connection.php';
  $sql = "SELECT * FROM table_record ORDER BY start_time DESC";
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
      echo "<tr>";
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

        $id = $row["id"];
        echo "<td><input type='checkbox' id='del_$id'> </td>";
        echo "</tr>";
    } 
  }
  else {echo "No Data";}

  echo "</tbody>
        </table>";
  $conn->close();
  ?>
  </div>
</div>


<!-----------Footer ----------->
<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted" id="globalTime" > Current Time</span>
  </div>
</footer>

<footer class="fixed-bottom">
  <div class="container">
    <span class="text-muted" id="hourlyRate" >Hourly Rate</span>
  </div>
</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="/script/delete_script.js"></script> 


</body>
</html>