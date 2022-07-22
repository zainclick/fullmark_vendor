<?php

namespace App\Models;

use App\Models\clients;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoicedetales extends Model
{
    use HasFactory;
    protected $guarded = [];

    //////////////////////////////////////// start relations //////////////////////////////////////////

    public function products(){

        return $this->belongsTo(products::class,'Product_Id');
    }

    public function client(){

        return $this->beLongsTo(clients::class,'ClientId');
    }
}
