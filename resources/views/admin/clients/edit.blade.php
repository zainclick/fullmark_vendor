@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.clients.update',$client)}}">
		@csrf
		@method('PUT')
		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/clients/edit.title')." ".$client->Name}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input readonly type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input readonly type="text" name="name_en" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Name','en')}}" >
				</div>
			</div>

			
			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.firstname_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="first_name_ar" required   maxlength="190" class="form-control" value="{{$client->getTranslation('First_Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.firstname_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="first_name_en" required   maxlength="190" class="form-control" value="{{$client->getTranslation('First_Name','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/clients/create.email')}}
				</div>
				<div class="col-12 pt-3">
					<input type="email" name="email" required   maxlength="190" class="form-control" value="{{$client->email}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/clients/create.barcode')}}
				</div>
				<div class="col-12 pt-3">
					<input readonly type="number" name="barcode" required   maxlength="190" class="form-control" value="{{$client->Barcode}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.lastname_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="last_name_ar" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Last_Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.lastname_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="last_name_en" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Last_Name','en')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.slug_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_ar" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Slug','ar')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.slug_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="slug_en" required   maxlength="190" class="form-control" value="{{$client->getTranslation('Slug','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.phone')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="phone" required   maxlength="190" class="form-control" value="{{$client->Phone}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.city')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="city" required   maxlength="190" class="form-control" value="{{$client->City}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.streate')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="streate" required   maxlength="190" class="form-control" value="{{$client->Streat}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.postal')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="postal" required   maxlength="190" class="form-control" value="{{$client->Post}}" >
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
					<input type="text" name="post"  maxlength="190" class="form-control" value="{{$client->Tax_Cridet}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/clients/create.record')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="record"  maxlength="190" class="form-control" value="{{$client->Record}}" >
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
					<textarea name="notes_ar" class="editor with-file-explorer" >{{$client->getTranslation('Notes','ar')}}</textarea>
				</div>
			</div>

			<div class="col-6  p-2">
				<div class="col-12">
				{{__('admin/clients/create.notes_en')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="notes_en" class="editor with-file-explorer" >{{$client->getTranslation('Notes','en')}}</textarea>
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