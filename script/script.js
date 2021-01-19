//Table Start Time
var tableStartTime1 
var tableStartTime2 
var tableStartTime3 

//Table Stop Time
var tableStopTime1
var tableStopTime2
var tableStopTime3

//Table PlayTime 
var tablePlayTime1
var tablePlayTime2
var tablePlayTime3

//Table Status (Started, Stopped, Paused)
var tableStatus1
var tableStatus2
var tableStatus3

//Hourly Rate
var hourlyRate = 120 //Default

// Get Current date and Time
var currentDate = new Date();



//Play Time
function tablePlayTime(tableNum){

	// PlayTime Between Current Time and StartTime
		if (eval("tableStatus"+ tableNum) == "Started"){
		var playTime = new Date().getTime() - eval("tableStartTime"+tableNum+".getTime()");
		//console.log("Time Different:" + playTime)
		// Time calculations for days, hours, minutes and seconds
	  	var days = Math.floor(playTime / (1000 * 60 * 60 * 24));
	  	var hours = Math.floor((playTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  	var minutes = Math.floor((playTime % (1000 * 60 * 60)) / (1000 * 60));
	 	var seconds = Math.floor((playTime % (1000 * 60)) / 1000);
	 	return (hours + ":" + minutes + ":" + seconds)
	 }
	 return ("00:00:00");
}

function tablePlayMoney(tableNum){

	// PlayTime Between Current Time and StartTime
		if (eval("tableStatus"+ tableNum) == "Started"){
		var playTime = new Date().getTime() - eval("tableStartTime"+tableNum+".getTime()");
		// Time calculations for days, hours, minutes and seconds
	  	var days = Math.floor(playTime / (1000 * 60 * 60 * 24));
	  	var hours = Math.floor((playTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  	var minutes = Math.floor((playTime % (1000 * 60 * 60)) / (1000 * 60));
	 	var seconds = Math.floor((playTime % (1000 * 60)) / 1000);
	 	var dollar = (hours * hourlyRate ) + (minutes * hourlyRate/60) +(seconds * hourlyRate/3600);
	 	//console.log ( "Dollar is " + dollar);
	 	return (dollar.toFixed(1));
	 }
	 return (0);
}



//Display Current Time
clock();
function clock(){ 
// Update the count down every 1 second
var x = setInterval(function() {

  currentDate = new Date();
    
  // Time calculations for days, hours, minutes and seconds
  var days = currentDate.getDate();
  var hours = currentDate.getHours();
  var minutes = currentDate.getMinutes();
  var seconds = currentDate.getSeconds();
  hours = updateTime(hours);
  minutes = updateTime(minutes);
  seconds = updateTime(seconds);
  
  //Convert to two digits format
  function updateTime(k) {
  	if (k < 10) {
  		return "0" + k;
		}
		else {
			return k;
		}
	}

	// Display Current to Footer
	currentTime = hours + ":"+ minutes + ":" + seconds;
	$("#globalTime").text("Current Time: " + currentTime);
	$("#hourlyRate").text("Hourly Rate: HKD $"+ hourlyRate);
	//Display Play Time
	for (i=1;i<=3;i++){
		if (eval("tableStatus"+ i) == "Started"){
			//console.log("Table "+i+" Start Time is " + eval("tableStartTime" + i))
			//console.log("Table "+i+" Charge is " + tablePlayMoney(i));
			$("#timePlayTable" + i).text("Play Time: " + tablePlayTime(i));
			$("#timeChargeTable" + i).text("Charge HKD $" + tablePlayMoney (i));
		}
	}

	
	}, 1000);
}

function displayTableTime(tableNumber, tableTime){
  // Time calculations for days, hours, minutes and seconds
  var hours = tableTime.getHours();
  var minutes = tableTime.getMinutes();
  var seconds = tableTime.getSeconds();
  hours = updateTime(hours);
  minutes = updateTime(minutes);
  seconds = updateTime(seconds);
  
  function updateTime(k) {
  	if (k < 10) {
  		return "0" + k;
		}
		else {
			return k;
		}
	}

	// Output the result in an element 
	currentTableTime = hours + ":"+ minutes + ":" + seconds;
	//eval ("tableStartTime"+tableNumber+"="+startTime);

	if (eval("tableStatus"+ tableNumber) == "Started"){
		$("#timeStartTable" + tableNumber).text("Start Time: " + currentTableTime);
		//$("#timePlayTable" + tableNumber).text("Play Time: " + currentTableTime);

	}
	
	if (eval("tableStatus"+ tableNumber) == "Stopped"){

		$("#timeStopTable" + tableNumber).text("Stop Time: " + currentTableTime);
	}

}

function displayStartTableUI(tableNumber){
	// Update Button Status
	$("#btnStartTable" + tableNumber).text("Starting");
	$("#btnStartTable" + tableNumber).prop("disabled", true);
	$("#btnStopTable" + tableNumber).prop("disabled", false);
	$("#btnChangeTable" + tableNumber).prop("disabled", false);
	

	//$("#timeCurrentTable" + tableNumber).text(tableAction);
	
	// Dim the Table
	$("#imageTable" + tableNumber).fadeTo(500,0.5);
				
	//Clean Up Stop Time
	$("#timeStopTable" + tableNumber).text("Stop Time")
	
	//Set Table Status to "Started"
	eval("tableStatus"+tableNumber+ " = 'Started'");
	
	//Display Table Start Time
	eval("tableStartTime" + tableNumber + "= new Date(table_status);");
	
	displayTableTime(tableNumber,eval("tableStartTime"+tableNumber));

	//DisplayTableTime(tableNumber,tableStartTime1);
	//DisplayTableTime(1,Date(table_status));
	//$("#timeStartTable" + tableNumber).text("Start Time: " + table_status.slice(-8));

}

table_status = "stopped";

//Page Loaded
$("document").ready(function(){

	// load Database status
	$.ajax({
		url: "getHourlyRate.php",
		type: "GET",
		async: false
	}).done(function( data ) {
		hourlyRate = data;
		//console.log(table_status);

	});

	for (i=1;i<=3;i++){
		tableNumber = i;
		$.ajax({
			url: "getTable.php",
			type: "GET",
			data: {table_num: tableNumber},
			async: false
		}).done(function( data ) {
			table_status = data;
			//console.log(table_status);

		});
		
		//console.log("table_status=",table_status);

		// Update Table form DB
		if (table_status != "stopped" ){
			// Update Button Status
			$("#btnStartTable" + tableNumber).text("Starting");
			$("#btnStartTable" + tableNumber).prop("disabled", true);
			$("#btnStopTable" + tableNumber).prop("disabled", false);
			//$("#timeCurrentTable" + tableNumber).text(tableAction);
			
			// Dim the Table
			$("#imageTable" + tableNumber).fadeTo(500,0.5);
						
			//Clean Up Stop Time
			$("#timeStopTable" + tableNumber).text("Stop Time")
			
			//Set Table Status to "Started"
			eval("tableStatus"+tableNumber+ " = 'Started'");
			
			//Display Table Start Time
			eval("tableStartTime" + tableNumber + "= new Date(table_status);");
			
			displayTableTime(tableNumber,eval("tableStartTime"+tableNumber));

			//Enable MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("disabled", false)

			//Disable MoveTo Radio Button
			$("#toTable" + tableNumber).prop("disabled", true)

			//Clear MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("checked", false)
			$("#toTable" + tableNumber).prop("checked", false)

		}

		}


	// Listening Botton Action
	$("button").click(function(){

		//get the botton ID (btnStartTable(n),btnStopTable(n)..)
		var buttonID = this.id;
		//get the table number
		var tableNumber = buttonID.charAt(buttonID.length-1)
		//get the action of the botton
		var tableAction = buttonID.substring(3,buttonID.length-1)
		//Set the table start time

		// Start Table
		if (tableAction == "StartTable"){
			// Disable Table Start Button
			//console.log($("#btnStartTable"+ tableNumber).text());
			
			//check the button if it is pause, pause will no set new date otherwise, set startTime
			if ($("#btnStartTable"+ tableNumber).text()!="Resume"){
				//console.log("set start Date");
				eval("tableStartTime" + tableNumber + "= new Date();");
			}
			// Update Button Status
			$("#btnStartTable" + tableNumber).text("Starting");
			$("#btnStartTable" + tableNumber).attr("disabled", true);
			$("#btnStopTable" + tableNumber).attr("disabled", false);
			//$("#timeCurrentTable" + tableNumber).text(tableAction);

			// Dim the Table
			$("#imageTable" + tableNumber).fadeTo(500,0.5);
			
			//Clean Up Stop Time
			$("#timeStopTable" + tableNumber).text("Stop Time")

			//Set Table Status to "Started"
			eval("tableStatus"+tableNumber+ " = 'Started'");


			//Display Table Start Time

			displayTableTime(tableNumber,eval("tableStartTime"+tableNumber));

			//Enable MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("disabled", false)

			//Disable MoveTo Radio Button
			$("#toTable" + tableNumber).prop("disabled", true)

			//Clear MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("checked", false)
			$("#toTable" + tableNumber).prop("checked", false)

			

			$.ajax({
				url: "startTable.php",
				type: "GET",
				data: {table_num: tableNumber},
				async: false
				}).done(function( data ) {
					table_status = data;
					//console.log(table_status);
				
				});
		}
			
		// Stop Table
		if (tableAction == "StopTable"){

			// Enable Table Start Button
			$("#btnStartTable" + tableNumber).text("Start");
			$("#btnStartTable" + tableNumber).attr("disabled", false);
			//$("#timeCurrentTable" + tableNumber).text(tableAction);
			//Disabe Stop & Pause Button
			$("#btnStopTable" + tableNumber).attr("disabled", true);
			// Set the Stop table Time
			eval("tableStopTime" + tableNumber + "= new Date();");

			// Un-Dim the Table
			$("#imageTable" + tableNumber).fadeTo(500,1);
			
			//update Database
			//console.log("charge=",tablePlayMoney(tableNumber));
			$.ajax({
				url: "stopTable.php",
				type: "GET",
				data: {table_num: tableNumber,charge: tablePlayMoney(tableNumber)},
				async: false
			}).done(function( data ) {
				table_status = data;
				//console.log(table_status);
	
			});
			
			//Set Table Status to "Stopped"
			eval("tableStatus"+tableNumber+ " = 'Stopped'");

			//Display Table Stop Time
			displayTableTime(tableNumber,eval("tableStopTime"+tableNumber));

			//Enable MoveTo Radio Button
			$("#toTable" + tableNumber).prop("disabled", false)

			//Disable MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("disabled", true)
			
			//Clear MoveFrom Radio Button
			$("#fromTable" + tableNumber).prop("checked", false)
			$("#toTable" + tableNumber).prop("checked", false)
		}
	
		// Change Table
		if (tableAction == "ChangeTable"){
			var tableMoveFrom 
			var tableMoveFromID
			var tableMoveTo
			for (i=1;i<=3;i++){
				tableNumber = i;
				if($("#fromTable"+tableNumber).prop("checked")){
					console.log("Move From Table "+tableNumber);
					tableMoveFrom = tableNumber;
				}
				if($("#toTable"+tableNumber).prop("checked")){
					console.log("Move to Table "+tableNumber);
					tableMoveTo= tableNumber;
				}
			}
			if (!tableMoveFrom){
				alert("Please select which table move from")
			}
			if (!tableMoveTo){
				alert("Please select which table move To")
			}

			if (tableMoveFrom && tableMoveTo){
				alert("moved from table "+tableMoveFrom+" to " + tableMoveTo);
				
				//get tableMoveFromID
				$.ajax({
					url: "getTableMoveFromID.php",
					type: "GET",
					data: {tableMoveFrom: tableMoveFrom},
					async: false
				}).done(function( data ) {
					tableMoveFromID = data;
				});
							

				//Stop Move From Table
				//Enable Table Start Button
				$("#btnStartTable" + tableMoveFrom).text("Start");
				$("#btnStartTable" + tableMoveFrom).attr("disabled", false);
				//$("#timeCurrentTable" + tableNumber).text(tableAction);
				//Disabe Stop & Pause Button
				$("#btnStopTable" + tableMoveFrom).attr("disabled", true);
				// Set the Stop table Time
				//eval("tableStopTime" + tableMoveFrom + "= new Date();");

				// Un-Dim the Table
				$("#imageTable" + tableMoveFrom).fadeTo(500,1);
				
				//update Database
				//console.log("charge=",tablePlayMoney(tableNumber));
				console.log("tableMoveFromID: "+ tableMoveFromID);
				$.ajax({
					url: "moveTable.php",
					type: "GET",
					data: {tableMoveTo: tableMoveTo,tableMoveFromID: tableMoveFromID},
					async: false
				}).done(function( data ) {
					table_status = data;
					//console.log(table_status);
					//Set Table Status to "Stopped"
					eval("tableStatus"+tableMoveFrom+ " = 'Stopped'");

					//Enable MoveTo Radio Button
					$("#toTable" + tableMoveFrom).prop("disabled", false)

					//Disable MoveFrom Radio Button
					$("#fromTable" + tableMoveFrom).prop("disabled", true)
					
					//Clear MoveFrom Radio Button
					$("#fromTable" + tableMoveFrom).prop("checked", false)
					$("#toTable" + tableMoveFrom).prop("checked", false)

					//Clean Up Start Time
					$("#timeStartTable" + tableMoveFrom).text("Start Time")

					//Clean Up Stop Time
					$("#timeStopTable" + tableMoveFrom).text("Stop Time")

					//Clean Up Play Time
					$("#timePlayTable" + tableMoveFrom).text("Play Time");

					//Clean Up Charge
					$("#timeChargeTable" + tableMoveFrom).text("Charge HKD");



					//Start Move To Table
					//check the button if it is pause, pause will no set new date otherwise, set startTime
					if ($("#btnStartTable"+ tableMoveTo).text()!="Resume"){
						//console.log("set start Date");
						eval("tableStartTime" + tableMoveTo + "= tableStartTime"+tableMoveFrom);
					}
					// Update Button Status
					$("#btnStartTable" + tableMoveTo).text("Starting");
					$("#btnStartTable" + tableMoveTo).attr("disabled", true);
					$("#btnStopTable" + tableMoveTo).attr("disabled", false);
					//$("#timeCurrentTable" + tableNumber).text(tableAction);

					// Dim the Table
					$("#imageTable" + tableMoveTo).fadeTo(500,0.5);
					
					//Clean Up Stop Time
					$("#timeStopTable" + tableMoveTo).text("Stop Time")

					//Set Table Status to "Started"
					eval("tableStatus"+tableMoveTo+ " = 'Started'");


					//Display Table Start Time

					displayTableTime(tableMoveTo,eval("tableStartTime"+tableMoveTo));

					//Enable MoveFrom Radio Button
					$("#fromTable" + tableMoveTo).prop("disabled", false)

					//Disable MoveTo Radio Button
					$("#toTable" + tableMoveTo).prop("disabled", true)

					//Clear MoveFrom Radio Button
					$("#fromTable" + tableMoveTo).prop("checked", false)
					$("#toTable" + tableMoveTo).prop("checked", false)
		
				});
				
				

				
			}

		}



	})

});


