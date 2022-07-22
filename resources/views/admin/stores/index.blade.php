@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-categories"></span> {{__('admin/stores/index.title')}}
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.stores.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span>{{__('admin/stores/index.create')}}</span>
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
						<th>#</th>
						<th>{{__('admin/stores/index.store')}}</th>
						<th>{{__('admin/stores/index.slug')}}</th>
						<th>{{__('main.control')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($stores as $store)
					<tr>
						<td>{{$store->id}}</td>

						<td>{{$store->Name}}</td>
						<td>{{$store->Slug}}</td>
					 
						<td style="width: 230px;">
							@if(auth()->user()->has_access_to('update',$store))
							<a href="{{route('admin.stores.edit',$store)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span>{{__('main.control')}}
							</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$store))
							<form method="POST" action="{{route('admin.stores.destroy',$store)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('{{__('main.confirm_delete')}}');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> {{__('main.delete')}}
								</button>
							</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$stores->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection
