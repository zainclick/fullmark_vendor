<?php

namespace App\Models;

use App\Models\unites;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class products extends Model
{
    use HasFactory;
    use HasTranslations;
    
    public $translatable = ['Name','Slug','Description'];

    protected $guarded = [];

    //////////////////////////////////// Start Relations //////////////////////////////////////////////

    public function unit(){

        return $this->beLongsTo(unites::class,'Unit_Id');
    }

}
