<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sessionsItem extends Model
{
    use HasFactory;

            
    public $translatable = ['Name'];
    protected $guarded = [];

    public function Active(){
        if($this->status == 1){
            return __('main.active');
        }else{
            return __('main.disactive');
        }
    }
}
