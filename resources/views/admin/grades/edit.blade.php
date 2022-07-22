@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.grades.update',$grade)}}">
		@csrf
		@method('PATCH')
		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/grades/edit.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/grades/create.name_ar')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_ar" maxlength="190" required class="form-control" value="{{$grade->getTranslation('Name','ar')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/grades/create.name_en')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="name_en" required maxlength="190" class="form-control" value="{{$grade->getTranslation('Name','en')}}" >
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/grades/create.grades_section')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="gardes_section" id="status">
					<option value="">{{__('admin/grades/create.grades_section')}}</option>
					@foreach($grades_sections as $section)
					<option @if($grade->Grade_Section == $section->id) selected @endif value="{{$section->id}}">{{$section->Name}}</option>
					@endforeach
					</select>				
				</div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('main.status')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="status" id="status">
							<option @if($grade->Status == 1) selected @endif value="1">{{__('main.active')}}</option>
							<option @if($grade->Status == 0) selected @endif value="0">{{__('main.disactive')}}</option>
						</select>				
				</div>
			</div>

			</div>
 
		</div>
		 
		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">{{__('main.save')}}</button>
			<a href="{{route('admin.grades_sections.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection