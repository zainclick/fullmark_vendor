@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.clients.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/clients/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{old('name_ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{old('name_en')}}" >
				</div>
			</div>

			
			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.firstname_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="first_name_ar" required   maxlength="190" class="form-control" value="{{old('first_name_ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.firstname_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="first_name_en" required   maxlength="190" class="form-control" value="{{old('first_name_en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/clients/create.email')}}
				</div>
				<div class="col-12 pt-3">
					<input type="email" name="email" required   maxlength="190" class="form-control" value="{{old('email')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/clients/create.barcode')}}
				</div>
				<div class="col-12 pt-3" style="position: relative;">
				<i class="fas fa-sync-alt insert-barcode" style="position: absolute; left: 12px; top: 28px; cursor: pointer;"></i>
					<input type="text" name="barcode" required   maxlength="190" class="form-control barcode-input" value="{{old('barcode')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.lastname_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="last_name_ar" required   maxlength="190" class="form-control" value="{{old('last_name_ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.lastname_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="last_name_en" required   maxlength="190" class="form-control" value="{{old('last_name_en')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.slug_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_ar" required   maxlength="190" class="form-control" value="{{old('slug_ar')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.slug_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_en" required   maxlength="190" class="form-control" value="{{old('slug_en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.phone')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="phone" required   maxlength="190" class="form-control" value="{{old('phone')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.city')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="city" required   maxlength="190" class="form-control" value="{{old('city')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.streate')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="streate" required   maxlength="190" class="form-control" value="{{old('streate')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.postal')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="postal" required   maxlength="190" class="form-control" value="{{old('postal')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.country')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="country">
                	<option value="uae">UAE</option>
                     
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.curency')}}
				</div>
				<div class="col-12 pt-3">
				<select required class="form-control single-select"  name="curency">
                	<option value="AED">AED</option>
                     
                </select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.post')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="post"  maxlength="190" class="form-control" value="{{old('post')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.record')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="record"  maxlength="190" class="form-control" value="{{old('record')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-12 p-2">
				<div class="col-12">
					{{__('admin/clients/create.avatar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="file" name="avatar"  maxlength="190" class="form-control">
				</div>
			</div>

			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/clients/create.notes_ar')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="notes_ar" class="editor with-file-explorer" >{{old('notes_ar')}}</textarea>
				</div>
			</div>

			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/clients/create.notes_en')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="notes_en" class="editor with-file-explorer" >{{old('notes_en')}}</textarea>
				</div>
			</div>
	
			</div>
 
		</div>
		 
		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">{{__('main.save')}}</button>
			<a href="{{route('admin.clients.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection