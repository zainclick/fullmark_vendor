<?php

namespace App\Http\Controllers;

use App\Models\taxes;
use App\Models\stores;
use App\Models\unites;
use App\Models\Category;
use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products =  products::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Name','LIKE','%'.$request->q.'%')->orWhere('Barcode','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate(10);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['stores'] = stores::all();
        $data['categories'] = Category::all();
        $data['unites'] = unites::all();
        $data['taxes'] = taxes::all();
        return view('admin.products.create',$data);

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
            'name_ar'=>"required|max:190|unique:products,Name",
            'name_en'=>"required|max:190|unique:products,Name",
            'slug_ar'=>"required|max:190|unique:products,Slug",
            'slug_en'=>"required|max:190|unique:products,Slug",
            'description_ar'=>"max:190",
            'description_en'=>"max:190",
            'barcode'=>"required|max:190",
            'buy_price'=>"required|max:190",
            'sale_price'=>"required|max:190",
            'discount'=>"numeric|between:0,99.99",
            'store'=>"required",
            'category'=>"required",
            'unit'=>"required",
            'tax'=>"required",
            'quantity'=>"required",


        ]);
        $products = products::create([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            "Description"=>['en'=>$request->description_en,'ar' =>$request->description_ar],
            "Barcode" => $request->barcode,
            "BuyPrice" => $request->buy_price,
            "SalePrice" => $request->sale_price,
            "Discount" => $request->discount,
            "Store_Id" => $request->store,
            "Category_Id" => $request->category,
            "Unit_Id" => $request->unit,
            "Tax_Id" => $request->tax,
            "Quantity" => $request->quantity,
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/products/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $product)
    {
        if(!auth()->user()->has_access_to('update',$product))abort(403);

        $data['stores'] = stores::all();
        $data['categories'] = Category::all();
        $data['unites'] = unites::all();
        $data['taxes'] = taxes::all();
        $data['product'] = $product;
        return view('admin.products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $product)
    {
        $request->merge([
            'slug'=>\MainHelper::slug($request->slug)
        ]);

        $request->validate([
            'name_ar'=>"required|max:190|unique:products,Name,".$product->id,
            'name_en'=>"required|max:190|unique:products,Name,".$product->id,
            'slug_ar'=>"required|max:190|unique:products,Slug,".$product->id,
            'slug_en'=>"required|max:190|unique:products,Slug,".$product->id,
            'description_ar'=>"max:190",
            'description_en'=>"max:190",
            'barcode'=>"required|max:190",
            'buy_price'=>"required|max:190",
            'sale_price'=>"required|max:190",
            'discount'=>"numeric|between:0,99.99",
            'store'=>"required",
            'category'=>"required",
            'unit'=>"required",
            'tax'=>"required",
            'quantity'=>"required",

        ]);
        $product->update([
            "Name"=>['en'=>$request->name_en,'ar' =>$request->name_ar],
            "Slug"=>['en'=>$request->slug_en,'ar' =>$request->slug_ar],
            "Description"=>['en'=>$request->description_en,'ar' =>$request->description_ar],
            "Barcode" => $request->barcode,
            "BuyPrice" => $request->buy_price,
            "SalePrice" => $request->sale_price,
            "Discount" => $request->discount,
            "Store_Id" => $request->store,
            "Category_Id" => $request->category,
            "Unit_Id" => $request->unit,
            "Tax_Id" => $request->tax,
            "Quantity" => $request->quantity,
            'User_Id'=>auth()->user()->id,
        ]);
     
        flash()->success(__('admin/products/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $product)
    {
        if(!auth()->user()->has_access_to('delete',$product))abort(403);
        $product->delete();
        flash()->success(__('admin/products/messages.delete'));
        return redirect()->route('admin.products.index');
    }
}
