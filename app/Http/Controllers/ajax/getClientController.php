<?php

namespace App\Http\Controllers\ajax;
use App\Models\clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class getClientController extends Controller
{
    public function getClient($id){

        $client = clients::find($id);

        return json_encode($client);
    }
}
