@extends('layouts.admin')
@section('content')

<div class="col-12 col-lg-12 p-3">
<div class="card">
							<div style="padding:0;" class="card-body">
								<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">{{__('admin/invoices/show.invoice_details')}}</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">{{__('admin/invoices/show.payments')}}</div>
											</div>
										</a>
									</li>

									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#attachments" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">{{__('admin/invoices/show.attachment')}}</div>
											</div>
										</a>
									</li>

									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">{{__('admin/invoices/show.logactive')}}</div>
											</div>
										</a>
									</li>

                                    <div class="ms-auto">
				<div class="btn-group">

				<div class="pagination-box-new">
        				<!-- <span class="btn inside_nav" style=""></span> -->
				
		
             </div>

				<a type="button" href="{{route('admin.invoices.add_payment',$invoice)}}" name="send-form" class="btn btn-primary">{{__('admin/invoices/show.add_payment')}}</a>
				<button type="button" class="btn btn-primary split-bg-primary "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus text-light"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
				</button>

				<a style="margin-left: 10px;margin-right: 5px;" type="button" href="{{route('admin.invoices.send.email',$invoice)}}" name="send-form" class="btn btn-success">{{__('admin/invoices/show.send_client')}}</a>

				
                <div class="btn-group pag-box-new pull-right" style="background-color: #e6e6e6;margin-right: 10px;">

                <a class="text-left btn btn-default not " @if(isset($last->id)) href="{{route('admin.invoices.show',$last->id)}}" title="{{__('main.last')}}" @endif @if(!isset($last->id)) style="background-color: #f5f5f5;color: #c9c9c9;cursor: auto;" @endif>
                    <i style="font-size: 15px;" class="fa fa-chevron-up"></i>
                </a>
                <a class="btn btn-default not"  @if(isset($next->id)) href="{{route('admin.invoices.show',$next->id)}}" title="{{__('main.next')}}" @endif @if(!isset($next->id)) style="background-color: #f5f5f5;color: #c9c9c9;cursor: auto;" @endif>
                    <i style="font-size: 15px;" class="fa fa-chevron-down"></i>
                </a>
                </div>
	
				
				</div>

				</div>

								</ul>
						<div class="tab-content py-3">
						<div class="tab-pane fade row active show" id="primaryhome" role="tabpanel">
									
						<div class="row">

                        <div class="col-12 p-0" style="">
				
			
			<table class="table table-bordered  table-hover text-center">
				<thead>
					<tr>
						<th>{{__('admin/invoices/show.barcode')}}</th>
						<th>{{__('admin/invoices/show.product')}}</th>
						<th>{{__('admin/invoices/show.quantity')}}</th>
						<th>{{__('admin/invoices/show.price')}}</th>
						<th>{{__('admin/invoices/show.total')}}</th>
					</tr>
				</thead>
				<tbody>
				
                @foreach($invoice_details as $details)
                <tr>
					<td><i class="fa fa-barcode"></i> {{$details->Barcode}}</td>
					<td>{{$details->products->Name}}</td>
					<td>{{$details->Quantity}}<span style="font-weight: bold;color: #0d6efd;"}> {{$details->products->unit->Name}} </span></td>
					<td>{{$details->Product_Price }}<span style="font-weight: bold;color: #198754;"}> {{$details->client->Currency}} </span></td>
					<td>{{$details->Total}}<span style="font-weight: bold;color: #198754;"}> {{$details->client->Currency}} </span></td>
				</tr>
                @endforeach

					</tbody>
			</table>
			</div>

			</div>	
			</div>

				<!-- Start payments section -->

				<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
				<div class="row">
				<div class="col-12 col-lg-12 p-2">

				<table class="table table-bordered  table-hover text-center">
				<thead>
					<tr>
						<th>{{__('admin/invoices/show.invoice_number')}}</th>
						<th>{{__('admin/invoices/show.payment_method')}}</th>
						<th>{{__('admin/invoices/show.date')}}</th>
						<th>{{__('admin/invoices/show.recever')}}</th>
						<th>{{__('admin/invoices/show.client')}}</th>
						<th>{{__('admin/invoices/show.amount')}}</th>
						<th>{{__('main.control')}}</th>

					</tr>
				</thead>
				<tbody>
				
                @foreach($payments as $payment)
                <tr>
					<td><i class="fa fa-barcode"></i> {{$payment->invoice->InvoiceNumber}}</td>
					<td>{{$payment->PaymentMethod}}</td>
					<td>{{$payment->Date}}</td>
					<td>{{$payment->user->name }}</td>
					<td>{{$payment->client->Name}}</td>
					<td>{{$payment->Amount}}<span style="font-weight: bold;color: #198754;"}> {{$details->client->Currency}} </span></td>
					<td>

					@if(auth()->user()->has_access_to('add_payment',$invoice))
							<a href="{{route('admin.invoices.add_payment',$invoice)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-hand-dollar"></span> {{__('main.edit')}}
							</span>
							</a>
					@endif

					@if(auth()->user()->has_access_to('add_payment',$invoice))
							<a href="{{route('admin.invoices.add_payment',$invoice)}}">
							<span class="btn  btn-outline-danger btn-sm font-1 mx-1">
								<span class="fas fa-hand-dollar"></span> {{__('main.delete')}}
							</span>
							</a>
					@endif
					</td>
				</tr>
                @endforeach

					</tbody>
				</table>


				</div>
				</div>
				</div>
		

						<!-- Start attachments section -->
						<div class="tab-pane fade" id="attachments" role="tabpanel">
						<div class="row">
						<div class="col-12 col-lg-12 p-2">
						<table class="table table-bordered  table-hover text-center">
				<thead>
					<tr>
						<th>#</th>
						<th>{{__('admin/invoices/show.file_name')}}</th>
						<th>{{__('admin/invoices/show.file_type')}}</th>
						<th>{{__('main.control')}}</th>

					</tr>
				</thead>
				<tbody>
				@php 
					$i = 0;
				@endphp
                @foreach($attachments as $attachment)
				@php 
				$i++;
				@endphp
                <tr>
					<td>{{$i}}</td>
					<td>{{$attachment->Attachment}}</td>
					<td>
						@php 
						$type = explode('.',$attachment->Attachment);
						$end = end($type);
						if($end == 'pdf'){

							echo 'Pdf File';
						}elseif($end == 'jpg' || $end == 'png' || $end == 'gif' || $end == 'jpeg'){
							echo 'Image';
						}elseif($end == 'doc' || $end == 'docx'){
							echo 'Word File';
						}elseif($end == 'xlsx' || $end == 'xlsm' || $end == 'csv'){
							echo 'Excel File';
						}
						@endphp
					</td>
					<td>
					@if(auth()->user()->has_access_to('add_payment',$invoice))
					<a href="{{route('admin.invoices.view.attachment',[$invoice->InvoiceNumber,$attachment->Attachment])}}">
					<span class="btn  btn-outline-info btn-sm font-1 mx-1">
						<span class="fas fa-hand-dollar"></span> {{__('main.view')}}
					</span>
					</a>
					@endif

					@if(auth()->user()->has_access_to('add_payment',$invoice))
					<a href="{{route('admin.invoices.download.attachment',[$invoice->InvoiceNumber,$attachment->Attachment])}}">
					<span class="btn  btn-outline-success btn-sm font-1 mx-1">
						<span class="fas fa-hand-dollar"></span> {{__('main.download')}}
					</span>
					</a>
					@endif
			
					@if(auth()->user()->has_access_to('add_payment',$invoice))
					<a href="{{route('admin.invoices.add_payment',$invoice)}}">
					<span class="btn  btn-outline-danger btn-sm font-1 mx-1">
						<span class="fas fa-hand-dollar"></span> {{__('main.delete')}}
					</span>
					</a>
					@endif
					</td>
				</tr>
                @endforeach

					</tbody>
				</table>
						</div>
						</div>
						</div>

						<!-- Start logactive section -->
						<div class="tab-pane fade" id="primarycontact" role="tabpanel">
						<div class="row">
						<div class="col-12 col-lg-12 p-2">
						<label for="validationCustom02" class="form-label">إرفاق ملفات</label>
						<input type="file" multiple="" class="form-control" id="validationCustom02" name="attachment">
						</div>
						</div>
						</div>

						</div>
						</div>
						</div>
                        </div>
@endsection
