@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-categories"></span> {{__('admin/products/index.title')}}
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.products.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span>{{__('admin/products/index.create')}}</span>
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
						<th>{{__('admin/products/index.barcode')}}</th>
						<th>{{__('admin/products/index.product')}}</th>
						<th>{{__('admin/products/index.category')}}</th>
						<th>{{__('admin/products/index.store')}}</th>
						<th>{{__('admin/products/index.quantity')}}</th>
						<th>{{__('admin/products/index.sale_price')}}</th>
						<th>{{__('admin/products/index.discount')}}</th>
						<th>{{__('main.control')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						<td>{{$product->Barcode}}</td>

						<td>{{$product->Name}}</td>
						<td>{{$product->Category_Id}}</td>
						<td>{{$product->Store_Id}}</td>
						<td>{{$product->Quantity}}</td>
						<td>{{$product->SalePrice}}</td>
						<td>{{$product->Discount}}</td>
						<td style="width: 230px;">
							@if(auth()->user()->has_access_to('update',$product))
							<a href="{{route('admin.products.edit',$product)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span>{{__('main.control')}}
							</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$product))
							<form method="POST" action="{{route('admin.products.destroy',$product)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('{{__('main.confirm_delete')}}');if(result){}else{event.preventDefault()}">
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
			{{$products->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection
