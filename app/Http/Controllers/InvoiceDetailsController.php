<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class InvoiceDetailsController extends Controller
{
    //Download File
    public function get_file($invoice_number,$file_name)
    {
        return Storage::disk('public_uploads')->download($invoice_number.'/'.$file_name);

        
    }

    //Open File
    public function open_file($invoice_number,$file_name)
    {

        return Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);

    }
}
