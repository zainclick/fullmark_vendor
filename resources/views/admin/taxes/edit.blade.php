@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.taxes.update',$tax)}}">
		@csrf
		@method('PUT')
		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/taxes/edit.title')." ".$tax->Name}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/taxes/edit.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{$tax->getTranslation('Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/taxes/edit.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{$tax->getTranslation('Name','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/taxes/edit.value')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="value" required   maxlength="190" class="form-control" value="{{$tax->Value}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/taxes/edit.slug_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_ar" required   maxlength="190" class="form-control" value="{{$tax->getTranslation('Slug','ar')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/taxes/edit.slug_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_en" required   maxlength="190" class="form-control" value="{{$tax->getTranslation('Slug','en')}}" >
				</div>
			</div>


			<input type="hidden" name="id" value="{{$tax->id}}">

	
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