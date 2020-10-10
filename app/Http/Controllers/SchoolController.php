<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\City;
use App\Models\User;
use App\Http\Requests\SchoolRequest;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::with(['city', 'teachers', 'teachers.schoolVisitRequests'])->orderBy('is_approved', 'asc')->get();

        return view('schools.index', [
            'schools' => $schools
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('schools.create', [
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SchoolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by'] = \Auth::id();

        School::create($validated);

        return redirect('schools')->with('msg_success', 'Успешно добавихте училище!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        $cities = City::all();

        return view('schools.edit', [
            'cities' => $cities,
            'school' => $school
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SchoolRequest   $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolRequest $request, School $school)
    {
        $validated = $request->validated();
        $validated['updated_by'] = \Auth::id();

        $school->update($validated);

        return redirect('schools')->with('msg_update', 'Успешно променихте училище!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $schoolName = $school->name;
        $school->deleted_by = \Auth::id();
        $school->deleted_at = date('Y-m-d H:i:s');
        $school->save();

        return redirect('schools')->with('msg_delete', "Успешно изтрихте училище $schoolName!");
    }

    public function approve($id)
    {
        $school = School::find($id);
        $school->is_approved = 1;
        $school->save();

        //Set the ID of creator of the school to school ID
        $schoolCreator = User::with(['teacher'])->where('id', $school->created_by)->first();
        $teacher = $schoolCreator->teacher;
        $teacher->school_id = $school->id;
        $teacher->save();

        return redirect('schools')->with('msg_update', 'Успешно одобрихте училище!');
    }
}
