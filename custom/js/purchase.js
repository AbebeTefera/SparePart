var managePurchaseTable;
var dis;
$(document).ready(function() {

	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navPurchase").addClass('active');

	if(divRequest == 'add')  {
		// add purchase	
		// top nav child bar 
		$('#topNavAddPurchase').addClass('active');	

		// purchase date picker
		$("#purchaseDate").datepicker();

		// create purchase form function
		$("#createPurchaseForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var purchaseDate = $("#purchaseDate").val();
			var vendorName = $("#vendorName").val();
			var paid = $("#paid").val();
			var paymentType = $("#paymentType").val();
			var paymentStatus = $("#paymentStatus").val();		

			// form validation 
			if(purchaseDate == "") {
				$("#purchaseDate").after('<p class="text-danger"> The Purchase Date field is required </p>');
				$('#purchaseDate').closest('.form-group').addClass('has-error');
			} else {
				$('#purchaseDate').closest('.form-group').addClass('has-success');
			} // /else

			if(vendorName == "") {
				$("#vendorName").after('<p class="text-danger"> The Vendor Name field is required </p>');
				$('#vendorName').closest('.form-group').addClass('has-error');
			} else {
				$('#vendorName').closest('.form-group').addClass('has-success');
			} // /else
			if(paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if(paymentType == "") {
				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			} // /else

			if(paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var partNo = document.getElementsByName('partNo[]');				
			var validateProduct;
			for (var x = 0; x < partNo.length; x++) {       			
				var partNoId = partNo[x].id;	    	
		    if(partNo[x].value == ''){	    		    	
		    	$("#"+partNoId+"").after('<p class="text-danger"> Part No Field is required!! </p>');
		    	$("#"+partNoId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+partNoId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < partNo.length; x++) {       						
		    if(partNo[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for  
		var PR_id = document.getElementsByName('PR_id[]');				
			var validatePR;
			for (var x = 0; x < PR_id.length; x++) {       			
				var PRNoId = PR_id[x].id;	    	
		    if(PR_id[x].value == ''){	    		    	
		    	$("#"+PRNoId+"").after('<p class="text-danger"> PR ID Field is required!! </p>');
		    	$("#"+PRNoId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+PRNoId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for	
		for (var x = 0; x < PR_id.length; x++) {       						
		    if(PR_id[x].value){	    		    		    	
		    	validatePR = true;
	      } else {      	
		    	validatePR = false;
	      }          
	   	} // for		
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for    
		
	   	var rate = document.getElementsByName('rate[]');		   	
	   	var validateRate;
	   	for (var x = 0; x < rate.length; x++) {       
	 			var rateId = rate[x].id;
		    if(rate[x].value == ''){	    	
		    	$("#"+rateId+"").after('<p class="text-danger"> Rate Field is required!! </p>');
		    	$("#"+rateId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+rateId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < rate.length; x++) {       						
		    if(rate[x].value){	    		    		    	
		    	validateRate = true;
	      } else {      	
		    	validateRate = false;
	      }          
	   	} // for

			if(purchaseDate && vendorName && paid && paymentType && paymentStatus) {
				if(validateProduct == true && validateQuantity == true && validatePR ==true && validateRate == true) {
					// create purchase button
					// $("#createPurchaseBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createPurchaseBtn").button('reset');
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create purchase button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a href="purchase.php?o=add" class="btn btn-default" style="margin-left:5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add New Purchase </a>'+
	            	'</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create purchase form function	
	
	} else if(divRequest == 'manpur') {
		// top nav child bar 
		$('#topNavManagePurchase').addClass('active');

		managePurchaseTable = $("#managePurchaseTable").DataTable({
			'ajax': 'php_action/fetchPurchase.php',
			'purchase': []
		});		
					
	} else if(divRequest == 'editPur') {
		$("#purchaseDate").datepicker();
		
			$("#editPurchaseForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var purchaseDate = $("#purchaseDate").val();
			var vendorName = $("#vendorName").val();
			var paid = $("#paid").val();
			var paymentType = $("#paymentType").val();
			var paymentStatus = $("#paymentStatus").val();		

			// form validation 
			if(purchaseDate == "") {
				$("#purchaseDate").after('<p class="text-danger"> The Purchase Date field is required </p>');
				$('#purchaseDate').closest('.form-group').addClass('has-error');
			} else {
				$('#purchaseDate').closest('.form-group').addClass('has-success');
			} // /else

			if(vendorName == "") {
				$("#vendorName").after('<p class="text-danger"> The Vendor Name field is required </p>');
				$('#vendorName').closest('.form-group').addClass('has-error');
			} else {
				$('#vendorName').closest('.form-group').addClass('has-success');
			} // /else
			if(paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if(paymentType == "") {
				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			} // /else

			if(paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var partNo = document.getElementsByName('partNo[]');				
			var validateProduct;
			for (var x = 0; x < partNo.length; x++) {       			
				var partNoId = partNo[x].id;	    	
		    if(partNo[x].value == ''){	    		    	
		    	$("#"+partNoId+"").after('<p class="text-danger"> Part No. Field is required!! </p>');
		    	$("#"+partNoId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+partNoId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < partNo.length; x++) {       						
		    if(partNo[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	
	   	
		var rate = document.getElementsByName('rate[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < rate.length; x++) {       
	 			var rateId = rate[x].id;
		    if(rate[x].value == ''){	    	
		    	$("#"+rateId+"").after('<p class="text-danger"> Rate Field is required!! </p>');
		    	$("#"+rateId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+rateId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < rate.length; x++) {       						
		    if(rate[x].value){	    		    		    	
		    	validateRate = true;
	      } else {      	
		    	validateRate = false;
	      }          
	   	} // for

			if(purchaseDate && PRId && vendorName && paid && paymentType && paymentStatus) {
				if(validateProduct == true && validateQuantity == true) {
					// create purchase button
					// $("#createPurchaseBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editPurchaseBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// edit purchase button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +' <br /> <br /> <a href="purchase.php?o=manpur" class="btn btn-default" style="margin-left:5px;"><i class="glyphicon glyphicon-plus-sign"></i> Back </a>'+	            		            		            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
		
			return false;
		}); // /edit purchase form function	
	} 	

}); // /documernt


function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productT3ableable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
				
	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+

					'<select class="form-control" name="PR_id[]" id="PR_id'+count+'" onchange="getPRData('+count+')">'+
						'<option value="">~~SELECT~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[0]+'</option>';							
						});
					tr += '</select>'+
					'</div>'+
				'</td>'+			  				
				'<td style="padding-left:40px;">'+
					'<div class="form-group">'+

					'<select class="form-control" name="partNo[]" id="partNo'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">~~SELECT~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="rate[]" id="rate'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1"/>'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {
	if(row) {
		var productId = $("#partNo"+row).val();		
		
		if(productId == "") {
			$("#rate"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#rate"+row).val(1);
					$("#quantity"+row).val(1);

					var total = 1 * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

function getPRData(row = null) {
	if(row) {
		var prId = $("#PR_Id"+row).val();		
		
		if(prId == "") {
			$("#rate"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedPR.php',
				type: 'post',
				data: {prId : prId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#rate"+row).val(1);
					$("#quantity"+row).val(1);

					var total = 1 * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data
// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#rate"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  (Number($("#subTotal").val()) - Number($("#paid").val()));
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#subTotal").val());
		$("#dueValue").val($("#subTotal").val());
	} // else 
} // /sub total amount

function paidAmount() {
	
	var subTotal = $("#subTotal").val();

	if(subTotal) {
		var dueAmount = Number($("#subTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amount function 


function resetPurchaseForm() {
	// reset the input field
	$("#createPurchaseForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset purchase form


// remove purchase from server
function removePurchase(purchaseId = null) {
	if(purchaseId) {
		$("#removePurchaseBtn").unbind('click').bind('click', function() {
			$("#removePurchaseBtn").button('loading');

			$.ajax({
				url: 'php_action/removePurchase.php',
				type: 'post',
				data: {purchaseId : purchaseId},
				dataType: 'json',
				success:function(response) {
					$("#removePurchaseBtn").button('reset');

					if(response.success == true) {

						managePurchaseTable.ajax.reload(null, false);
						// hide modal
						$("#removePurchaseModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removePurchaseMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the purchase

		}); // /remove purchase button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
// /remove purchase from server

// Payment ORDER
function paymentPurchase(purchaseId = null) {
	if(purchaseId) {

		$("#purchaseDate").datepicker();

		$.ajax({
			url: 'php_action/fetchPurchaseData.php',
			type: 'post',
			data: {purchaseId: purchaseId},
			dataType: 'json',
			success:function(response) {				

				// due 
				$("#due").val(response.purchase[5]);				

				// pay amount 
				$("#payAmount").val(response.purchase[5]);

				var paidAmount = response.purchase[4]; 
				var dueAmount = response.purchase[5];							
				var total_amount = response.purchase[3];

				// update payment
				$("#updatePaymentPurchaseBtn").unbind('click').bind('click', function() {
					var payAmount = $("#payAmount").val();
					var paymentType = $("#paymentType").val();
					var paymentStatus = $("#paymentStatus").val();

					if(payAmount == "") {
						$("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#payAmount").closest('.form-group').addClass('has-error');
					} else {
						$("#payAmount").closest('.form-group').addClass('has-success');
					}

					if(paymentType == "") {
						$("#paymentType").after('<p class="text-danger">The Payment Type field is required</p>');
						$("#paymentType").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentType").closest('.form-group').addClass('has-success');
					}

					if(paymentStatus == "") {
						$("#paymentStatus").after('<p class="text-danger">The Payment Status field is required</p>');
						$("#paymentStatus").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentStatus").closest('.form-group').addClass('has-success');
					}

					if(payAmount && paymentType && paymentStatus) {
						$("#updatePaymentPurchaseBtn").button('loading');
						$.ajax({
							url: 'php_action/editPurchasePayment.php',
							type: 'post',
							data: {
								purchaseId: purchaseId,
								payAmount: payAmount,
								paymentType: paymentType,
								paymentStatus: paymentStatus,
								paidAmount: paidAmount,
								total_amount: total_amount
							},
							dataType: 'json',
							success:function(response) {
								$("#updatePaymentPurchaseBtn").button('loading');

								// remove error
								$('.text-danger').remove();
								$('.form-group').removeClass('has-error').removeClass('has-success');

								$("#paymentPurchaseModal").modal('hide');

								$("#success-messages").html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

								// remove the mesages
			          $(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert	

			          // refresh the manage purchase table
								managePurchaseTable.ajax.reload(null, false);

							} //
						});
					} // /if
						
					return false;
				}); // /update payment			

			} // /success
		}); // fetch purchase data
	} else {
		alert('Error ! Refresh the page again');
	}
}