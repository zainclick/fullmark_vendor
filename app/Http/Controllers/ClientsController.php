<?php

namespace App\Http\Controllers;

use App\Models\clients;
use App\Helpers\MainHelper;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients =  clients::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Slug','LIKE','%'.$request->q.'%')->orWhere('Barcode','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->merge([
            'Slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:clients,Name",
            'name_en'=>"required|max:190|unique:clients,Name",
            'slug_ar'=>"required|max:190|unique:clients,Slug",
            'slug_en'=>"required|max:190|unique:clients,Slug",
            'first_name_ar'=>"required|max:190",
            'first_name_en'=>"required|max:190",
            'last_name_en'=>"required|max:190",
            'notes_ar'=>"required|max:190",
            'notes_en'=>"required|max:190",
            'phone'=>"required|numeric",
            'email'=>"required|email:filter",
            'city'=>"required",
            'streate'=>"required",
            'postal'=>"required|numeric",
            'country'=>"required",
            'curency'=>"required",

        ]);
        $category = clients::create([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            "First_Name"=>['en'=>$request->first_name_en,'ar' =>$request->first_name_ar],
            "Last_Name"=>['en'=>$request->last_name_en,'ar' =>$request->last_name_ar],
            "Notes"=>['en'=>$request->notes_en,'ar' =>$request->notes_ar],
            "email" => $request->email,
            "Phone" => $request->phone,
            "City" => $request->city,
            "Streat" => $request->streate,
            "Post" => $request->postal,
            "Country" => $request->country,
            "Currency" => $request->curency,
            "Barcode" => $request->barcode,
            "Tax_Cridet" => $request->post,
            "Record" => $request->record,
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/clients/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(clients $client)
    {
        if(!auth()->user()->has_access_to('update',$client))abort(403);
        return view('admin.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clients $client)
    {
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:clients,Name,".$client->id,
            'name_en'=>"required|max:190|unique:clients,Name,".$client->id,
            'slug_ar'=>"required|max:190|unique:clients,Slug,".$client->id,
            'slug_en'=>"required|max:190|unique:clients,Slug,".$client->id,
            'first_name_ar'=>"required|max:190",
            'first_name_en'=>"required|max:190",
            'last_name_en'=>"required|max:190",
            'notes_ar'=>"required|max:190",
            'notes_en'=>"required|max:190",
            'phone'=>"required|numeric",
            'email'=>"required|email:filter",
            'city'=>"required",
            'streate'=>"required",
            'postal'=>"required|int",
            'country'=>"required",
            'curency'=>"required",

        ]);
        $client->update([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            "First_Name"=>['en'=>$request->first_name_en,'ar' =>$request->first_name_ar],
            "Last_Name"=>['en'=>$request->last_name_en,'ar' =>$request->last_name_ar],
            "Notes"=>['en'=>$request->notes_en,'ar' =>$request->notes_ar],
            "email" => $request->email,
            "Phone" => $request->phone,
            "City" => $request->city,
            "Streat" => $request->streate,
            "Post" => $request->postal,
            "Country" => $request->country,
            "Currency" => $request->curency,
            "Barcode" => $request->barcode,
            "Tax_Cridet" => $request->post,
            "Record" => $request->record,
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/clients/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(clients $client)
    {
        if(!auth()->user()->has_access_to('delete',$client))abort(403);
        $client->delete();
        flash()->success(__('admin/clients/messages.delete'));
        return redirect()->route('admin.clients.index');
    }
}
