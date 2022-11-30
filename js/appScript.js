$(document).ready(function(){
	var totalprice = 0;
	var qty_array = [];
	var brand = [112,113];
	var total = 6;
	var min = 0;
	//add to cart
	var flag = 0;
	$(".quickview").hide();
	$("#form-action-addToCart").click(function(e){
		if(flag == '0'){
			e.preventDefault();
			var prd_array = [];
			var prd_amount = [];
		 	fetch('/api/storefront/carts?include=',
			{
			  'credentials':'include',
			  'headers':{
			    'Accept':'application/json', 
			    'Content-Type': 'application/json'
			  }
			}).then(function(response){ 
			  response.json().then(function(data) {
			  	if ((data[0] != undefined) && (data[0] != null)){
				    $.each(data[0].lineItems.physicalItems, function (i,items) {
				    	prd_array[items.productId] = parseInt(items.quantity);
						prd_amount[items.productId] = parseFloat(items.salePrice) * parseInt(items.quantity);
					});
				}
				var getValue= $("input[name=product_id]").val().trim();
				var qty = $("input.form-input--incrementTotal").val();
				var $brd_name = '';
				$.each(brandObj, function (j,prd) {
			    	if(jQuery.inArray(parseInt(getValue), prd) !== -1){
			    		$brd_name = j;
			    	}
				});
				if ((settingObj[$brd_name] != undefined) && (settingObj[$brd_name] != null) && settingObj.length !== 0  ){
						//console.log(settingObj[$brd_name]['1']);
						total = settingObj[$brd_name]['2'];
						min = settingObj[$brd_name]['1'];
						min_amount = settingObj[$brd_name]['3'];
						max_amount = settingObj[$brd_name]['4'];
				 }else{
				 	flag = 1;
		    		console.log("failed");
		    		$("#form-action-addToCart").trigger("click");
				 }
				var totalqty = 0;
				var totalAmount = 0;
				// console.log(prd_array);
				$.each(prd_array, function (product_id,prd_qty) {
			    	if(jQuery.inArray(product_id, brandObj[$brd_name]) !== -1 && (typeof prd_qty != 'undefined')){
			    		totalqty = totalqty + parseInt(prd_qty);
			    	}
				});
				  
				  $.each(prd_amount, function (product_id1,amount) {
			    	if(jQuery.inArray(product_id1, brandObj[$brd_name]) !== -1 && (typeof amount != 'undefined')){
			    		totalAmount = parseFloat(totalAmount) + parseFloat(amount);
			    	}
				});
				  
				if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1){
					console.log("inarray");
					totalqty = parseInt(totalqty) + parseInt(qty);
				}
				loadDoc1('product',parseInt(getValue)).then(function(data){
					if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1){
						var cal_price = data['data']['calculated_price'];
						cal_price = parseFloat(cal_price) * parseInt(qty);
						//console.log(data['data']['calculated_price']);
						totalAmount = parseFloat(totalAmount) + parseFloat(cal_price);
					} 
					totalAmount = totalAmount.toFixed(2)
					console.log("tamount: "+totalAmount);
					//return false;
					if((totalqty>total || parseFloat(totalAmount)>parseFloat(max_amount)) && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
						alert("you can not add more then "+total+" product OR more then "+max_amount+" amount from this brand");
						return false;
					}else if((totalqty<min || parseFloat(totalAmount)<parseFloat(min)) && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
						alert("you have to add minimum "+min+" product OR minimum "+min_amount+" amount from this brand");
						return false;
					}else{
						flag = 1;
						console.log();
						$("#form-action-addToCart").trigger("click");
						//alert(totalqty+'--'+total);
					}
				});
				
				
				    
			  })
			});
			console.log(prd_array);
		}else{
			flag = 0;
		}
		
        
	})
	//console.log(qty_array);
	$("a.button.button--small.card-figcaption-button").click(function(e){
		if(flag == '0'){
			e.preventDefault();
			var mythis = $(this);
			var getValue = mythis.parent().find('button').attr("data-product-id").trim();
			console.log(getValue);
			var prd_array = [];
			var prd_amount = [];
		 	fetch('/api/storefront/carts?include=',
			{
			  'credentials':'include',
			  'headers':{
			    'Accept':'application/json', 
			    'Content-Type': 'application/json'
			  }
			}).then(function(response){ 
			  response.json().then(function(data) {

			    if ((data[0] != undefined) && (data[0] != null)){
				    $.each(data[0].lineItems.physicalItems, function (i,items) {
				    	prd_array[items.productId] = parseInt(items.quantity);
						prd_amount[items.productId] = parseFloat(items.salePrice) * parseInt(items.quantity);
					});
				}
				//var getValue= $("input[name=product_id]").val().trim();
				var qty = 1;
				//alert(getValue + qty);
				var $brd_name = '';
				$.each(brandObj, function (j,prd) {
			    	if(jQuery.inArray(parseInt(getValue), prd) !== -1){
			    		$brd_name = j;
			    	}
				});
				console.log($brd_name);
				console.log(brandObj[$brd_name]);
				if ((settingObj[$brd_name] != undefined) && (settingObj[$brd_name] != null) && settingObj[$brd_name].length !== 0  ){
						console.log(settingObj[$brd_name]['1']);
						total = settingObj[$brd_name]['2'];
						min = settingObj[$brd_name]['1'];
						min_amount = settingObj[$brd_name]['3'];
						max_amount = settingObj[$brd_name]['4'];
				 }else{
				 	flag = 1;
		    		console.log(mythis);
		    		//return true;
		    		mythis['0'].click();
				 }
				var totalqty = 0;
				//console.log(prd_array);
				$.each(prd_array, function (product_id,prd_qty) {
					//console.log(brandObj[$brd_name]);
			    	if(jQuery.inArray(product_id, brandObj[$brd_name]) !== -1 && (typeof prd_qty != 'undefined')){
			    		totalqty = parseInt(totalqty) + parseInt(prd_qty);
			    	}
				});
				$.each(prd_amount, function (product_id1,amount) {
			    	if(jQuery.inArray(product_id1, brandObj[$brd_name]) !== -1 && (typeof amount != 'undefined')){
			    		totalAmount = parseFloat(totalAmount) + parseFloat(amount);
			    	}
				});
				//console.log(totalqty);
				if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1){
					console.log("inarray");
					totalqty = parseInt(totalqty) + parseInt(qty);
				}
				// console.log(getValue.trim());
				//console.log("totalqty:"+totalqty+" min: "+min+" total: "+total);//return false;
				loadDoc1('product',parseInt(getValue)).then(function(data){
					if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1){
						var cal_price = data['data']['calculated_price'];
						cal_price = parseFloat(cal_price) * parseInt(qty);
						  //console.log(data['data']['calculated_price']);
						totalAmount = parseFloat(totalAmount) + parseFloat(cal_price);
					  }
					//totalAmount = totalAmount.toFixed(2)
					console.log("tamount: "+totalAmount);
					if((totalqty>total || parseFloat(totalAmount)>parseFloat(max_amount)) && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
						alert("you can not add more then "+total+" product OR more then "+max_amount+" amount from this brand");
						return false;
					}else if((totalqty<min || parseFloat(totalAmount)<parseFloat(min)) && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
						alert("you have to add minimum "+min+" product OR minimum "+min_amount+" amount from this brand");
						return false;
					}else{
						flag = 1;
						console.log(mythis);
						//return true;
						mythis['0'].click();
						//alert(totalqty+'--'+total);
					}
				});
					  
				
				    
			  })
			});
			console.log(prd_array);
		}else{
			flag = 0;
		}
	})
	
});
function loadDoc1(type, id){
  return $.ajax('https://danielnunney.com/bigapp2/ajax.php?type='+type+'&id='+id, 
	{
		dataType: 'jsonp', // type of response data
		//timeout: 5000,     // timeout milliseconds
		success: function (data,status,xhr) {   // success callback function
			//console.log(data['data']);
			//console.log(data['data']['calculated_price']);
			data['data'];
		},
		error: function (jqXhr, textStatus, errorMessage) { // error callback 
			console.log(errorMessage);
			"error:"+errorMessage;
		}
	});
};

