@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.teachers.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/teachers/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/teachers/create.teacher')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="teacher" maxlength="190" required class="form-control" value="{{old('teacher')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin\teachers\create.subject')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="subject" id="subject">
					<option value="">{{__('admin\teachers\create.subject')}}</option>
				@foreach($subjects as $subject)

					<option value="{{$subject->id}}">{{$subject->Name}}</option>
				@endforeach
				</select>				
				</div>
			</div>

			
			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/teachers/create.intro')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="intro" maxlength="190" required class="form-control" value="{{old('intro')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/teachers/create.image')}}
				</div>
				<div class="col-12 pt-3">
				<input type="file" class="form-control" id="validationCustom02" name="image">				
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/teachers/create.facebook')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="facebook" maxlength="190" class="form-control" value="{{old('facebook')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/teachers/create.mobile')}}
				</div>
				<div class="col-12 pt-3">
					<input type="integer" name="mobile" maxlength="190" class="form-control" value="{{old('mobile')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-2 p-2">
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
			<a href="{{route('admin.teachers.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection