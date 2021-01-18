$(document).ready(function($) {
  $('#result').load('test.php', function() {
   alert('Load was performed.');
 });
});


/*
  echo "document loaded";
  $("button").click(function(){
		//get the botton ID
		var $id = this.id;
    var isDelete = confirm("Do you really want to delete record?");
      if (isDelete == true) {
        // AJAX Request
        $.ajax({
          url: 'delete_record.php',
          type: 'GET',
          data: {get_id: id},
          success: function(response){
            $.each(id, function( i,l ){
            $("#tr_"+l).remove();
            });
          }
        });
      }; 
  });

  */