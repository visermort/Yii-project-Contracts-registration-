jQuery(document).ready(function(){
    $('.btn-client-choose').click(function(){
    	var that = $(this),
    		id = that.data('id'),
    		fullname = that.data('fullname');
	  	$('#contracts-client_id').val(id);
	 	$('#client_fullname').val(fullname);
	 	$('#clientModal').modal('hide');
    });

    $('.btn-device-choose').click(function(){
    	var that = $(this),
    		id = that.data('id'),
    		fullname = that.data('fullname'),
    		summa = that.data('summa'),
    		percent = that.data('percent');

		if (summa == 0) {
			summa = "";//в таком случае не пройдёт валидация
		}
	    //  	console.log(that,id,fullname);
	  	$('#contracts-device_id').val(id);
	 	$('#device_fullname').val(fullname);
	 	$('#contracts-summa').val(summa);
	 	$('#contracts-percent').val(percent);
	 	$('#diviceModal').modal('hide');
    });


});
