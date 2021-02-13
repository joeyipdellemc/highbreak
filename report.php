<!DOCTYPE html>
<?php require_once 'connection.php'; ?>
<html>
<head>
	<title> Highbreak Snooker</title>
	<!-- Bootstrap core CSS -->
	<link href="./lib/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./lib/jquery-ui/jquery-ui.css">
  <script src="./lib/jquery-ui/external/jquery/jquery.js"></script> 
  <script src="./lib/jquery-ui/jquery-ui.js"></script>
  <!--<script src="./lib/jquery.min.js"></script> -->

</head>

<body>
	
<!-- Top Bar -->
 <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><img src="./media/highbreaklogo.png" class="img-fluid"alt="Highbreak Snooker"></h1>
</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.php">Timer</a>
    <a class="p-2 text-dark" href="record.php">Record</a>
    <a class="p-2 text-dark" href="admin.php">Admin</a>
    <a class="p-2 text-dark" href="report.php">Report</a>

  </nav>

</div>

<!---Main Record Table -->



<div class="container" >
  <div class="card"> 

  <?php
    require_once 'connection.php';
    $sql = "select year(start_time),month(start_time),sum(charge) from table_record group by year(start_time),month(start_time) order by year(start_time),month(start_time)
    ";
    $result = $conn->query($sql);
  
    echo "<table class='table table-hover' id='tableRecord'>
      <thead class='thead-dark'>
        <tr>
          <th scope='col'>Year</th>
          <th scope='col'>Month</th>
          <th scope='col'>Total</th>
        </tr>
      </thead>
      <tbody>";
    if ($result->num_rows > 0) {
      // output data of each row 
      while($row = $result->fetch_assoc()){
        echo "<tr>";
          echo "<th scope='row'>";
            echo $row["year(start_time)"];
          echo "</th>";
          echo "<th scope='row'>";
            echo $row["month(start_time)"];
          echo "</th>";
          echo "<th scope='row'>";
            echo $row["sum(charge)"];
        echo "</tr>";
      } 
    }
   
    echo "</tbody>
          </table>";

    

    $conn->close();
  ?>
  

  </div>

  <div class="card">
    <div class="card-body" id="dailyTotal"> </div>
  </div>

</div>



<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript">
google.charts.load('current', {packages: ['corechart']});     

    function drawChart() {
      $.ajax({
            
            url: 'dailySum.php',
            dataType: 'json',
            cache: false,
            async : false,
            success: function(result) {
              
              console.log(result);
              var data = new google.visualization.DataTable(result);

              
                  data.addColumn('string', 'date');
                  data.addColumn('number', 'total');
                  
                  result.forEach(function (row){
                    data.addRow([
                      row.date,
                      parseFloat(row.total)
                    ])
                    console.log(row.date);
                    console.log(row.total);
                  })
                    
              var options = {
                  title: 'Daily Total',
                  legend: 'none',
                  bar: {groupWidth: '20%'},
                  vAxis: { gridlines: { count: 4 } }
                };
                  
                  
                  var chart = new google.visualization.ColumnChart(document.getElementById('dailyTotal'));
                  chart.draw(data, options);
              }  
                
        
      });
      

  }
  google.charts.setOnLoadCallback(drawChart);
  </script>


</body>
</html>