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
  <div class="card-deck mb-3 text-center"> 



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
          echo "</th>";
          echo "<td>";
          
      } 
    }
   
  
    echo "</tbody>
          </table>";
    $conn->close();
  ?>
  
  </div>
</div>

</div>

  <script>
    $("button").click(function(){
      console.log(this.id);
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

  function updateTime(k) {
  	if (k < 10) {
  		return "0" + k;
		}
		else {
			return k;
		}
  }
  
  $(function() {
    //$("#datapickerFrom").datepicker("setDate", "10/12/2012");
    //console.log($("#datepickerFrom" ).datepicker("getDate"));
    //$( "#datepickerTo" ).datepicker();
    $("#datepickerFrom" ).val(today);
    $("#datepickerFrom" ).datepicker(
      { 
        dateFormat: "yy-mm-dd",
        onClose: function(){
          var selectedDate = $("#datepickerFrom" ).datepicker("getDate");
          datePicked = (selectedDate.getFullYear() +"-"+ updateTime(selectedDate.getMonth()+1) +"-"+ updateTime(selectedDate.getDate()));
          $("#tableRecord").remove();

          $.ajax({
            url: "dailyRecordTable.php",
            type: "GET",
            data: {dateToQuery: datePicked},
            async: true
          }).done(function(data) { 
            console.log(data);
            $("#dailyTable").append(data);
            
            $("button").click(function(){
            console.log(this.id);
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
            
          })
        }

      
      });
    
  } );
  </script>


</body>
</html>