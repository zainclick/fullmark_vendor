@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="create-invoicesd" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.invoices.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/invoices/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>

			<div class="card">
							<div style="padding:0;" class="card-body">
								<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">بيانات الفاتورة</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">المستودع</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">إرفاق ملفات</div>
											</div>
										</a>
									</li>
								</ul>
						<div class="tab-content py-3">
						<div class="tab-pane fade row active show" id="primaryhome" role="tabpanel">
									
						<div class="row">

					
						<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
					{{__('admin/invoices/create.client')}}
				</div>
				<div class="col-12 pt-3" style="position: relative">
				<i class="fas fa-cogs custom-cogs" data-bs-toggle="modal" data-bs-target="#categories-modal"></i>
				<select required class="form-control single-select client-invoice" name="client">
					<option value="">{{__('admin/invoices/create.client')}}</option>
					@foreach($clients as $client)
                          <option value="{{$client->id}}">{{$client->Name}}</option>
                     
					@endforeach
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
				كود العميل
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<input readonly type="text" name="client_code" required   maxlength="190" class="form-control client_code" value="{{old('client_code')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
				{{__('admin/invoices/create.invoice_number')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
				<i class="fas fa-sync-alt insert-barcode" style="position: absolute; left: 12px; top: 28px; cursor: pointer;"></i>
					<input readonly type="text" name="invoice_number" required   maxlength="190" class="form-control barcode-input" value="{{old('invoice_number')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
				{{__('admin/invoices/create.invoice_date')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<input type="date" name="date" required   maxlength="190" class="form-control" value="{{date('Y-m-d')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
				{{__('admin/invoices/create.currency')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
				<select style="" class="form-control"name="currency" id="currency">
					<option value="" style="">العملة</option>
					<option value="AED" style="">AED</option>

				</select>	
				</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
				<div class="col-12">
				طريقة الدفع
				</div>
				<div class="col-12 pt-3" style="position: relative;">
						<select class="form-control" name="payment_method" id="payment_method">
							<option value="1">كاش</option>
							<option value="2">شيك</option>
							<option value="3">حوالة بنكية</option>
						</select>
				</div>
			</div>




	

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
				{{__('admin/invoices/create.client_address')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<textarea style="resize: none;height: 100px;" class="form-control client_address" name="address">{{old('address')}}</textarea>
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
				{{__('admin/invoices/create.other_info')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<textarea style="resize: none;height: 100px;" class="form-control" name="info">{{old('info')}}</textarea>
				</div>
			</div>

						</div>	
						</div>

						<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
							<div class="row">
								<div class="col-12 col-lg-12 p-2">

								<label for="validationCustom01" class="form-label">المستودع</label>

								<select style="height: 54px;" name="main_store" class="form-select select-store" aria-label="Default select example">

								@foreach($stores as $store)
									<option value="{{$store->id}}">{{$store->Name}}</option>	
								@endforeach
															
								</select>


								<div class="form-check content-custom ">
											<input id="form-check-input" class="form-check-input" type="checkbox">
											<label class="form-check-label" for="50">إختيار المستودع لكل بند</label>
										</div>
								</div>
								</div>
							</div>
		


						<div class="tab-pane fade" id="primarycontact" role="tabpanel">
						<div class="row">
						<div class="col-12 col-lg-12 p-2">
						<label for="validationCustom02" class="form-label">إرفاق ملفات</label>
						<input type="file" multiple class="form-control" id="validationCustom02" name="attachment">
						</div>
						</div>

					</div>

						</div>
						</div>
						</div>

			<div class="col-12 p-3 row">
				




				<!-- Start invoce data item -->
				<div class="data-view_1"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 50px;">
					<input hidden type="text" class="form-control main-barcode" placeholder="Barcode" style="height: 55px;margin-bottom: 20px;">
					<table class="table table-bordered table-hover remove-border text-center" id="invoiceItem">	
						<tr style="background-color: #11233b;color:#fff">
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="16%">{{__('admin/invoices/create.product_code')}}</th>
							<th class="store-toggle d-n" width="12%">{{__('admin/invoices/create.store')}}</th>
							<th width="15%">{{__('admin/invoices/create.product_name')}}</th>
							<th width="10%">{{__('admin/invoices/create.quantity')}}</th>
							<th width="10%">{{__('admin/invoices/create.product_price')}}</th>	
							<th width="10%">{{__('admin/invoices/create.product_discount')}}</th>	
							<th width="10%">{{__('admin/invoices/create.product_tax')}}</th>						
							<th width="15%">{{__('admin/invoices/create.total')}}</th>
						</tr>							
						<tr class="custome-td-table">
							<td><input class="itemRow" type="checkbox"></td>
							<td><input readonly type="text" name="data[1][productCode]" id="productCode_1" class="form-control barcode-table" autocomplete="off" required></td>
							<td class="store-toggle1 d-n">
							<select id="custome-store_1" data-id="1" name="data[1][store]" class="form-select" aria-label="Default select example">
							
							<option value="">{{__('admin/invoices/create.store')}}</option>
								@foreach($stores as $store)
									<option value="{{$store->id}}" >{{$store->Name}}</option>	
								@endforeach
					
                      		</select>
							
							</td>
							<td class="p-r" style="padding: 0;">
							<i class="fas fa-cogs custom-cogs" data-bs-toggle="modal" data-bs-target="#categories-modal"></i>
							<select class="form-control single-select all-items all-items_1" data-id="1" name="data[1][productname]" id="productName_1" required ">
								<option value="">{{__('admin/invoices/create.product_name')}}</option>	
							@foreach($products as $product)
								<option value="{{$product->id}}">{{$product->Name}}</option>
								@endforeach
							</select>
						</td>			
							<td style="position: relative;"><input type="number" value="1" name="data[1][quantity]" id="quantity_1" class="form-control quantity" autocomplete="off" required ><span id="span-quantity_1" class="invoice-item-quantity"></span></td>
							<td><input readonly type="number" name="data[1][price]" id="price_1" class="form-control price" autocomplete="off" required ></td>
							<td><input readonly type="text" name="data[1][productDiscount]" id="productDiscount_1" class="form-control discount-table" autocomplete="off"></td>			
							<td><input readonly type="text" name="data[1][productTax]" id="productTax_1" class="form-control tax-table" autocomplete="off"></td>			
							<td><input readonly  type="number" name="data[1][total]" id="total_1" class="form-control total text-center total-table" autocomplete="off" required ></td>
						</tr>						
					</table>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">

					<div class="btn-group" >
					<button type="button" id="addRows" name="send-form" style="background-color: #11233b;border-color: #11233b;" class="btn btn-primary b-r-d-n">{{__('admin/invoices/create.new_line')}}</button>
					<button type="button" style="background-color: #11233b;border-color: #505050;" class="btn btn-primary split-bg-primary b-r-d-n"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus text-light"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</button>
					</div>

					<div class="btn-group" >
					<button id="removeRows" type="button" name="send-form" style="background-color: #f76f82;border-color: #f76f82;" class="btn btn-primary b-r-d-n">{{__('admin/invoices/create.delete_line')}}</button>
					<button type="button" style="background-color: #fbfbfb;border-color: #f76f82;" class="btn btn-primary split-bg-primary b-r-d-n"><i style="font-size: 14px;color: #f76f82;" class="fas fa-trash-alt"></i>
					</button>
					</div>

				</div>

						<div class="col-md-12" style="margin-top: 25px;">
						<div class="row">

						
						<div class="col-md-2 form-group"  style="background-color: #eee;padding: 10px;">
							<label>إضافة ضريبة</label>

							<div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">%</span>
							<input style="height: 54px;" type="number" class="form-control" name="alltax"id="taxRate" placeholder="إضافة ضريبة" aria-label="Username" aria-describedby="basic-addon1">
							</div>
					


						</div>
						<div class="col-md-2 form-group" style="background-color: #eee;padding: 10px;">
						<label>مبلغ الضريبة</label>
							<div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
							<input readonly style="height: 54px;" type="number" class="form-control" name="taxAmount"id="taxAmount" placeholder="قيمة الضريبة" aria-label="Username" aria-describedby="basic-addon1">
							</div>

						<div class="custom-margin  d-n" style="background-color: #eee;padding: 10px;">
						<label for="payment_id" class="form-label">رقم المعرف</label>
						<input style="height: 54px;" class="form-control" name="payment_id" id="payment_id" type="text" placeholder="رقم المعرف" autocomplete="off">
						</div>

						</div>							

						<div class="col-md-4 form-group" style="background-color: #eee;padding: 10px;">
						<div class="row">
						<div class="col-md-6">
						<label>المبلغ المدفوع</label>
							<div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
							<input style="height: 54px;" type="number" class="form-control" name="amountPaid"id="amountPaid" placeholder="المبلغ المدفوع" aria-label="Username" aria-describedby="basic-addon1">
						</div>
						</div>
						<div class="col-md-6">
						<label>الخصم</label>
							<div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
							<input style="height: 54px;" type="number" class="form-control" name="discount"id="discount" placeholder="الخصم" aria-label="Username" aria-describedby="basic-addon1">
						</div>
						</div>
						</div>
						</div>

						
					<div class="col-md-4" style="background-color: #eee;padding: 10px;border: 1px solid#fff;">
					<table class="table table-bordered table-hover">
							<tbody>
								<tr class="r1" style="background-color: #11233b;color: #fff;">
								<td>
								<span style="font-weight: bold;">الإجمالي</span>
								</td>
								<td>
								<span id="subTotal">0</span> ج.م
								</td>
								</tr>

								<tr class="r2 d-n">
								<td>
								<span style="font-weight: bold;">قيمة الضريبة</span>
								</td>
								<td>
								<span id="taxamounttext">0</span> ج.م
								
								</td>
								</tr>

								<tr class="r3 d-n">
								<td>
								<span style="font-weight: bold;">الإجمالي بعد الضريبة</span>
								</td>
								<td>
								<span id="totalAftertax">0</span> ج.م
								
								</td>
								</tr>	

								<tr class="r4 d-n">
								<td>
								<span style="font-weight: bold;">المبلغ المدفوع</span>
								</td>
								<td>
								<span id="amountPaidtext">0</span> ج.م
								</td>
								</tr>	


								<tr class="r5 d-n">
								<td>
								<span style="font-weight: bold;">الخصم</span>
								</td>
								<td>
								<span id="discounttext">0</span> ج.م
								</td>
								</tr>	

								<tr class="r6 d-n">
								<td>
								<span style="font-weight: bold;">باقي المبلغ</span>
								</td>
								<td>
								<span id="amountDue">0</span> ج.م
								</td>
								</tr>

								<tr>
								<td>
								<span style="font-weight: bold;">الإجمالي</span>
								</td>
								<td>
								<span id="amountDue3">0</span> ج.م
								</td>
								</tr>

							</tbody>
						</table>
					</div>


						</div>
						</div>






						<input hidden type="" id="amountDue2" name="total">

	
			</div>
 
		</div>
		 
		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">{{__('main.save')}}</button>
			<a href="{{route('admin.invoices.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection

@section('scripts')

@include('admin.invoices.scripts');
@endsection