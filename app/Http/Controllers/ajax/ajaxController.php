<?php

namespace App\Http\Controllers\ajax;

use App\Models\admin\grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ajaxController extends Controller
{
    
    public function getGradesBySection($id){

        $grades = grades::where('Grade_Section',$id)->pluck('Name','id');

        return json_encode($grades);

    }

}
