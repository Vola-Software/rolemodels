<?php

namespace App\Http\Controllers;

use App\Models\SchoolVisitRequest;
use App\Models\SchoolVisit;
use App\Models\Teacher;
use App\Models\ClassStage;
use App\Models\ClassMajor;
use App\Http\Requests\ManageSchoolVisitRequest;
use App\Mail\SchoolVisitRequestApproved;
use App\Mail\SchoolVisitRequestCanceled;
use Illuminate\Http\Request;

use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Prismic\Dom\RichText;

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

        $api = Api::get("https://rolemodelsbg.cdn.prismic.io/api/v2");
        $prismic = $api->query(Predicates::at('document.tags', ['visits']), ['lang' => 'en-gb']);
        //dd($prismic);
        dd($prismic->results[0]->data->title[0]->text);

        return view('visit_requests.index', [
            'visitRequests' => $visitRequests,
            'isTeacher' => $isTeacher,
            'isProfessional' => $isProfessional,
            'isCompanyAdmin' => $isCompanyAdmin,
            'hasAdminAccess' => $hasAdminAccess,
            'pendingRequestsCount' => $pendingRequestsCount,
            'prismic' => $prismic
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
        $classMajors = ClassMajor::all();
        $teacherStatuses = config('consts.TEACHER_STATUSES');
        $meetingTypes = config('consts.MEETING_TYPES');
        $participantsCount = config('consts.PARTICIPANTS_COUT');

        return view('visit_requests.create', [
            'classStages' => $classStages,
            'classMajors' => $classMajors,
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

        $schoolVisitRequest = SchoolVisitRequest::create($validated);
        
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
        $classMajors = ClassMajor::all();
        $teacherStatuses = config('consts.TEACHER_STATUSES');
        $meetingTypes = config('consts.MEETING_TYPES');
        $participantsCount = config('consts.PARTICIPANTS_COUT');

        return view('visit_requests.edit', [
            'visitRequest' => $schoolVisitRequest,
            'classStages' => $classStages,
            'classMajors' => $classMajors,
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
                    ->bcc('e.kadiyski@gmail.com')
                    ->queue(new SchoolVisitRequestApproved($schoolVisit));
            }

            $school = $schoolVisitRequest->teacher->school->name;
            return redirect('my-visits')->with('msg_success', "Поздравления! Посещението с ИД $schoolVisitRequest->id в училище $school беше успешно заявено! Свържете се с учителя, за да уточните детайли относно посещението.");
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

        if(\Auth::user()->role_id === config('consts.ROLE_ID_PROFESSIONAL')){
            $schoolVisits = SchoolVisit::fetchMyVisits();
        } elseif (\Auth::user()->role_id === config('consts.ROLE_ID_COMPANY_ADMIN')) {
            $schoolVisits = SchoolVisit::fetchCompanyVisits();
        }
        
        return view('visits.myvisits', [
            'schoolVisits' => $schoolVisits
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
