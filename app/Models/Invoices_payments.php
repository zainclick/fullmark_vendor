<?php

namespace App\Models;

use App\Models\User;
use App\Models\clients;
use App\Models\invoices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoices_payments extends Model
{
    use HasFactory;
    protected $guarded = [];

    //////////////////////////////////////// Start Relations /////////////////////////////////////////

    public function client(){

        return $this->beLongsTo(clients::class,'ClientId');
    }

    public function user(){

        return $this->beLongsTo(User::class,'UserId');
    }

    public function invoice(){

        return $this->beLongsTo(invoices::class,'InvoiceId');
    }
}
