@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.grades_subjects.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/subjects/create.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/grades_subjects/create.subject')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="subject" id="subject">
					<option value="">{{__('admin/grades_subjects/create.subject')}}</option>
					@foreach($subjects as $subject) 
						<option value="{{$subject->id}}">{{$subject->Name}}</option>
					@endforeach
				</select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/grades_subjects/create.section')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="section" id="section">
					<option value="">{{__('admin/grades_subjects/create.section')}}</option>
					@foreach($grades_sections as $section) 
						<option value="{{$section->id}}">{{$section->Name}}</option>
					@endforeach
				</select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
				<div class="col-12">
					{{__('admin/grades_subjects/create.grades')}}
				</div>
				<div class="col-12 pt-3">
				<select class="form-control" required name="grade" id="grade">
					<option value="">{{__('admin/grades_subjects/create.grades')}}</option>
				</select>
			</div>
			</div>

			<div class="col-12 col-lg-3 p-2">
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
			<a href="{{route('admin.grades_subjects.index')}}" class="btn btn-dark">{{__('main.cancel')}}</a>
		</div> 
		</form>
	</div>
</div>
@endsection

@section('scripts')

<script>
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "/admin/get_grades_by_section/"+SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="grade"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="grade"]').append('<option value="' +
								key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection