$(document).ready(function(){
	var totalprice = 0;
	var qty_array = [];
	var brand = [112,113];
	var total = 6;
	var min = 0;
	//add to cart
	var flag = 0;
	// $(".cart-item-qty-input").change(function(e){
	// 	var value = jQuery(this).val();
	// 	alert(value);
	// })
	$(".quickview").hide();
	$("#form-action-addToCart").click(function(e){
		if(flag == '0'){
			e.preventDefault();
			var prd_array = [];
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
				console.log(brandObj[$brd_name]);
				if ((settingObj[$brd_name] != undefined) && (settingObj[$brd_name] != null) && settingObj.length !== 0  ){
					// if(settingObj[$brd_name].length !== 0){
						console.log(settingObj[$brd_name]['1']);
						total = settingObj[$brd_name]['2'];
						min = settingObj[$brd_name]['1'];
					// }else{
					// 	flag = 1;
			    	// 	$("#form-action-addToCart").trigger("click");
					// }
					
				 }else{
				 	flag = 1;
		    		console.log("failed");
		    		$("#form-action-addToCart").trigger("click");
				 }
				var totalqty = 0;
				// console.log(prd_array);
				$.each(prd_array, function (product_id,prd_qty) {
			    	if(jQuery.inArray(product_id, brandObj[$brd_name]) !== -1){
			    		
			    		totalqty = totalqty + parseInt(prd_qty);
			    		//alert(product_id+'--'+prd_qty);
			    	}else{
			    		//console.log(product_id+'helo');
			    	}

				});
				//alert(totalqty);
				if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1 && (prd_qty != undefined)){
					console.log("inarray");
					totalqty = parseInt(totalqty) + parseInt(qty);
				}
				// console.log(getValue.trim());
				console.log(totalqty);
				if(totalqty>total && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
		    		alert("you can not add more then "+total+" product from this brand");
		    		return false;
		    	}else if(totalqty<min && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
		    		alert("you have to add more then "+min+" product from this brand");
		    		return false;
		    	}else{
		    		flag = 1;
		    		console.log();
		    		$("#form-action-addToCart").trigger("click");
		    		//alert(totalqty+'--'+total);
		    	}
				    
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
			    	if(jQuery.inArray(product_id, brandObj[$brd_name]) !== -1 && (prd_qty != undefined)){
			    		
			    		totalqty = parseInt(totalqty) + parseInt(prd_qty);
						//console.log(brandObj[$brd_name]);
			    		console.log(product_id+'--'+prd_qty);
			    	}else{
			    		//console.log(product_id+'helo');
			    	}

				});
				//console.log(totalqty);
				if(jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) != -1){
					console.log("inarray");
					totalqty = parseInt(totalqty) + parseInt(qty);
				}
				// console.log(getValue.trim());
				console.log("totalqty:"+totalqty+" min: "+min+" total: "+total);//return false;
				if(totalqty>total && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
		    		alert("you can not add more then "+total+" product from this brand");
		    		return false;
		    	}else if(totalqty<min && jQuery.inArray(parseInt(getValue), brandObj[$brd_name]) !== -1){
		    		alert("you have to add more then "+min+" product from this brand");
		    		return false;
		    	}else{
		    		flag = 1;
		    		console.log(mythis);
		    		//return true;
		    		mythis['0'].click();
		    		//alert(totalqty+'--'+total);
		    	}
				    
			  })
			});
			console.log(prd_array);
		}else{
			flag = 0;
		}
	})
	
});