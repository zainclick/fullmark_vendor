<?php

namespace App\Models\admin;

use App\Models\admin\subjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class teachers extends Model
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

            return $query->where('Status','1');
        }


    ///////////////////////////// start relations ////////////////////////


    public function subject(){

        return $this->beLongsTo(subjects::class,'Subject');
    }

}
