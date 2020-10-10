<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfile;
use App\Models\Teacher;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\Company;
use App\Models\Professional;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $teachers = User::fetchTeachers();
        $professionals = User::fetchProfessionals();
        $admins = User::fetchAdmins();

        return view('user.index', [
            'teachers' => $teachers,
            'professionals' => $professionals,
            'admins' => $admins
        ]);
    }

    public function profile()
    {
    	$user = Auth::user();

    	$data = [];
    	if($user->role_id === config('consts.ROLE_ID_TEACHER')){
    		$data['teacher'] = Teacher::with('subjects')->where('user_id', $user->id)->first();
    		$data['schools'] = School::all();
    		$data['subjects'] = Subject::all();
    	} elseif ($user->role_id === config('consts.ROLE_ID_PROFESSIONAL')) {
            $data['professional'] = Professional::with('company')->where('user_id', $user->id)->first();
            $data['companies'] = Company::all();
        }
    	
    	return view('user.profile', [
    		'user' => $user,
    		'data' => $data
    	]);
    }

    public function profileStore(UpdateUserProfile $request)
    {
        $user = \Auth::user();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->save();

        if($user->role_id === config('consts.ROLE_ID_TEACHER')){
            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->school_id = $request->school_id;
            $teacher->save();

            $teacher->subjects()->sync($request->subject_ids);
        } elseif ($user->role_id === config('consts.ROLE_ID_PROFESSIONAL')) {
            $professional = Professional::where('user_id', $user->id)->first();
            $professional->company_id = $request->company_id;
            $professional->position = $request->position;
            $professional->save();
        }

        return redirect('/profile')->with('msg_update', 'Профилът беше успешно обновен!');
    }
}
