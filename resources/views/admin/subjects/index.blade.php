@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-categories"></span> {{__('admin/grades_sections/index.title')}}
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.subjects.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span>{{__('main.create')}}</span>
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
						<th>{{__('admin/subjects/index.name')}}</th>
						<th>{{__('admin/subjects/index.grades_number')}}</th>
						<th>{{__('admin/subjects/index.status')}}</th>
						<th>{{__('main.control')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $subject)
					<tr>
						<td>{{$subject->Name}}</td>
						<td>0</td>
						<td>{{$subject->Active()}}</td>
						<td style="width: 230px;">


						<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{__('main.control')}}</button>
						<ul class="dropdown-menu" style="margin: 0px;">
						<li>
						@if(auth()->user()->has_access_to('show',$subject))
							<a class="dropdown-item" href="{{route('admin.subjects.show',$subject)}}">
								<span style="color: #01adef;" class="fas fa-eye "></span> {{__('main.view')}}
							</a>
						@endif
						</li>
							<li>
							@if(auth()->user()->has_access_to('update',$subject))
							<a class="dropdown-item" href="{{route('admin.subjects.edit',$subject)}}">
								<span style="color: #ff9800;" class="fas fa-wrench "></span> {{__('main.edit')}}
							</a>
							@endif
							</li>

							<li>
							@if(auth()->user()->has_access_to('delete',$subject))
							<a class="dropdown-item confirm-deletet" onclick="confirm_delete('{{route('admin.subjects.delete',$subject)}}','{{__('main.confirm_delete')}}','{{__('main.text_delete')}}')">
								<span style="color: #f97e7e;" class="fas fa-trash "></span> {{__('main.delete')}}
							</a>
							@endif
							</li>
							
			

							<li>
			
							</li>

							
							</ul>
							</div>

							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$subjects->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection

@section('scripts')
    @include('layouts.includes.modal')
@stop