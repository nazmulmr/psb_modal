<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Modal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 class="text-danger">Bootstrap Modal with update usnig Ajax</h2>
  <table id="result" class="table table-striped"></table>
  <div id="loader-icon"><i class="fa fa-refresh fa-spin" style="font-size:20px"></i></div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit ??? Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal modal-form" role="form"></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div>
</body>
</html>
<script>
function getresult(offset,limit) { 
	$.ajax({
		url: 'ajax_page.php',
		type: "POST",
		data: {action:'show_list',offset:offset,limit:limit},
		beforeSend: function(){
			$('#loader-icon').show();
		},
		complete: function(){
			$('#loader-icon').hide();
		},
		success: function(data){
			$("#result").append(data);
			window.busy = false;
		},
		error: function (jqXHR, textStatus, errorThrown) {
		  if (jqXHR.status == 500) {
			  console.debug("Internal error: " + jqXHR.responseText)
		  } else {
			  console.debug("Unexpected error.")
		  }
		}        
	});
}

function getresult1() {
    $.ajax({
        url: 'ajax_1.php',
        type: "POST",
        data: {action:'show_list'},
        beforeSend: function(){
            $('#loader-icon').show();
        },
        complete: function(){
            $('#loader-icon').hide();
        },
        success: function(data){

            $('.modal-form').append(data);
            window.busy = false;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 500) {
                console.debug("Internal error: " + jqXHR.responseText)
            } else {
                console.debug("Unexpected error.")
            }
        }
    });
}
var busy = false;
var offset = 0;
var limit = 15;
$(window).scroll(function(){
	if($(window).scrollTop()==$(document).height()-$(window).height()){
		busy = true;
		offset = offset + limit;
		getresult(offset, limit)
	}
});
getresult(offset, limit);

$('#myModal').on('shown.bs.modal', function (e) {
  var heading = [];
  var data = [];
  var id = $(e.relatedTarget).data('id');
  heading = $('.text-info').find('th').map(function(){
     return this.innerHTML;
  }).get();
  
  data = $('#row'+id).find('td').map(function(){
     return this.innerHTML;
  }).get();
  
  $('.modal-form').html(null);

    getresult1();




    // $sql = "SELECT * from country";
    // $result = $connection => query($sql);
    //
    // if ($result=> num_rows > 0) {
    //     // output data of each row
    //     while($row = $result => fetch_assoc()) {
    //         $('.modal-form').append('<div class="form-group"><label class="col-sm-6 control-label">EEE</label></div><hr> ');
    //
    //     }
    // }

  // $.each( heading, function( key, value ) {
	//   $('.modal-form').append('<div class="form-group"><label class="col-sm-6 control-label">'+data[key]+'</label></div><hr> ');
  // });
  
  $("#myModal .btn-primary" ).click(function() {
	  $.ajax({
		url: 'ajax_page.php',
		type: "POST",
		data: $(".modal-form").serialize() + "&action=save_modal_data",
		beforeSend: function(){
			$('#loader-icon').show();
		},
		complete: function(){
			$('#loader-icon').hide();
		},
		success: function(data){
			alert(data)
		},
		error: function (jqXHR, textStatus, errorThrown) {
		  if (jqXHR.status == 500) {
			  console.debug("Internal error: " + jqXHR.responseText)
		  } else {
			  console.debug("Unexpected error.")
		  }
		}        
	});
  });
})
</script>
