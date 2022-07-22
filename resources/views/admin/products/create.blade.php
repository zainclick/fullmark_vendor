@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.products.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/products/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/create.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{old('name_ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/create.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{old('name_en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/create.quantity')}}
				</div>
				<div class="col-12 pt-3">
					<input type="number" name="quantity" required   maxlength="190" class="form-control" value="{{old('quantity')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/products/create.slug_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_ar" required   maxlength="190" class="form-control" value="{{old('slug_ar')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/products/create.slug_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_en" required   maxlength="190" class="form-control" value="{{old('slug_en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.barcode')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<i class="fas fa-sync-alt insert-barcode" style="position: absolute; left: 12px; top: 28px; cursor: pointer;"></i>
					<input type="text" name="barcode" required   maxlength="190" class="form-control barcode-input" value="{{old('barcode')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.buy_price')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="buy_price" required   maxlength="190" class="form-control" value="{{old('buy_price')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.sale_price')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="sale_price" required   maxlength="190" class="form-control" value="{{old('sale_price')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.discount')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="discount" required   maxlength="190" class="form-control" value="{{old('discount')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.store')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select" name="store">
					@foreach($stores as $store)
                          <option value="{{$store->id}}">{{$store->Name}}</option>
                     
					@endforeach
                      </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.category')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="category">
				@foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->title}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.unit')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="unit">
				@foreach($unites as $unit)
                	<option value="{{$unit->id}}">{{$unit->Name}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/create.tax')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control single-select"  name="tax">
				@foreach($taxes as $tax)
                	<option value="{{$tax->Value}}">{{$tax->Name}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>


			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/products/create.description_ar')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="description_ar" class="editor with-file-explorer" >{{old('description_ar')}}</textarea>
				</div>
			</div>

			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/products/create.description_en')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="description_en" class="editor with-file-explorer" >{{old('description_en')}}</textarea>
				</div>
			</div>




	
			</div>
 
		</div>
		 
		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">{{__('main.save')}}</button>
			<a href="{{route('admin.categories.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection