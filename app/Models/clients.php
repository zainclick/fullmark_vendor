<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Notifications\Notifiable;


class clients extends Model
{
    use HasFactory;
    use HasTranslations;
    use Notifiable;

    public $translatable = ['Name','First_Name','Last_Name','Slug','Notes'];
    protected $guarded = [];
}
