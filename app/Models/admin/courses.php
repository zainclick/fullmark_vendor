<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Active(){
        if($this->Status == 1){
            return __('main.active');
        }else{
            return __('main.disactive');
        }
    }

    // get activate data
    public function scopeActives($query){

            return $query->where('status','1');
    }
}
