<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleModelPollRequest;
use App\Models\SchoolVisit;
use App\Models\RoleModelPoll;

class RoleModelPollController extends Controller
{
    public function index()
    {
        $rolemodelPolls = RoleModelPoll::with(['schoolVisit', 'schoolVisit.schoolVisitRequest'])->get();

        return view('polls.rolemodel.index', [
            'rolemodelPolls' => $rolemodelPolls
        ]);
    }

    public function create(SchoolVisit $schoolVisit)
    {
    	return view('polls.rolemodel.create', [
    		'schoolVisit' => $schoolVisit
    	]);
    }

    public function submit(RoleModelPollRequest $request)
    {
        $validated = $request->validated();
        $validated['professional_id'] = \Auth::user()->professional->id;
    	$roleModelPoll = RoleModelPoll::create($validated);

        $schoolVisit = SchoolVisit::find($request->school_visit_id);
        $schoolVisit->update([
            'role_model_poll_id' => $roleModelPoll->id
        ]);

        return redirect('/my-visits')->with("Успешно добавихте анкета към посещение в училище!");
    }

    public function show(RoleModelPoll $roleModelPoll)
    {
        $schoolVisit = SchoolVisit::find($roleModelPoll->school_visit_id);
        $isFromCompany = false;
        if(\Auth::user()->role_id === config('consts.ROLE_ID_PROFESSIONAL') || 
    		\Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN')) {
        	$isFromCompany = true;
        }

        return view('polls.rolemodel.show', [
            'schoolVisit' => $schoolVisit,
            'roleModelPoll' => $roleModelPoll,
            'isFromCompany' => $isFromCompany,
        ]);
    }
}
