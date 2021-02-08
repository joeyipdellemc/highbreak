<!DOCTYPE html>
<meta http-equiv="refresh" content="1800" />
<html>
<head>
	<title> Highbreak Snooker</title>
	<!-- Bootstrap core CSS -->
	<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
  <link href="./lib/bootstrap.min.css" rel="stylesheet">
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

  </nav>


</div>


<!-- Table 1 -3 Layout -->
<div class="container">
  
  <div class="card-deck mb-3 text-center">

 <!-----------Box 1 ----------->
    <div class="card mb-4 shadow-sm">
      <div class="card-header"  id="cardHeaderTable1"><h4 class="my-0 font-weight-normal">Table 1</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><img src="./media/table_h.png"class="img-fluid" id="imageTable1" alt="table"></h1>
        <button type="button" id="btnStartTable1" class="btn btn-lg btn-block btn-outline-primary">Start</button>
        <button type="button" id="btnStopTable1" class="btn btn-lg btn-block btn-outline-primary" disabled = "true">Stop</button> 
      </div>
      <div>
 			  <ul class="text-left list-inline list-group list-group-flush" >
    			<li class="list-group-item" id="timeStartTable1" >Start Time </li>
    			<li class="list-group-item" id="timeStopTable1" >Stop Time </li>
    			<li class="list-group-item" id="timePlayTable1" >Play Time </li>
          <li class="list-group-item" style="font-weight: bold;color:blue;font-size:24px"id="timeChargeTable1" >HKD $</li>
        </ul>
      </div>
      </div>
 <!-----------Box 2 ----------->
    <div class="card mb-4 shadow-sm">
      <div class="card-header"id="cardHeaderTable2">
        <h4 class="my-0 font-weight-normal">Table 2</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><img src="./media/table_h.png" class="img-fluid" id="imageTable2" alt="table"></h1>
        <button type="button" id="btnStartTable2" class="btn btn-lg btn-block btn-outline-primary">Start</button>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="btnStopTable2"disabled="true">Stop</button> 
        </div>
        <div>
 			<ul class="text-left list-inline list-group list-group-flush" >
    			<li class="list-group-item" id="timeStartTable2" >Start Time </li>
    			<li class="list-group-item" id="timeStopTable2" >Stop Time </li>
    			<li class="list-group-item" id="timePlayTable2" >Play Time </li>
    			<li class="list-group-item" style="font-weight: bold;color:blue;font-size:24px" id="timeChargeTable2">HKD $</li>

    		</ul>
      	</div>
     </div>

 <!-----------Box 3 ----------->

    <div class="card mb-4 shadow-sm">
      <div class="card-header" id="cardHeaderTable3">
        <h4 class="my-0 font-weight-normal">Table 3</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><img src="./media/table_h.png" class="img-fluid" id="imageTable3"  alt="table"></h1>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="btnStartTable3">Start</button>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="btnStopTable3" disabled="true">Stop</button>
        </div>
        <div>
 			<ul class="text-left list-inline list-group list-group-flush" >
    			<li class="list-group-item" id="timeStartTable3" >Start Time </li>
    			<li class="list-group-item" id="timeStopTable3" >Stop Time </li>
    			<li class="list-group-item" id="timePlayTable3" >Play Time </li>
    			<li class="list-group-item" style="font-weight: bold;color:blue;font-size:24px" id="timeChargeTable3" >HKD $</li>
    		</ul>
      	</div>
      </div>
 </div>

    <div class="card">
      <div class="card-body">
        <div class="card-header"><h4>Move Table</h4></div>
         <!-- start radio row1 -->
        <div class="row">
          <div class="col-4"></div>
          <div class="col-2"><div><H6>From</H6></div></div>  
            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fromTableRadioOptions" id="fromTable1" value="1" disabled="true">
                <label class="form-check-label" for="inlineRadio1">Table 1</label>
              </div>
            </div>

            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fromTableRadioOptions" id="fromTable2" value="2" disabled="true">
                <label class="form-check-label" for="inlineRadio2">Table 2</label>
              </div>
            </div>

            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fromTableRadioOptions" id="fromTable3" value="3" disabled="true">
                <label class="form-check-label" for="inlineRadio3">Table 3</label>
              </div>
            </div>
          </div>      
        <!-- end radio row1 -->

        <!-- start radio row2 -->
        <div class="row">
          <div class="col-4"></div>
          <div class="col-2"><div><H6>To</H6></div></div>  
            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="toTableRadioOptions" id="toTable1" value="1">
                <label class="form-check-label" for="inlineRadio1">Table 1</label>
              </div>
            </div>

            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="toTableRadioOptions" id="toTable2" value="2">
                <label class="form-check-label" for="inlineRadio2">Table 2</label>
              </div>
            </div>

            <div class="col-sm">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="toTableRadioOptions" id="toTable3" value="3">
                <label class="form-check-label" for="inlineRadio3">Table 3</label>
              </div>
            </div>
          </div>      
        <!-- end radio row2 -->

        <!-- start radio row3 -->
        <div class="row">
          <div class="col-10"></div>
            <div class="col-sm">
              <button type="button" id="btnChangeTable1" class="btn-primary btn-sm" >Change</button>
              </div>
            </div>

          </div>      
        <!-- end radio row3 -->

      </div>
    </div>


      

</div>



<!-----------Footer ----------->
<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted" id="globalTime" > Current Time</span>
  </div>
</footer>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted" id="hourlyRate" >Hourly Rate</span>
  </div>
</footer>

	<script src="./lib/jquery.min.js"></script>
	<script src="./script/script.js"></script> 


</body>
</html>