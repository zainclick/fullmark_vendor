<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\grades;
use Illuminate\Http\Request;
use App\Models\admin\subjects;
use App\Http\Controllers\Controller;
use App\Models\admin\gradesSections;
use App\Models\admin\gradesSubjects;
use App\Http\Requests\admin\gradesSubjectsRequest;

class GradesSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades_subjects = gradesSubjects::with(['subjects','sections','grades'])->where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('Subjects','LIKE','%'.$request->q.'%');
        })->orderBy('id','ASC')->paginate(10);
      
        return view('admin.grades_Subjects.index',compact('grades_subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['subjects'] = subjects::Actives()->get();
        $data['grades_sections'] = gradesSections::Actives()->get();
        $data['grades'] = grades::Actives()->get();
        return view('admin.grades_subjects.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(gradesSubjectsRequest $request)
    {
        $grades_subjects = new gradesSubjects();
        $grades_subjects->Subject = $request->subject;
        $grades_subjects->Grades_Sections = $request->section;
        $grades_subjects->Grade = $request->grade;
        $grades_subjects->Status = $request->status;
        $grades_subjects->save();

        flash()->success(__('admin/messages.create'),'عملية ناجحة');
        return redirect()->route('admin.grades_subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gradesSubjects  $gradesSubjects
     * @return \Illuminate\Http\Response
     */
    public function show(gradesSubjects $gradesSubjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gradesSubjects  $gradesSubjects
     * @return \Illuminate\Http\Response
     */
    public function edit(gradesSubjects $gradesSubject)
    {
        if(!auth()->user()->has_access_to('update',$gradesSubject))abort(403);

        $data['subjects'] = subjects::Actives()->get();
        $data['grades_sections'] = gradesSections::Actives()->get();
        $data['grades'] = grades::Actives()->get();
        $data['datasubject'] = $gradesSubject;
        return view('admin.grades_subjects.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gradesSubjects  $gradesSubjects
     * @return \Illuminate\Http\Response
     */
    public function update(gradesSubjectsRequest $request, gradesSubjects $gradesSubject)
    {
        $gradesSubject->update([

            'Subject' => $request->subject,
            'Grades_Sections' => $request->section,
            'Grade' => $request->grade,
            'Status' => $request->status,
        ]);

        flash()->success(__('admin/messages.update'),'عملية ناجحة');
        return redirect()->route('admin.grades_subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gradesSubjects  $gradesSubjects
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $grades_subjects = gradesSubjects::find($id);
        if(!auth()->user()->has_access_to('update',$grades_subjects))abort(403);
        $grades_subjects->delete();

        flash()->success(__('admin/messages.delete'),'عملية ناجحة');
        return redirect()->route('admin.grades_subjects.index');

    }
}
