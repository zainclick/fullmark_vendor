<?php

namespace App\Http\Controllers\ajax;

use App\Models\stores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class getStoreController extends Controller
{
    public function getStores(Request $request){

        $stores = stores::all();
        ?>
        <option value=""><?= __('admin/invoices/create.store') ?>    </option>
        <?php
        foreach($stores as $store){ ?>

            <option value="<?=$store->id ?>"><?= $store->Name ?></option>
            
        <?php }
    }
    
}
