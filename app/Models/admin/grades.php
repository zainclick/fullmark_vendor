<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class grades extends Model
{
    use HasFactory;
    use HasTranslations;

        
    public $translatable = ['Name'];
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
}
