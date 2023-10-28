$(document).on("click","#addTask",function(){
	$('#messageModal').modal('show');
});

$("#message-form").on('submit', function(e){
    e.preventDefault();
    // if($("#message-form").valid()){

    	var val = $("#message").val();
    	// console.log(val+'sahs');return;
    	if(val == ''){
    		alert('Please enter your message');
    		return;
    	}
        

        var form = $("#message-form");
        var btn = form.find("button").eq(0);
        
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading..');
        btn.attr("disabled","disabled");


    	var data = form.serialize();
    	console.log(data);

    	const url = base_url + '/add-message';

    	$.ajax({
			type:'POST',
			url:url,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data:data,
			success:function(data){
				if(data.success){
	            	$("#message-form")[0].reset();
	            	alert(data.message);


				}else{
	            	alert("Error processing your request. Please try again");

				}
				
			}
      	});
      	btn.removeClass("loading");
	    btn.html('Submit');
	    btn.removeAttr("disabled");
	    location.reload()
        
    return false;
});