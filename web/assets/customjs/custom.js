jQuery(document).ready(function(){

  	$('#contracts-price').change(function(){
  		var price = parseInt($(this).val()),
  		    summ = '',
  		    percent = '';
  		
  		if (price<=2000) {
  			 summ = '';
  			 percent = '';
  		} else if (price<=7000) {
  			 summ = Math.round(price * .14);
  			 percent ="14 (paisprezece)";
  		} else if (price<=15000) {
  			 summ = Math.round(price * .12);
  			 percent ="12 (douăsprezece)";
  		} else {
  			 summ = Math.round(price * .10);
  			 percent ="10 (zece)";
  		}
  		$('#contracts-sum').val(summ);
  		$('#contracts-percent').val(percent);

  	});


});
