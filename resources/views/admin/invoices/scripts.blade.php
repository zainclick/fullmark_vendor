<script>

    
$(document).on('click', '#checkAll', function() {          	
	$(".itemRow").prop("checked", this.checked);
});	

// added row
$(document).on('click', '.itemRow', function() {  	
	if ($('.itemRow:checked').length == $('.itemRow').length) {
		$('#checkAll').prop('checked', true);
	} else {
		$('#checkAll').prop('checked', false);
	}
}); 
// remove row
$(document).on('click', '#removeRows', function(){
	$(".itemRow:checked").each(function() {
		$(this).closest('tr').remove();
	});
	$('#checkAll').prop('checked', false);
	calculateTotal();
});


	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		appendRows();
	});

	function appendRows(){
		count++;
		var htmlRows = '';
		htmlRows += '<tr class="custome-td-table">';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input readonly type="text" name="data['+count+'][productCode]" id="productCode_'+count+'" class="form-control barcode-table" autocomplete="off"></td>';          
		htmlRows += '<td class="store-toggle1 d-n"><select data-id="'+count+'" id="custome-store_'+count+'" name="data['+count+'][store]" class="form-select" aria-label="Default select example"></select></td>';
		htmlRows += '<td class="p-r" style="padding: 0;"><i class="fas fa-cogs custom-cogs" data-bs-toggle="modal" data-bs-target="#categories-modal"></i><select data-id="'+count+'" class="form-control single-select all-items all-items_'+count+' s-get-item_'+count+'" name="data['+count+'][productname]" id="productName_'+count+'"></select></td>';	
		htmlRows += '<td style="position:relative;"><input type="number" name="data['+count+'][quantity]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off" value="1"><span id="span-quantity_'+count+'" class="invoice-item-quantity"></span></td>';   		
		htmlRows += '<td><input readonly type="number" name="data['+count+'][price]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input readonly type="text" name="data['+count+'][productDiscount]" id="productDiscount_'+count+'" class="form-control discount-table" autocomplete="off"></td>';	
		htmlRows += '<td><input readonly type="text" name="data['+count+'][productTax]" id="productTax_'+count+'" class="form-control tax-table" autocomplete="off"></td>';	
		htmlRows += '<td><input readonly type="number" name="data['+count+'][total]" id="total_'+count+'" class="form-control total-table text-center total" autocomplete="off"></td>';          

		htmlRows += '</tr>';

		$('#invoiceItem').append(htmlRows);
		
		if($('.store-toggle').hasClass('d-n')){

		}else{
			$('.store-toggle1').removeClass('d-n');
		}

		// get stores to append rows 
		jQuery.ajax({
			url:"{{route('get_stores')}}",
			success:function(result){
				jQuery("#custome-store_"+count).html(result);
			}
		});

		// set data product for new row 

		let searchText = $('.select-store').val();
		if (searchText != "") {
		$.ajax({
		url: "{{route('get_item_global_store')}}",
		method: "post",
		data: {
			'_token' : "{{csrf_token()}}",
		store: searchText,
		},
		success: function(data) {
		
		$('.all-items_'+count).html(data);

		},
		complete: function() {
			$('.single-select').select2();
			},
		});
		} else {
		$('.all-items'+count).html('');
		}

			$('.single-select').select2();
		}






//get client data
$(document).on('change','.client-invoice',function(){

    var id = $(this).val();
        $.ajax({
            type:'GET',
            url:'{{URL::to('get_client')}}/'+ id,
            dataType: 'json',
            contentType:false,
            processData:false,
            success:function(data) {
				
                $('.client_address').val(data.City +" "+ data.Streat);
				$('#currency').val(data.Currency);
				$('.client_code').val(data.Barcode);
				$('.insert-barcode').click();
            }

        })
});

// get data product when choose the product

$(document).on('change', "[id^=productName_]", function(){

let dataId = $(this).attr('data-id');
let searchText = $(this).val();
if (searchText != "") {
$.ajax({
url: "{{route('get_item')}}",
method: "post",
data: {
'_token' : "{{csrf_token()}}",
  product: searchText,
  id: dataId,
},
success: function (data) {
  $("#productCode_"+dataId).val(data.Barcode);
  $("#price_"+dataId).val(data.SalePrice);
  $("#productDiscount_"+dataId).val(data.Discount);
  $("#productTax_"+dataId).val(data.Tax_Id);
  calculateTotal();
},

});
} else {
$(".data-view_"+dataId).html('');
}
});



// set store for each row 

$('#form-check-input').on('change',function(){

	$('.store-toggle').toggleClass('d-n');
	$('.store-toggle1').toggleClass('d-n');
	if($('.store-toggle').hasClass('d-n')){

		$('.select-store').removeClass('d-n');

	}else{

		$('.select-store').addClass('d-n');

	}

});

// start calculate function 

function calculateTotal(){
	var totalAmount = 0; 
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var quantity = $('#quantity_'+id).val();
		var discount = $('#productDiscount_'+id).val();
		var tax = $('#productTax_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		if(!discount) {
			discount = 0;
		}
		if(!tax) {
			tax = 0;
		}
		var total = price*quantity-(discount)+(parseFloat(tax)*(price*quantity/100));
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});

	$('#subTotal').text(parseFloat(totalAmount));
	$('#subTotal2').text(parseFloat(totalAmount));

	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').text();

	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		$('#taxamounttext').text(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').text(subTotal);	
		$('#totalAftertax2').text(subTotal);	
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').text();
		var discount = $('#discount').val()

		if(amountPaid || totalAftertax || discount) {
			totalAftertax = totalAftertax-amountPaid-discount;			
			$('#amountDue').text(totalAftertax);
			$('#amountDue2').val($('#totalAftertax').text());
			$('#amountDue3').text($('#totalAftertax').text());
			$('#amountPaidtext').text(amountPaid);
			$('#discounttext').text(discount);
		} else {		
			$('#amountDue').text(subTotal);
			$('#amountDue2').val($('#totalAftertax').text());
			$('#amountDue3').text($('#totalAftertax').text());
			$('#amountPaidtext').text(0);
			$('#discounttext').text(0);

		}

	}
}



$(document).on('keyup', "[id^=quantity_]", function(){
	calculateTotal();
});	
$(document).on('keyup', "[id^=price_]", function(){
	calculateTotal();
});	
$(document).on('keyup', "[id^=productDiscount_]", function(){
	calculateTotal();
});	
$(document).on('keyup', "[id^=productTax_]", function(){
	calculateTotal();
});	
$(document).on('keyup', "#taxRate", function(){		
	calculateTotal();
});	
$(document).on('keyup', "#amountPaid", function(){
	var amountPaid = $(this).val();
	var discount = $('#discount').val();
	var totalAftertax = $('#totalAftertax').text();	
	if(amountPaid || totalAftertax || discount) {
		totalAftertax = totalAftertax-amountPaid-discount;			
		$('#amountDue').text(totalAftertax);
		$('#amountDue2').val($('#totalAftertax').text());
		$('#amountDue3').text($('#totalAftertax').text());
		$('#amountPaidtext').text(amountPaid);
		$('#discounttext').text(discount);
	} else {
		$('#amountDue').text(totalAftertax);
		$('#amountDue2').val($('#totalAftertax').text());
		$('#amountDue3').text($('#totalAftertax').text());
		$('#amountPaidtext').text(0);
		$('#discounttext').text(0);
	}	
});	
$(document).on('keyup', "#discount", function(){
	
	var discount = $(this).val();
	var amountPaid = $('#amountPaid').val();
	var totalAftertax = $('#totalAftertax').text();	
	if(amountPaid || totalAftertax || discount) {
		totalAftertax = totalAftertax-amountPaid-discount;			
		$('#amountDue').text(totalAftertax);
		$('#amountDue2').val($('#totalAftertax').text());
		$('#amountDue3').text($('#totalAftertax').text());

		$('#amountPaidtext').text(amountPaid);
		$('#discounttext').text(discount);
	} else {
		$('#amountDue').text(totalAftertax);
		$('#amountDue2').val($('#totalAftertax').text());
		$('#amountDue3').text($('#totalAftertax').text());
		$('#amountPaidtext').text(0);
		$('#discounttext').text(0);
	}	
});	


$(document).on('keyup','#create-invoicesd',function(){	


if($('#taxRate').val() != ""){

	$('.r2').removeClass('d-n');
	$('.r3').removeClass('d-n');
}else{
	$('.r2').addClass('d-n');
	$('.r3').addClass('d-n');
	}

if($('#amountPaid').val() != ""){

	$('.r4').removeClass('d-n');
	$('.r6').removeClass('d-n');
}else{
	$('.r4').addClass('d-n');
	$('.r6').addClass('d-n');
}

if($('#discount').val() != ""){

	$('.r5').removeClass('d-n');
}else{
	$('.r5').addClass('d-n');
}

});


// get item by parent store 
$(window).on('load', function(){

getitembystore();

});

function resetTable(){

	$('.barcode-table').each(function(){

	$(this).val('');
	});

	$('.price').each(function(){

		$(this).val('');
	});

	$('.discount-table').each(function(){

	$(this).val('');
	});

	$('.tax-table').each(function(){

	$(this).val('');
	});

	$('.total-table').each(function(){

	$(this).val('');
	});

}

$(document).on('change','.select-store',function(){

getitembystore();
resetTable()

})

function getitembystore(){

let searchText = $('.select-store').val();
if (searchText != "") {
  $.ajax({
	url: "{{route('get_item_global_store')}}",
	method: "post",
	data: {
		'_token' : "{{csrf_token()}}",
		store: searchText,

	},
	success: function (response) {
	  $(".all-items").html(response);
	},
	complete: function() {
		$('.single-select').select2();
		},
  });
} else {
	$(".all-items").html('');
}

}

// Get product by custome store

$(document).on('change', "[id^=custome-store_]", function(){

let searchText = $(this).val();
let id = $(this).attr('data-id');
if (searchText != "") {
  $.ajax({
	url: "{{route('get_item_global_store')}}",
	method: "post",
	data: {
	'_token' : "{{csrf_token()}}",
	  store: searchText,
	  id: id,
	},
	success: function (response) {
	  $(".all-items_"+id).html(response);
	},
	complete: function() {
		$('#productDescription_'+id).val("");
		$('#price_'+id).val("");
		$('#productDiscount_'+id).val("");
		$('#productTax_'+id).val("");
		$('#total_'+id).val("");
		$('.single-select').select2();
		},
  });
} else {
	$(".all-items_"+id).html('');
}

});


// payment method select
$(document).on('change',"#payment_method",function(){

if($(this).val() == 3){

	$('#payment_id').parent().toggleClass('d-n');
}else{
	if($('#payment_id').parent().hasClass('d-n')){

	}else{

		$('#payment_id').parent().addClass('d-n');
	}
}


});

// Main bar code 

$(document).on('change','.main-barcode',function(){

	let searchText = $(this).val();

	$.ajax({
		url:"{{route('get_item_by_barcode')}}",
		method: "post",
		data: {
		'_token' : "{{csrf_token()}}",
	  	store: searchText,
	},
		success:function(data){
			if(data.Barcode){
				appendRows();
			$('#productName_'+count).val(data.id);
			$('#productCode_'+count).val(data.Barcode);
			$('#custome-store_'+count).val(data.Store_Id);
			$('#price_'+count).val(data.SalePrice);
			$('#productDiscount_'+count).val(data.Discount);
			$('#productTax_'+count).val(data.Tax_Id);
			calculateTotal();
			}
			
		},
		complete: function() {
			$('.main-barcode').val("");
			$('.main-barcode').focus();
		},
	});

});






</script>