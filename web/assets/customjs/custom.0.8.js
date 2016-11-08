jQuery(document).ready(function(){


	$('#devices-search').change(function(){
		//при изменении переносим значение в инпут и присваиваем или снимаем readonly
		var val = $(this).val();
		$('#contracts-model').val(val);
		$('#contracts-model').prop('readonly', val);
	});

	function getTaxes(){
		var select =$('#devices-search'),
			//тариФ по умолчанию - если в селект ничего не выбрано
		    data = $(select).find('option').first().data('tax');
		    selected = select.find('option:selected');
		if (selected) {
			//если выбрано, то тарифы другие
			data = selected.data('tax');
		}
		return data;
	}

	//при изменении цены вырабатываем сумму и текст процента
	//такса берётся из дата-атрибутов из опшинс
	$('#contracts-price').change(function(){

		var price = parseInt($(this).val()),
		    summ = '',
		    percent = '',
		    tax = getTaxes();
		
		$.each(tax, function(key, value){
			
			if (price > key) {
				summ = price * value.val;
				summ = summ ? Math.floor(summ) : '';
				percent = value.text;
				
			}
		})
		$('#contracts-sum').val(summ);
		$('#contracts-percent').val(percent);

	})


 

	//запрет ввода русских символов
    $('input.latin').on('input keydown paste',function () {
      
      var reg = /[а-яА-ЯёЁ]/g;

      if (this.value.search(reg) !=  -1) {
          this.value  =  this.value.replace(reg, '');
      }
    });

    //запрет воода букв
    $('input.digital').on('input keydown paste',function () {
      
      var reg = /[а-яА-ЯёЁa-zA-Z]/g;
      if (this.value.search(reg) !=  -1) {
          this.value  =  this.value.replace(reg, '');
      }
    });



});
