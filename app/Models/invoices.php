<?php

namespace App\Models;

use App\Models\User;
use App\Models\clients;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    //////////////////////////////////// Start Relation ////////////////////////////////////

    public function Users(){

        return $this->belongsTo(User::class,'UserId');
    }

    public function client(){

        return $this->beLongsTo(clients::class,'ClientId');
    }

    ////////////////////////////////////// End Relation //////////////////////////////////////

    public function Status(){
        if($this->Status == 3){
            $status = __('main.pay');
        }elseif($this->Status == 2){
            $status = __('main.some_pay');
        }else{
            $status = __('main.not_pay');
        }
        return $status;
    }
}
