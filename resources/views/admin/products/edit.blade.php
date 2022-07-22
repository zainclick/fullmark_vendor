@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.products.update',$product)}}">
		@csrf
		@method('PUT')
		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/products/edit.title')." ".$product->Name}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			<input type="hidden" name="id" value="{{$product->id}}">

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/edit.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{$product->getTranslation('Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/edit.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{$product->getTranslation('Name','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/products/edit.quantity')}}
				</div>
				<div class="col-12 pt-3">
					<input type="number" name="quantity" required   maxlength="190" class="form-control" value="{{$product->Quantity}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/products/edit.slug_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_ar" required   maxlength="190" class="form-control" value="{{$product->getTranslation('Slug','ar')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/products/edit.slug_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_en" required   maxlength="190" class="form-control" value="{{$product->getTranslation('Name','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.barcode')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
					<input readonly type="text" name="barcode" required   maxlength="190" class="form-control barcode-input" value="{{$product->Barcode}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.buy_price')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="buy_price" required   maxlength="190" class="form-control" value="{{$product->BuyPrice}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.sale_price')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="sale_price" required   maxlength="190" class="form-control" value="{{$product->SalePrice}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.discount')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="discount" maxlength="190" class="form-control" value="{{$product->Discount}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.store')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select" name="store">
					@foreach($stores as $store)
                          <option @if($product->Store_Id == $store->id) selected @endif value="{{$store->id}}">{{$store->Name}}</option>
                     
					@endforeach
                      </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.category')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="category">
				@foreach($categories as $category)
                          <option @if($product->Category_Id == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.unit')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="unit">
				@foreach($unites as $unit)
                	<option @if($product->Unit_Id == $unit->id) selected @endif value="{{$unit->id}}">{{$unit->Name}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/products/edit.tax')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control single-select"  name="tax">
				@foreach($taxes as $tax)
                	<option @if($product->Tax_Id == $tax->id) selected @endif value="{{$tax->Value}}">{{$tax->Name}}</option>
                     
				@endforeach
                </select>
			</div>
			</div>


			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/products/edit.description_ar')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="description_ar" class="editor with-file-explorer" >{{$product->getTranslation('Description','ar')}}</textarea>
				</div>
			</div>

			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/products/edit.description_en')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="description_en" class="editor with-file-explorer" >{{$product->getTranslation('Description','en')}}</textarea>
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