@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>
					{{__('admin/invoices/unpaied.title')}}
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.invoices.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span>{{__('admin/invoices/index.create')}}</span>
					</a>
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

						@if(auth()->user()->has_access_to('show',$invoice))
							<a href="{{route('admin.invoices.show',$invoice)}}">
							<span class="btn  btn-outline-info btn-sm font-1 mx-1">
								<span class="fas fa-eye "></span> {{__('main.view')}}
							</span>
							</a>
							@endif

							@if(auth()->user()->has_access_to('show',$invoice))
							<a href="{{route('admin.invoices.add_payment',$invoice)}}">
							<span class="btn  btn-outline-dark btn-sm font-1 mx-1">
								<span class="fas fa-hand-dollar"></span> {{__('main.add_payment')}}
							</span>
							</a>
							@endif

							@if(auth()->user()->has_access_to('update',$invoice))
							<a href="{{route('admin.invoices.edit',$invoice)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> {{__('main.edit')}}
							</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$invoice))
							<form method="POST" action="{{route('admin.invoices.destroy',$invoice)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> {{__('main.delete')}}
								</button>
							</form>
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
