<?php

namespace App\Http\Controllers;

use App\Models\SchoolVisitRequest;
use App\Models\SchoolVisit;
use App\Models\Teacher;
use App\Models\ClassStage;
use App\Models\RoleModelProfession;
use App\Http\Requests\ManageSchoolVisitRequest;
use App\Mail\SchoolVisitRequestCreated;
use App\Mail\SchoolVisitRequestApproved;
use App\Mail\SchoolVisitRequestRoleModel;
use App\Mail\SchoolVisitRequestCanceled;
use App\Services\Util;
use Illuminate\Http\Request;

class SchoolVisitRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitRequests = SchoolVisitRequest::fetchRequestsByAuthUser();
        if(\Auth::check()){
            $isTeacher = \Auth::user()->isTeacher();
            $isProfessional = \Auth::user()->isProfessional();
            $isCompanyAdmin = \Auth::user()->isCompanyAdmin();
            $hasAdminAccess = \Auth::user()->hasAdminAccess();
            $pendingRequestsCount = SchoolVisitRequest::pendingRequestsQuery()->get()->count();
        } else {
            $isTeacher = false;
            $isProfessional = false;
            $isCompanyAdmin = false;
            $hasAdminAccess = false;
            $pendingRequestsCount = 0;
        }

        return view('visit_requests.index', [
            'visitRequests' => $visitRequests,
            'isTeacher' => $isTeacher,
            'isProfessional' => $isProfessional,
            'isCompanyAdmin' => $isCompanyAdmin,
            'hasAdminAccess' => $hasAdminAccess,
            'pendingRequestsCount' => $pendingRequestsCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classStages = ClassStage::all();
        $roleModelProfessions = RoleModelProfession::all();
        $teacherStatuses = config('consts.TEACHER_STATUSES');
        $meetingTypes = config('consts.MEETING_TYPES');
        $participantsCount = config('consts.PARTICIPANTS_COUT');

        return view('visit_requests.create', [
            'classStages' => $classStages,
            'roleModelProfessions' => $roleModelProfessions,
            'teacherStatuses' => $teacherStatuses,
            'meetingTypes' => $meetingTypes,
            'participantsCount' => $participantsCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ManageSchoolVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManageSchoolVisitRequest $request)
    {
        $validated = $request->validated();
        $validated['teacher_id'] = \Auth::user()->teacher->id;
        $validated['created_by'] = \Auth::id();

        $validated['school_year'] = Util::getCurrentSchoolYear();
        $validated['term'] = Util::getCurrentSchoolTerm();

        $schoolVisitRequest = SchoolVisitRequest::create($validated);
        \Mail::to(\Auth::user()->email)
                    ->queue(new SchoolVisitRequestCreated());
        
        return redirect('visits')->with('msg_success', 'Успешно добавихте заявка за посещение от ролеви модел!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolVisitRequest  $schoolVisitRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolVisitRequest $schoolVisitRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schoolVisitRequest = SchoolVisitRequest::find($id);
        $classStages = ClassStage::all();
        $roleModelProfessions = RoleModelProfession::all();
        $teacherStatuses = config('consts.TEACHER_STATUSES');
        $meetingTypes = config('consts.MEETING_TYPES');
        $participantsCount = config('consts.PARTICIPANTS_COUT');

        return view('visit_requests.edit', [
            'visitRequest' => $schoolVisitRequest,
            'classStages' => $classStages,
            'roleModelProfessions' => $roleModelProfessions,
            'teacherStatuses' => $teacherStatuses,
            'meetingTypes' => $meetingTypes,
            'participantsCount' => $participantsCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManageSchoolVisitRequest $request, int $id)
    {
        $schoolVisitRequest = SchoolVisitRequest::find($id);
        $validated = $request->validated();
        $validated['updated_by'] = \Auth::id();

        $schoolVisitRequest->update($validated);

        return redirect('visits')->with('msg_update', 'Успешно обновихте заявка за посещение от ролеви модел!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $schoolVisitRequest = SchoolVisitRequest::findOrFail($id);
        $schoolVisitRequest->deleted_by = \Auth::id();
        $schoolVisitRequest->deleted_at = date('Y-m-d H:i:s');
        $schoolVisitRequest->save();

        return redirect('visits')->with('msg_delete', 'Успешно изтрихте заявка за посещение от ролеви модел!');
    }

    public function approve(SchoolVisitRequest $schoolVisitRequest)
    {
        $userId = \Auth::id();
        $schoolVisitRequest->request_status_id = config('consts.REQUEST_STATUS_APPROVED');
        $schoolVisitRequest->approved_by = $userId;
        $schoolVisitRequest->approved_at = date('Y-m-d H:i:s');
        $schoolVisitRequest->updated_by = $userId;
        $schoolVisitRequest->save();

        $teacherNames = $schoolVisitRequest->teacher->user->fullNames;
        return \Redirect::back()->with('msg_success', "Посещението с ИД $schoolVisitRequest->id на учител $teacherNames беше успешно одобрено!");
    }

    public function archive(SchoolVisitRequest $schoolVisitRequest)
    {
        $userId = \Auth::id();
        $schoolVisitRequest->request_status_id = config('consts.REQUEST_STATUS_ARCHIVED');
        $schoolVisitRequest->updated_by = $userId;
        $schoolVisitRequest->save();

        $teacherNames = $schoolVisitRequest->teacher->user->fullNames;
        return \Redirect::back()->with('msg_delete', "Посещението с ИД $schoolVisitRequest->id на учител $teacherNames беше архивирано!");
    }

    public function approveAll()
    {
        $userId = \Auth::id();
        $pendingRequests = SchoolVisitRequest::pendingRequestsQuery();
        $pendingRequestsCount = $pendingRequests->get()->count();

        if($pendingRequestsCount > 0){
            $pendingRequests->update([
                'request_status_id' => config('consts.REQUEST_STATUS_APPROVED'),
                'approved_by' => $userId,
                'approved_at' => date('Y-m-d H:i:s'),
                'updated_by' => $userId
            ]);

            return \Redirect::back()->with('msg_success', "Всички непотвърдени заявки за посещения бяха успешно потвърдени!");
        } else {
            return \Redirect::back()->with('msg_success', "Няма непотвърдени заявки, нищо не беше извършено!");
        }
    }

    public function archiveAll()
    {
        $userId = \Auth::id();
        $activeRequests = SchoolVisitRequest::activeRequestsQuery();
        $activeRequestsCount = $activeRequests->get()->count();

        if($activeRequestsCount > 0){
            $activeRequests->update([
                'request_status_id' => config('consts.REQUEST_STATUS_ARCHIVED'),
                'updated_by' => $userId
            ]);

            return \Redirect::back()->with('msg_delete', "Всички непотвърдени заявки за посещения бяха архивирани!");
        } else {
            return \Redirect::back()->with('msg_delete', "Няма нереализирани заявки, нищо не беше извършено!");
        }
    }

    //Role model signs for a school visit
    public function assign(SchoolVisitRequest $schoolVisitRequest)
    {
        if(\Auth::user()->role_id != config('consts.ROLE_ID_PROFESSIONAL') && \Auth::user()->role_id != config('consts.ROLE_ID_COMPANY_ADMIN')) {
            return redirect('/visits')->with('msg_delete', 'Нямате право да достъпвате търсената страница!');
        }

        try{
            \DB::beginTransaction();
            $schoolVisitRequest->request_status_id = config('consts.REQUEST_STATUS_ASSIGNED_RM');
            $schoolVisitRequest->updated_by = \Auth::id();
            $schoolVisitRequest->save();

            $schoolVisit = SchoolVisit::create([
                'school_visit_request_id' => $schoolVisitRequest->id,
                'professional_id' => \Auth::user()->professional->id
            ]);

            \DB::commit();

            if($schoolVisitRequest->teacher && $schoolVisitRequest->teacher->user)
            {
                \Mail::to($schoolVisitRequest->teacher->user->email)
                    ->queue(new SchoolVisitRequestApproved($schoolVisit));
            }

            if($schoolVisit->professional && $schoolVisit->professional->user)
            {
                \Mail::to($schoolVisit->professional->user->email)
                    ->bcc('e.kadiyski@gmail.com')
                    ->queue(new SchoolVisitRequestRoleModel($schoolVisitRequest));
            }

            $school = $schoolVisitRequest->teacher->school->name;
            return redirect('my-visits')->with('msg_success', "Поздравления! Посещението с ИД $schoolVisitRequest->id в училище $school беше успешно заявено! Свържете се с учителя до седмица, за да уговорите подробностите около посещението.");
        } catch (Exception $e) {
            \DB::rollBack();
        }
    }

    //List of assigned school visits for a role model or within a company (when in role CompanyAdmin)
    public function mySchoolVisits()
    {
        if(\Auth::user()->role_id != config('consts.ROLE_ID_PROFESSIONAL') && \Auth::user()->role_id != config('consts.ROLE_ID_COMPANY_ADMIN')) {
            return redirect('/visits')->with('msg_delete', 'Нямате право да достъпвате търсената страница!');
        }

        $isCompanyAdmin = false;
        if(\Auth::user()->role_id === config('consts.ROLE_ID_PROFESSIONAL')){
            $schoolVisits = SchoolVisit::fetchMyVisits();
        } elseif (\Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN')) {
            $isCompanyAdmin = true;
            $schoolVisits = SchoolVisit::fetchCompanyVisits();
        }
        
        return view('visits.myvisits', [
            'schoolVisits' => $schoolVisits,
            'isCompanyAdmin' => $isCompanyAdmin
        ]);
    }

    public function cancelVisit(SchoolVisitRequest $schoolVisitRequest)
    {
        if(\Auth::user()->role_id != config('consts.ROLE_ID_PROFESSIONAL') && \Auth::user()->role_id != config('consts.ROLE_ID_COMPANY_ADMIN')) {
            return redirect('/visits')->with('msg_delete', 'Нямате право да достъпвате търсената страница!');
        }
        
        try{
            \DB::beginTransaction();
            $schoolVisitRequest->request_status_id = config('consts.REQUEST_STATUS_APPROVED');
            $schoolVisitRequest->updated_by = \Auth::id();
            $schoolVisitRequest->save();

            $schoolVisit = $schoolVisitRequest->schoolVisit;
            $schoolVisit->delete();

            \DB::commit();

            if($schoolVisitRequest->teacher && $schoolVisitRequest->teacher->user)
            {
                \Mail::to($schoolVisitRequest->teacher->user->email)
                    ->bcc('e.kadiyski@gmail.com')
                    ->queue(new SchoolVisitRequestCanceled($schoolVisitRequest));
            }

            $school = $schoolVisitRequest->teacher->school->name;
            return redirect('visits')->with('msg_delete', "Посещението в училище $school беше отменено!");
        } catch (Exception $e) {
            \DB::rollBack();
        }
    }
}
