<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
	<title> Highbreak Snooker</title>
	<!-- Bootstrap core CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  

</head>

<body>
	
<!-- Top Bar -->
 <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><img src="media/highbreaklogo.png" class="img-fluid"alt="Highbreak Snooker"></h1>
</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.html">Timer</a>
    <a class="p-2 text-dark" href="record.php">Record</a>
    <a class="p-2 text-dark" href="admin.php">Admin</a>
  </nav>

</div>

<!---Main Record Table -->
<div class="container" >
  <div class="card-deck mb-3 text-center">

  <!-- date  picker -->
  <!--
  <div class="float-left">
  From: <input type="text" id="datepickerFrom"> 
  </div>
  <div class="float-right">
  To: <input type="text" id="datepickerTo">
  </div>
  -->
<script>
    //Display Current Time
    clock();
    function clock(){ 
    // Update the count down every 1 second
    var x = setInterval(function() {
      echo Date();
    }
</script>



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
  else {echo "No Data";}

  echo "</tbody>
        </table>";
  $conn->close();
  ?>
  </div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script>
    $("button").click(function(){
      var $id = this.id;
      var isDelete = confirm("Do you really want to delete record ID " + $id + " ?");
      if (isDelete == true) {
        // AJAX Request
        $.ajax({
          url: 'delete_record.php',
          type: 'GET',
          data: {get_id: $id},
          success: function(response){$("#tr_"+$id).remove();}
        });
      }
    });
  </script>

<script>
  $( function() {
    $( "#datepickerFrom" ).datepicker();
    $( "#datepickerTo" ).datepicker();
  } );
  </script>
 <script>
 
</script>


</body>
</html>