<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\grades;
use Illuminate\Http\Request;
use App\Models\admin\courses;
use App\Models\admin\teachers;
use App\Models\admin\sessionsItem;
use App\Http\Controllers\Controller;


class SessionsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = sessionsItem::paginate(10);
        return view('admin.sessions.index',compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = teachers::all();
        $grades = grades::all();
        $teachers = teachers::Actives()->get();
        $course = courses::Actives()->get();
        return view('admin.sessions.create',compact('teachers','grades','teachers','course'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\sessionsItem  $sessionsItem
     * @return \Illuminate\Http\Response
     */
    public function show(sessionsItem $sessionsItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\sessionsItem  $sessionsItem
     * @return \Illuminate\Http\Response
     */
    public function edit(sessionsItem $sessionsItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\sessionsItem  $sessionsItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sessionsItem $sessionsItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\sessionsItem  $sessionsItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(sessionsItem $sessionsItem)
    {
        //
    }
}
