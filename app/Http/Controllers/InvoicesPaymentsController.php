<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\Invoices_payments;

class InvoicesPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = invoices::find($request->invocie_id);
        if($request->amount + $invoice->PaymentAmount == $invoice->Total || $request->amount + $invoice->PaymentAmount < $invoice->Total ){

            if($request->amount + $invoice->PaymentAmount == $invoice->Total){

                $status = 3;
            }else{
                $status = 2;
            }
            
            $addpayment = new Invoices_payments();
            $addpayment->PaymentMethod = $request->payment_method;
            $addpayment->Amount = $request->amount;
            $addpayment->Date = $request->date;
            $addpayment->PaymentId = $request->payment_id;
            $addpayment->Note = $request->note;
            $addpayment->UserId = $request->user;
            $addpayment->InvoiceId = $request->invocie_id;
            $addpayment->ClientId = $request->client_id;
            $addpayment->save();

            $invoice->update([
                'PaymentAmount' => $invoice->PaymentAmount + $request->amount,
                'Status' => $status,
            ]);

            flash()->success(__('admin/invoices/messages.create'),'عملية ناجحة');
            return redirect()->route('admin.invoices.show',$request->invocie_id);

        }else{
            
            flash()->success('عفوا هذا المبلغ أكبر من قيمة الفاتورة المتبقية','عملية ناجحة');
            return redirect()->route('admin.invoices.show',$request->invocie_id);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_payments  $invoices_payments
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_payments $invoices_payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_payments  $invoices_payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_payments $invoices_payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_payments  $invoices_payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_payments $invoices_payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_payments  $invoices_payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices_payments $invoices_payments)
    {
        //
    }
}
