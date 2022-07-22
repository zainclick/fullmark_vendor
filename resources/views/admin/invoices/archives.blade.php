@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>
					{{__('admin/invoices/archives.title')}}
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
			
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET">
					<input type="text" name="q" class="form-control" placeholder="بحث ... ">
				</form>
			</div>
		</div>
		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="">
				
			
			<table class="table table-bordered  table-hover text-center">
				<thead>
					<tr>
						<th>{{__('admin/invoices/index.invoice_number')}}</th>
						<th>{{__('admin/invoices/index.invoice_date')}}</th>
						<th>{{__('admin/invoices/index.invoice_user')}}</th>
						<th>{{__('admin/invoices/index.amount')}}</th>
						<th>{{__('admin/invoices/index.invoioce_status')}}</th>
						<th>{{__('main.control')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($invoices as $invoice)
					<tr>
						<td><i class="fa fa-barcode"></i> {{$invoice->InvoiceNumber}}</td>
						<td>{{$invoice->Date}}</td>
						<td>{{$invoice->Users->name}}</td>
						<td>{{$invoice->Total}}</td>
						<td>{{$invoice->Status()}}</td>
						<td>
						<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{__('main.control')}}</button>
						<ul class="dropdown-menu" style="margin: 0px;">
						<li>
						@if(auth()->user()->has_access_to('show',$invoice))
							<a class="dropdown-item" href="{{route('admin.invoices.show',$invoice)}}">
								<span style="color: #01adef;" class="fas fa-eye "></span> {{__('main.view')}}
							</a>
							@endif
						</li>
							<li>
							@if(auth()->user()->has_access_to('update',$invoice))
							<a class="dropdown-item" href="{{route('admin.invoices.edit',$invoice)}}">
								<span style="color: #ff9800;" class="fas fa-wrench "></span> {{__('main.edit')}}
							</a>
							@endif
							</li>
							
							<li>
							@if(auth()->user()->has_access_to('show',$invoice))
							<a class="dropdown-item" href="{{route('admin.invoices.add_payment',$invoice)}}">
							<span style="color: #2db938;" class="fas fa-coins "></span></span> {{__('main.add_payment')}}
							</a>
							@endif
							</li>

							<li>
							@if(auth()->user()->has_access_to('show',$invoice))
							<a class="dropdown-item" href="{{route('admin.invoice.restore',$invoice)}}">
							<span style="color: #d501ef;" class="fas fa-archive "></span> {{__('main.restore')}}
							</a>
							@endif
							</li>

							<li>
			
							</li>

							
							</ul>
							</div>

							

							@if(auth()->user()->has_access_to('delete',$invoice))
							<!--
							<form method="POST" action="{{route('admin.invoices.destroy',$invoice)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> {{__('main.delete')}}
								</button>
							</form>
							-->
							@endif

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$invoices->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection
