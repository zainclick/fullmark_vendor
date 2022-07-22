<?php

namespace App\Models\admin;

use App\Models\admin\grades;
use App\Models\admin\subjects;
use App\Models\admin\gradesSections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gradesSubjects extends Model
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


    //////////////////////////////////////// Start Relations /////////////////////////////////

    public function subjects(){

        return $this->beLongsTo(subjects::class,'Subject');
    }

    public function sections(){

        return $this->beLongsTo(gradesSections::class,'Grades_Sections');
    }

    public function grades(){

        return $this->beLongsTo(grades::class,'Grade');
    }
}
