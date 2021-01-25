<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeacherPollRequest;
use App\Models\SchoolVisit;
use App\Models\SchoolVisitRequest;
use App\Models\TeacherPoll;

class TeacherPollController extends Controller
{
    public function create(SchoolVisit $schoolVisit)
    {
    	return view('polls.teacher.create', [
    		'schoolVisit' => $schoolVisit
    	]);
    }

    public function submit(TeacherPollRequest $request)
    {
        $validated = $request->validated();
        unset($validated['visit_date']);
        $validated['teacher_id'] = \Auth::user()->teacher->id;
    	$teacherPoll = TeacherPoll::create($validated);

        $schoolVisit = SchoolVisit::find($request->school_visit_id);
        $schoolVisit->update([
            'date' => $request->visit_date,
            'teacher_poll_id' => $teacherPoll->id
        ]);

        if($request->did_happen == -1) {
            $schoolVisitRequestStatus = config('consts.REQUEST_STATUS_CANCELLED');
        } else {
            $schoolVisitRequestStatus = config('consts.REQUEST_STATUS_FINISHED');
        }
        $schoolVisit->schoolVisitRequest->update(['request_status_id' => $schoolVisitRequestStatus]);

        return redirect('/visits')->with("Успешно добавихте анкета към посещение от ролеви модел!");
    }

    public function show(TeacherPoll $teacherPoll)
    {
        $schoolVisit = SchoolVisit::find($teacherPoll->school_visit_id);

        return view('polls.teacher.show', [
            'schoolVisit' => $schoolVisit,
            'teacherPoll' => $teacherPoll,
        ]);
    }
}
