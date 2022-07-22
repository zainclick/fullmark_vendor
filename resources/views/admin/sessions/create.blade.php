@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.sessions.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/sessions/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" maxlength="190" required class="form-control" value="{{old('name_ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required maxlength="190" class="form-control" value="{{old('name_en')}}" >
				</div>
			</div>

			

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.description_ar')}}
				</div>
				<div class="col-12 pt-3">
	 				<textarea name="description_ar" class="form-control" style="min-height: 200px;text-align: left;direction: ltr;">{{old('description_ar')}}</textarea>
				</div>
			</div>

						<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.description_en')}}
				</div>
				<div class="col-12 pt-3">
	 				<textarea name="description_en" class="form-control" style="min-height: 200px;text-align: left;direction: ltr;">{{old('description_en')}}</textarea>
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.grades')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="grades" id="grades">
					<option value="">{{__('admin/sessions/create.grades')}}</option>

					@foreach($grades as $grade)
					<option @if(old('grades') == $grade->id) selected @endif value='{{ $grade->id}}'>{{ $grade->Name }}</option>
					@endforeach
				</select>				
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.teacher')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="teachers" id="teachers">
					<option value="">{{__('admin/sessions/create.teacher')}}</option>

					@foreach($teachers as $teacher)
					<option @if(old('teachers') == $teacher->id) selected @endif value='{{ $teachers->id}}'>{{ $teachers->Name }}</option>
					@endforeach
				</select>				
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.payment_Status')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="status" id="status">
					<option @if(old('status') == 1) selected @endif value="1">{{__('main.active')}}</option>
					<option @if(old('status') == 0) selected @endif value="0">{{__('main.disactive')}}</option>
				</select>				
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.course')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="status" id="status">
					<option @if(old('status') == 1) selected @endif value="1">{{__('main.active')}}</option>
					<option @if(old('status') == 0) selected @endif value="0">{{__('main.disactive')}}</option>
				</select>				
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.amount')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="price" maxlength="190" required class="form-control" value="{{old('price')}}" >
				</div>
			</div>



			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.duration')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="duration" maxlength="190" required class="form-control" value="{{old('duration')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.date_start')}}
				</div>
				<div class="col-12 pt-3">
					<input type="date" name="date_start" maxlength="190" required class="form-control" value="{{old('date_start')}}" >
				</div>
			</div>

			
			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/sessions/create.date_end')}}
				</div>
				<div class="col-12 pt-3">
					<input type="date" name="date_end" maxlength="190" required class="form-control" value="{{old('date_end')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('main.status')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="status" id="status">
					<option @if(old('status') == 1) selected @endif value="1">{{__('main.active')}}</option>
					<option @if(old('status') == 0) selected @endif value="0">{{__('main.disactive')}}</option>
				</select>				
				</div>
			</div>

			</div>
 
		</div>
		 
		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">{{__('main.save')}}</button>
			<a href="{{route('admin.sessions.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection