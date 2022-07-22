<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\stores;
use App\Models\clients;
use App\Models\invoices;
use App\Models\products;
use Illuminate\Http\Request;
use App\Models\invoicedetales;
use App\Notifications\Invoice;
use App\Exports\InvoicesExport;
use App\Imports\InvoicesImport;
use App\Models\Invoices_payments;
use App\Models\Invoice_attachments;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices =  invoices::with(['Users','client'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('InvoiceNumber','LIKE','%'.$request->q.'%')->orWhere('ClientCode','LIKE','%'.$request->q.'%')->orWhere('email','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

      
        return view('admin.invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients'] = clients::all();
        $data['stores'] = stores::all();
        $data['products'] = products::all();
        return view('admin.invoices.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->amountPaid == 0){
            $status = 1;
        }elseif($request->amountPaid != 0 && $request->amountPaid <= $request->total){

            $status = 2;
        }else{
            $status = 3;
        }
    
        $request->validate([
            'client'=>"required|numeric",
            'client_code'=>"required|numeric",
            'invoice_number'=>"required|numeric",
            'date'=>"date",
            'currency'=>"required",
            'payment_method'=>"required|numeric",
            'address'=>"required|max:190",
            'info'=>"string|max:190|nullable",
            'payment_id'=>"nullable|numeric",
            'alltax'=>"nullable|numeric",
            'taxAmount'=>"nullable|numeric",
            'amountPaid'=>"nullable|numeric",
            'discount'=>"nullable|numeric",
        ]);

        $invoice = invoices::create([
            'InvoiceNumber' => $request->invoice_number,
            'ClientCode' => $request->client_code,
            'PaymentMethod' => $request->payment_method,
            'PaymentId' => $request->payment_id,
            'Date' => $request->date,
            'Discount' => $request->discount,
            'Tax' => $request->alltax,
            'TaxAmount' => $request->taxAmount,
            'PaymentAmount' => $request->amountPaid,
            'Total' => $request->total,
            'Address' => $request->address,
            'Details' => $request->info,
            'Currency' => $request->currency,
            'Status' => $status,
            'UserId' => \Auth::user()->id,
            'ClientId' => $request->client,

        ]);

        $lastid = invoices::latest()->first()->id;

        $insertProducts = [];

        foreach($request->data as $key => $value){

            $insertProducts[] = [
                'Barcode' => $value['productCode'],
                'Product_Id' => $value['productname'],
                'Quantity' => $value['quantity'],
                'Product_Price' => $value['price'],
                'Discount' => $value['productDiscount'],
                'Tax' => $value['productTax'],
                'Total' => $value['total'],
                'InvoiceId' => $lastid,
                'ClientId' => $request->client,
                'UserId' => \Auth::user()->id,
            ];
        }

        invoicedetales::insert($insertProducts);

        // Start Uploade File
        if ($request->hasFile('attachment')) {

            $image = $request->file('attachment');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoice_attachments();
            $attachments->Attachment = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->User_Id = Auth::user()->id;
            $attachments->invoice_id = $lastid;
            $attachments->save();

            // move attachment
            $imageName = $request->attachment->getClientOriginalName();
            $request->attachment->move(public_path('uploads/invoices/Attachments/' . $invoice_number), $imageName);
        }

        // End upload File

        // Start send email
        
        $email = clients::find($request->client);
        Notification::send($email,new Invoice($lastid));
        // End send email

        flash()->success(__('admin/invoices/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoice)
    {

        $next = invoices::where('id','>',$invoice->id)->orderBy('id','ASC')->first();
        $last = invoices::where('id','<',$invoice->id)->orderBy('id','DESC')->first();
        $invoice_details = invoicedetales::with(['products','client'])->where('InvoiceId',$invoice->id)->get();
        $payments = Invoices_payments::with(['client','user','invoice'])->where('InvoiceId',$invoice->id)->get();
        $attachments = Invoice_attachments::where('Invoice_Id',$invoice->id)->get();
        return view('admin.invoices.show',compact('invoice','invoice_details','next','last','payments','attachments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoice)
    {
        $invoice->delete();
        flash()->success(__('admin/invoices/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.invoices.index');
    }

    // send invoice to archive
    public function setArchive($id){

        $invoice = invoices::find($id);
        $invoice->delete();
        flash()->success(__('admin/invoices/messages.archive'),'عملية ناجحة');
        return redirect()->route('admin.invoices.index');

    }

    // restore invoice wfrom archive
    public function restore($id){

        $invoice = invoices::withTrashed()->find($id)->restore();

        flash()->success(__('admin/invoices/messages.restore'),'عملية ناجحة');
        return redirect()->back();

    }

    public function add_payment($id)
    {
        $users = User::all();
        $invoice = invoices::find($id);
        return view('admin.invoices.add_payment',compact('invoice','users'));
    }

    public function unpaiedInvoices(Request $request){

    
        $invoices =  invoices::with(['Users'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('InvoiceNumber','LIKE','%'.$request->q.'%')->orWhere('ClientCode','LIKE','%'.$request->q.'%')->orWhere('email','LIKE','%'.$request->q.'%');
        })->where('Status','1')->orderBy('id','DESC')->paginate();

      
        return view('admin.invoices.unpaied',compact('invoices'));
        
    }


    public function partiallypaid(Request $request){

    
        $invoices =  invoices::with(['Users'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('InvoiceNumber','LIKE','%'.$request->q.'%')->orWhere('ClientCode','LIKE','%'.$request->q.'%')->orWhere('email','LIKE','%'.$request->q.'%');
        })->where('Status','2')->orderBy('id','DESC')->paginate();

      
        return view('admin.invoices.somepaied',compact('invoices'));
        
    }

    // Get all invoices archives
    public function archives(Request $request){
        $invoices =  invoices::with(['Users'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('InvoiceNumber','LIKE','%'.$request->q.'%')->orWhere('ClientCode','LIKE','%'.$request->q.'%')->orWhere('email','LIKE','%'.$request->q.'%');
        })->onlyTrashed()->orderBy('id','DESC')->paginate();

      
        return view('admin.invoices.archives',compact('invoices'));
        
    }

    // send email 

    public function sendEmail($id){

        $invoice = invoices::find($id);
        // Start send email
            $email = clients::find($invoice->ClientId);
            Notification::send($email,new Invoice($id));
        // End send email
        flash()->success(__('main.send_email'),'عملية ناجحة');
        return redirect()->back();
    }

    // Export excel
    public function export() 
    {
        return Excel::download(new InvoicesExport, 'Invoices.xlsx');
    }

    //Import excel
    public function import() 
    {
        Excel::import(new InvoicesImport, 'users.xlsx');
        return redirect()->back()->with('success', 'All good!');
    }
}
