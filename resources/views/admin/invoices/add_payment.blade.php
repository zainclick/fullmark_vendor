@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.payments.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>
					 {{__('admin/invoices/add_payment.title')}}
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
				
			

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/invoices/add_payment.payment_method')}}
				</div>
				<div class="col-12 pt-3">
                <select class="form-control" name="payment_method" id="payment_method">
					<option value="1">كاش</option>
					<option value="2">شيك</option>
					<option value="3">حوالة بنكية</option>
				</select>				
            </div>
			</div>

			<div class="col-12 col-lg-6 p-2">
				<div class="col-12">
					{{__('admin/invoices/add_payment.amount')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="amount" required   maxlength="190" class="form-control" value="{{$invoice->Total - $invoice->PaymentAmount}}" >
				</div>
			</div>

            <div class="col-12 col-lg-4 p-2">
				<div class="col-12">
                {{__('admin/invoices/add_payment.date')}}
				</div>
				<div class="col-12 pt-3">
					<input type="date" name="date" required   maxlength="190" class="form-control" value="{{date('Y-m-d')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-4 p-2">
				<div class="col-12">
                {{__('admin/invoices/add_payment.user')}}
				</div>
				<div class="col-12 pt-3">
                <select required class="form-control single-select client-invoice" name="user">
					<option value="">{{__('admin/invoices/add_payment.user')}}</option>
					@foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                     
					@endforeach
                </select>				
            </div>
			</div>

			<div class="col-12 col-lg-4 p-2">
				<div class="col-12">
					{{__('admin/invoices/add_payment.payment_id')}}
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="payment_id"  maxlength="190" class="form-control" value="{{old('payment_id')}}" >
				</div>
			</div>

            <div class="col-12 col-lg-12 p-2">
				<div class="col-12">
				{{__('admin/invoices/add_payment.note')}}
				</div>
				<div class="col-12 pt-3">
					<textarea name="note" class="form-control" style="min-height:150px">{{old('note')}}</textarea>
				</div>
			</div>




            <input type="hidden" name="invocie_id" required   maxlength="190" class="form-control" value="{{$invoice->id}}" >
            <input type="hidden" name="client_id" required   maxlength="190" class="form-control" value="{{$invoice->ClientId}}" >

	
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