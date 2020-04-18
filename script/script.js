

// Listening Botton Action
$("document").ready(function(){
	$("button").click(function(){
		//get the botton ID (btnStartTable(n),btnStopTable(n)..)
		var buttonID = this.id;
		//get the table number
		var tableNumber = buttonID.charAt(buttonID.length-1)
		//get the action of the botton
		var tableAction = buttonID.substring(3,buttonID.length-1)
		// Start Table
		if (tableAction == "StartTable"){
			// Disable Table Start Button
			$("#btnStartTable" + tableNumber).text("Starting");
			$("#btnStartTable" + tableNumber).attr("disabled", true);
			$("#timeCurrentTable" + tableNumber).text(tableAction);
			$("#imageTable" + tableNumber).fadeTo(500,0.5);

		}
		// Stop Table
		if (tableAction == "StopTable"){
			// Disable Table Start Button
			$("#btnStartTable" + tableNumber).text("Start");
			$("#btnStartTable" + tableNumber).attr("disabled", false);
			$("#timeCurrentTable" + tableNumber).text(tableAction);
			$("#imageTable" + tableNumber).fadeTo(500,1);
		}
		// Pause Table
		if (tableAction == "PauseTable"){
			// Disable Table Start Button
			$("#btnStartTable" + tableNumber).text("Resume");
			$("#btnStartTable" + tableNumber).attr("disabled", false);
			$("#timeCurrentTable" + tableNumber).text(tableAction);
		}

		//alert(this.id);


	})

});

// Dim the Table image

