<!DOCTYPE html>
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
    <a class="p-2 text-dark" href="record.php">Record</a>
    <a class="p-2 text-dark" href="admin.php">Admin</a>
    <!--<a class="p-2 text-dark" href="#">Admin</a> -->
  </nav>

 
</div>

<!-- Main -->

<div class="container">
<main role="main" class="container">

<div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Function</h6>
        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Change Hourly Rate</strong>
            </div>
            <span class="d-block" id = "hourlyRateSpan">Current Houly Rate is HKD$</span>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="New Hourly Rate" aria-label="ew Hourly Rate" aria-describedby="basic-addon2" id = 'valChangeHourlyRate'>
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id = 'btnChangeHourlyRate'>Submit</button>
            </div>
</div>
          </div>
        </div>
</div>
</main>
</div>
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        //Hourly Rate
        var hourlyRate = 120 //Default  
        $("document").ready(function(){
	    // load Database status
	        $.ajax({
		        url: "getHourlyRate.php",
		        type: "GET",
		        async: false
            }).done(function( data ) {
                hourlyRate = data;
                console.log(hourlyRate);
                $("#hourlyRateSpan").text("Current Houly Rate is HKD$" +hourlyRate );
            });

            $("#btnChangeHourlyRate").click(function(){
              var valChangeHourlyRate = $("#valChangeHourlyRate").val();
              console.log(valChangeHourlyRate.lenght);
              if (valChangeHourlyRate){
                var isChange = confirm("Do you really change the hourly rate to HKD$" + valChangeHourlyRate + " ?");
                if (isChange == true) {
                  // AJAX Request
                  $.ajax({
                    url: 'changeHourlyRate.php',
                    type: 'GET',
                    data: {changeRate: valChangeHourlyRate},
                  success: function(response){$("#hourlyRateSpan").text("Current Houly Rate is HKD$" +valChangeHourlyRate );}
                  });
                }
              }
              else{alert("No Value")}
            });

        });    
        
    </script>

</body>


</html>