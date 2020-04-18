

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
var hourlyRate = 120

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

	//Display Play Time
	for (i=1;i<=3;i++){
		if (eval("tableStatus"+ i) == "Started"){
			console.log("Table "+i+" Start Time is " + eval("tableStartTime" + i))
			console.log("Table "+i+" Charge is " + tablePlayMoney(i));
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


// Listening Botton Action
$("document").ready(function(){

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
			console.log($("#btnStartTable"+ tableNumber).text());
			
			//check the button if it is pause, pause will no set new date otherwise, set startTime
			if ($("#btnStartTable"+ tableNumber).text()!="Resume"){
				console.log("set start Date");
				eval("tableStartTime" + tableNumber + "= new Date();");
			}
			// Update Button Status
			$("#btnStartTable" + tableNumber).text("Starting");
			$("#btnStartTable" + tableNumber).attr("disabled", true);
			$("#btnStopTable" + tableNumber).attr("disabled", false);
			$("#btnPauseTable" + tableNumber).attr("disabled", false);
			//$("#timeCurrentTable" + tableNumber).text(tableAction);

			// Dim the Table
			$("#imageTable" + tableNumber).fadeTo(500,0.5);
			
			//Clean Up Stop Time
			$("#timeStopTable" + tableNumber).text("Stop Time")

			//Set Table Status to "Started"
			eval("tableStatus"+tableNumber+ " = 'Started'");

			//Display Table Start Time

			displayTableTime(tableNumber,eval("tableStartTime"+tableNumber));
			
		}
			
		// Stop Table
		if (tableAction == "StopTable"){

			// Enable Table Start Button
			$("#btnStartTable" + tableNumber).text("Start");
			$("#btnStartTable" + tableNumber).attr("disabled", false);
			//$("#timeCurrentTable" + tableNumber).text(tableAction);
			//Disabe Stop & Pause Button
			$("#btnStopTable" + tableNumber).attr("disabled", true);
			$("#btnPauseTable" + tableNumber).attr("disabled", true);

			// Set the Stop table Time
			eval("tableStopTime" + tableNumber + "= new Date();");

			// Un-Dim the Table
			$("#imageTable" + tableNumber).fadeTo(500,1);

			//Set Table Status to "Started"
			eval("tableStatus"+tableNumber+ " = 'Stopped'");

			//Display Table Start Time
			displayTableTime(tableNumber,eval("tableStopTime"+tableNumber));
		}
		// Pause Table
		if (tableAction == "PauseTable"){
			// Disable Table Start Button
			$("#btnStartTable" + tableNumber).text("Resume");
			$("#btnStartTable" + tableNumber).attr("disabled", false);
			eval("tableStatus"+tableNumber+ " = 'Paused' ");
			//$("#timeCurrentTable" + tableNumber).text(tableAction);
			//displayTableTime(tableNumber, eval("tableStartTime"+tableNumber));
		}
		
		
	})

});


