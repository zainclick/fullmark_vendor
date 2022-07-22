<?php

namespace App\Http\Controllers\ajax;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class getItemController extends Controller
{
    public function getItem(Request $request){

        $getproduct = products::find($request->product);

        return json_decode($getproduct);
    }

    public function getItemGlobalStore(Request $request){

        $products = products::where('Store_Id',$request->store)->get();
        ?>
        <option value=""><?= __('admin/invoices/create.product_name') ?>    </option>
        <?php
        foreach($products as $product){ ?>

            <option value="<?=$product->id ?>"><?= $product->Name ?></option>
            
        <?php }
    }


    public function getItemByBarcode(Request $request){

        $product = products::where('Barcode',$request->store)->first();
        return json_decode($product);

    }
}
