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

<script>

    var todayCharge;
    var today = (new Date()).toISOString().split('T')[0];
    var datePicked;
    $("#datepickerFrom").val(today)
    queryDailyCharge(today);

    
    clock();
    function clock(){ 
      //today = (new Date()).toISOString().split('T')[0];
      // Update the count down every 1 second
      var x = setInterval(function() {
        today = (new Date()).toISOString().split('T')[0];
        if (datePicked == undefined){
          datePicked = today;
        }
        queryDailyCharge(datePicked);
      },2000);
    }  
    

    function queryDailyCharge(datePicked){
      $.ajax({
            url: "getDailyCharge.php",
            type: "GET",
            data: {dateToQuery: datePicked},
            async: true
          }).done(function( data ) {
            //console.log(data);
            if (data > 0) {
            todayCharge = data;
            }
            else {
              todayCharge = 0;
            }
            $("#dailyEarn").text("Total HK$ " + todayCharge);
            //console.log(table_status);
            console.log(datePicked);
            });
    }
</script>

<!---Main Record Table -->



<div class="container" >
  <div class="card-deck mb-3 text-center"> 

<!--
  <form>
    <div class="row">
      <div class="col">
        Date: <input type="text" id="datepickerFrom"> 
      </div>
      <div class="col" style="font-weight: bold;color:blue" id = "dailyEarn" >
        Total:
      </div>
    </div>
  </form>
-->
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
  </div>
  <input type="text" class="form-control" aria-label="Date" aria-describedby="inputGroup-sizing-default" id="datepickerFrom">
  <span class="input-group-text"  style="font-weight: bold;color:blue" id = "dailyEarn">Date</span>
</div>

    <!--
    <div class="float-right">
    To: <input type="text" id="datepickerTo">
    </div>
    -->

    <div class="container" id="dailyTable">


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